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

    protected $processedFiles = [];
    protected $processedFilesPath;

    public function __construct()
    {
        $this->processedFilesPath = storage_path('app/processed_files.json');
    }

    public function run($specificFile = null)
    {
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 300);

        $this->loadProcessedFiles();

        $files = $specificFile 
            ? [storage_path('app/company_data/' . $specificFile)]
            : glob(storage_path('app/company_data/*.csv'));

        foreach ($files as $file) {
            if (in_array(basename($file), $this->processedFiles)) {
                $this->command->info("Skipping already processed file: " . basename($file));
                continue;
            }

            $this->command->info("Processing file: " . basename($file));
            try {
                $processed = $this->processFile($file);
                $this->markFileAsProcessed(basename($file));
                $this->command->info("Processed $processed records from " . basename($file));
            } catch (\Exception $e) {
                $this->command->error("Error processing file " . basename($file) . ": " . $e->getMessage());
                Log::error("Error processing file: " . basename($file) . " - " . $e->getMessage());
            }

            $this->saveProcessedFiles();
        }
    }

    protected function processFile($file)
    {
        Log::info("Started processing file: " . basename($file) . ". Memory usage: " . $this->getMemoryUsage());

        $csv = Reader::createFromPath($file, 'r');
        $fileNumber = intval(substr(basename($file), 10, 3));
        $header = $fileNumber == 0 ? $csv->getHeader() : $this->getDefaultHeader();
        $csv->setHeaderOffset($fileNumber == 0 ? 0 : null);

        $processedCount = 0;
        $chunkSize = 100;
        $offset = 0;

        while (true) {
            $stmt = (new Statement())->offset($offset)->limit($chunkSize);
            $records = $stmt->process($csv, $header);

            if ($records->count() == 0) {
                break;
            }

            $batch = [];
            foreach ($records as $record) {
                if (!empty($record['本社所在地'])) {
                    $data = $this->mapData($record);
                    $batch[] = $data;
                    $processedCount++;
                }
            }

            if (!empty($batch)) {
                DB::table('companies')->insert($batch);
            }

            $offset += $chunkSize;
            $this->command->info("Processed $processedCount records. Memory usage: " . $this->getMemoryUsage());
            gc_collect_cycles();
        }

        Log::info("Finished processing file: " . basename($file) . ". Processed records: " . $processedCount . ". Memory usage: " . $this->getMemoryUsage());
        return $processedCount;
    }

    protected function getMemoryUsage()
    {
        return round(memory_get_usage(true) / 1048576, 2) . ' MB';
    }

    protected function loadProcessedFiles()
    {
        if (file_exists($this->processedFilesPath)) {
            $this->processedFiles = json_decode(file_get_contents($this->processedFilesPath), true) ?? [];
        }
    }

    protected function markFileAsProcessed($filename)
    {
        $this->processedFiles[] = $filename;
    }

    protected function saveProcessedFiles()
    {
        file_put_contents($this->processedFilesPath, json_encode($this->processedFiles));
    }

    protected function getDefaultHeader()
    {
        // CSVファイルの正しいヘッダーをここに記述
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
}