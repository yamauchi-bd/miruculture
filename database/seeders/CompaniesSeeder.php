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

    public function run()
    {
        $this->loadProcessedFiles();

        $files = glob(storage_path('app/company_data/*.csv'));
        $totalProcessed = 0;
        
        foreach ($files as $file) {
            $fileName = basename($file);
            if (in_array($fileName, $this->processedFiles)) {
                $this->command->info("Skipping already processed file: " . $fileName);
                continue;
            }

            try {
                $processed = $this->processFile($file);
                $totalProcessed += $processed;
                $this->command->info("Processed $processed records from " . $fileName);
                $this->markFileAsProcessed($fileName);
                $this->saveProcessedFiles();
            } catch (\Exception $e) {
                $this->command->error("Error processing file " . $fileName . ": " . $e->getMessage());
                Log::error("Error processing file: " . $fileName . " - " . $e->getMessage());
            }
        }

        $this->command->info("Total processed records: " . $totalProcessed);
    }

    protected function loadProcessedFiles()
    {
        if (file_exists($this->processedFilesPath)) {
            $this->processedFiles = json_decode(file_get_contents($this->processedFilesPath), true);
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

    protected function processFile($file)
    {
        Log::info("Started processing file: " . basename($file));

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader();
        Log::info("File headers: " . implode(', ', $header));

        $processedCount = 0;
        $offset = 0;
        $limit = 1000;

        do {
            $records = (new Statement())
                ->offset($offset)
                ->limit($limit)
                ->process($csv);

            $batch = [];
            foreach ($records as $record) {
                try {
                    $record = array_filter($record, function($value) {
                        return $value !== '';
                    });

                    if (!empty($record['本社所在地'])) {
                        $data = $this->mapData($record);
                        $batch[] = $data;
                        $processedCount++;
                    }
                } catch (\Exception $e) {
                    Log::error("Error processing record in file " . basename($file) . ": " . $e->getMessage());
                    Log::error("Problematic record: " . json_encode($record));
                }
            }

            if (!empty($batch)) {
                DB::table('companies')->insert($batch);
            }

            $offset += $limit;
        } while ($records->count() > 0);

        Log::info("Finished processing file: " . basename($file) . ". Processed records: " . $processedCount);
        return $processedCount;
    }

    protected function mapData($record)
    {
        $data = [];
        foreach ($this->columnMapping as $csvHeader => $dbColumn) {
            $value = $record[$csvHeader] ?? null;
            
            if ($value === '') {
                $value = null;
            }
            
            if ($dbColumn === 'date_of_establishment' && $value) {
                try {
                    $value = Carbon::parse($value)->format('Y-m-d');
                } catch (\Exception $e) {
                    $this->command->warn("Invalid date for date_of_establishment: {$value}");
                    $value = null;
                }
            }
            
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