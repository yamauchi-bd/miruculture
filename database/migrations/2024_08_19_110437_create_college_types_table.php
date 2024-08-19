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
        Schema::create('college_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

         // 学校タイプデータの挿入
         $college_types = [
            '大学院（博士）',
            '大学院（修士）',
            '大学',
            '短大',
            '専門',
            '高専',
            'その他'
        ];

         foreach ($college_types as $college_type) {
             DB::table('college_types')->insert(['name' => $college_type]);
         }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_types');
    }
};
