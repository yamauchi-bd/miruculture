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
        Schema::create('annual_incomes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 年収データの挿入
        $annual_incomes = [
            '300万円未満',
            '300万円〜500万円',
            '500万円〜700万円',
            '700万円〜1000万円',
            '1000万円〜1500万円',
            '1500万円〜2000万円',
            '2000万円〜3000万円',
            '3000万円以上'
        ];
        
        foreach ($annual_incomes as $annual_income) {
            DB::table('annual_incomes')->insert(['name' => $annual_income]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_incomes');
    }
};
