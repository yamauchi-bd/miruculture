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

        DB::table('industries')->insert([
            ['name' => 'IT・インターネット・ゲーム'],
            ['name' => 'メーカー'],
            ['name' => '商社'],
            ['name' => '流通・小売・サービス'],
            ['name' => '広告・出版・マスコミ'],
            ['name' => 'コンサルティング'],
            ['name' => '金融'],
            ['name' => '建設・不動産'],
            ['name' => 'メディカル'],
            ['name' => '物流・運輸'],
            ['name' => 'その他（インフラ・教育・官公庁など）'],

            // ['name' => '第一次産業'],
            // ['name' => '建設・不動産'],
            // ['name' => '製造'],
            // ['name' => 'エネルギー・環境'],
            // ['name' => '宇宙'],
            // ['name' => 'IT・通信・ソフトウェア'],
            // ['name' => '運輸・物流'],
            // ['name' => '小売'],
            // ['name' => '金融'],
            // ['name' => 'エンタメ'],
            // ['name' => '教育'],
            // ['name' => '医療・ヘルスケア'],
            // ['name' => 'ライフスタイル'],
            // ['name' => '旅行'],
            // ['name' => '行政・法律・社会インフラ'],
            // ['name' => 'ビジネスサポート'],
            // ['name' => 'その他'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};
