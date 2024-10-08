<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;
use League\Csv\Statement;
use Carbon\Carbon;

class CompaniesSeeder extends Seeder
{
    protected $columnMapping = [
        '法人番号' => 'corporate_number',
        '法人名' => 'company_name',
        '事業概要' => 'business_summary',
        '企業ホームページ' => 'company_url',
        '本社所在地' => 'location',
        '従業員数' => 'employee_number',
        '設立年月日' => 'date_of_establishment',
        '資本金' => 'capital_stock',
        '法人代表者名' => 'representative_name',
    ];

    protected $progressFile = 'company_seeder_progress.json';

    public function run()
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);

        $progress = $this->loadProgress();
        $files = glob(storage_path('app/company_data/*.csv'));
        $totalProcessed = $progress['total_processed'] ?? 0;

        foreach ($files as $file) {
            if (!file_exists($file)) {
                $this->command->error("File does not exist: " . $file);
                continue;
            }

            if (in_array($file, $progress['processed_files'] ?? [])) {
                $this->command->info("Skipping already processed file: " . basename($file));
                continue;
            }

            $processedInFile = $this->processFile($file, $progress['last_offset'] ?? 0);
            $totalProcessed += $processedInFile;

            $progress['processed_files'][] = $file;
            $progress['total_processed'] = $totalProcessed;
            $progress['last_offset'] = 0; // リセット
            $this->saveProgress($progress);
        }

        $this->command->info("Total processed records: " . $totalProcessed);
    }

    protected function processFile($file, $startOffset = 0)
    {
        Log::info("Started processing file: " . basename($file) . ". Memory usage: " . $this->getMemoryUsage());

        $csv = Reader::createFromPath($file, 'r');

        // ファイル名から番号を取得
        $fileNumber = intval(substr(basename($file), 10, 3));

        if ($fileNumber == 0) {
            // kihonjoho_000.csvの場合はヘッダーあり
            $csv->setHeaderOffset(0);
            $header = $csv->getHeader();
        } else {
            // それ以外のファイルはヘッダーなし
            $header = $this->getDefaultHeader();
            $csv->setHeaderOffset(null);
        }

        Log::info("File headers: " . implode(', ', $header));

        $processedCount = 0;
        $batchSize = 5000; // バッチサイズを小さく設定
        $offset = $startOffset;

        while (true) {
            $stmt = (new Statement())->offset($offset)->limit($batchSize);
            $records = $stmt->process($csv, $header);

            if ($records->count() == 0) {
                break;
            }

            $batch = [];
            foreach ($records as $record) {
                try {
                    // 空の列を除去
                    $record = array_filter($record, function($value) {
                        return $value !== '';
                    });

                    // デバッグログを追加
                    Log::info("Processing record: " . json_encode($record));

                    // 法人番号と本社所在地が空でないことを確認
                    if (!empty($record['法人番号']) && !empty($record['本社所在地'])) {
                        $data = $this->mapData($record);
                        
                        // データベースに既に存在していないか確認
                        if (!DB::table('companies')->where('corporate_number', $data['corporate_number'])->exists()) {
                            $batch[] = $data;
                            $processedCount++;
                        }
                    }
                } catch (\Exception $e) {
                    Log::error("Error processing record in file " . basename($file) . ": " . $e->getMessage());
                    Log::error("Problematic record: " . json_encode($record));
                }
            }

            if (!empty($batch)) {
                DB::table('companies')->insert($batch);
            }

            $offset += $batchSize;
            $this->saveProgress(['last_offset' => $offset]);
            $this->command->info("Processed $processedCount records. Memory usage: " . $this->getMemoryUsage());
            gc_collect_cycles();
        }

        Log::info("Finished processing file: " . basename($file) . ". Processed records: " . $processedCount . ". Memory usage: " . $this->getMemoryUsage());
        return $processedCount;
    }

    protected function getDefaultHeader()
    {
        return [
            '法人番号',
            '法人名',
            '法人名ふりがな',
            '法人名英語',
            '郵便番号',
            '本社所在地',
            'ステータス',
            '登記記録の閉鎖等年月日',
            '登記記録の閉鎖等の事由',
            '法人代表者名',
            '法人代表者役職',
            '資本金',
            '従業員数',
            '企業規模詳細(男性)',
            '企業規模詳細(女性)',
            '営業品目リスト',
            '事業概要',
            '企業ホームページ',
            '設立年月日',
            '創業年',
            '最終更新日',
            '資格等級'
        ];
    }

    protected function mapData($record)
    {
        $data = [];
        foreach ($this->columnMapping as $csvHeader => $dbColumn) {
            $value = $record[$csvHeader] ?? null;
            
            // 空文字列を null に変換
            if ($value === '') {
                $value = null;
            }
            
            // 日付形式の変換
            if ($dbColumn === 'date_of_establishment' && $value) {
                try {
                    $value = Carbon::parse($value)->format('Y-m-d');
                } catch (\Exception $e) {
                    $this->command->warn("Invalid date for date_of_establishment: {$value}");
                    $value = null;
                }
            }
            
            // 資本金の変換
            if ($dbColumn === 'capital_stock' && $value) {
                $value = (int) preg_replace('/[^0-9]/', '', $value);
            }
            
            $data[$dbColumn] = $value;
        }

        $now = Carbon::now();
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        return $data;
    }

    protected function getMemoryUsage()
    {
        return round(memory_get_usage(true) / 1024 / 1024) . ' MB';
    }

    protected function loadProgress()
    {
        $file = storage_path($this->progressFile);
        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        }
        return [];
    }

    protected function saveProgress($progress)
    {
        $file = storage_path($this->progressFile);
        file_put_contents($file, json_encode($progress));
    }
}