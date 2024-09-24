<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\CompaniesSeeder;

class ProcessCompanyData extends Command
{
    protected $signature = 'companies:process {file?}';
    protected $description = 'Process company data from CSV file';

    public function handle()
    {
        $seeder = new CompaniesSeeder();
        $seeder->setCommand($this);
        $seeder->run();

        return Command::SUCCESS;
    }
}