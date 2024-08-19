<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_years', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // 経験年数データの挿入
         $job_years = [
            '1年未満',
            '1〜2年',
            '3〜5年',
            '6〜10年',
            '10年以上'
        ];

         foreach ($job_years as $job_year) {
             DB::table('job_years')->insert(['name' => $job_year]);
         }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_years');
    }
};
