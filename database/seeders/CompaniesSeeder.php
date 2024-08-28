<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

# ライブラリの読込
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'companies';
        $this->filename = base_path() . '/database/seeders/csv/Book1.csv';
        $this->timestamps = true;
        $this->created_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $this->updated_at = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        // 全データ削除後に再登録する。
        DB::table($this->table)->truncate();

        parent::run();
    }
}