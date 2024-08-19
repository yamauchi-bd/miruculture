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
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 業界データの挿入
        $industries = [
            'IT・インターネット・ゲーム',
            'メーカー',
            '商社',
            '流通・小売・サービス',
            '広告・出版・マスコミ',
            'コンサルティング',
            '金融',
            '建設・不動産',
            'メディカル',
            '物流・運輸',
            'その他（インフラ・教育・官公庁など）',
        ];

        foreach ($industries as $industry) {
            DB::table('industries')->insert(['name' => $industry]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};
