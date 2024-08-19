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
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('prefectures')->insert([
            ['name' => '北海道'],
            ['name' => '青森県'],
            ['name' => '岩手県'],
            ['name' => '宮城県'],
            ['name' => '秋田県'],
            ['name' => '山形県'],
            ['name' => '福島県'],
            ['name' => '茨城県'],
            ['name' => '栃木県'],
            ['name' => '群馬県'],
            ['name' => '埼玉県'],
            ['name' => '千葉県'],
            ['name' => '東京都'],
            ['name' => '神奈川県'],
            ['name' => '新潟県'],
            ['name' => '富山県'],
            ['name' => '石川県'],
            ['name' => '福井県'],
            ['name' => '山梨県'],
            ['name' => '長野県'],
            ['name' => '岐阜県'],
            ['name' => '静岡県'],
            ['name' => '愛知県'],
            ['name' => '三重県'],
            ['name' => '滋賀県'],
            ['name' => '京都府'],
            ['name' => '大阪府'],
            ['name' => '兵庫県'],
            ['name' => '奈良県'],
            ['name' => '和歌山県'],
            ['name' => '鳥取県'],
            ['name' => '島根県'],
            ['name' => '岡山県'],
            ['name' => '広島県'],
            ['name' => '山口県'],
            ['name' => '徳島県'],
            ['name' => '香川県'],
            ['name' => '愛媛県'],
            ['name' => '高知県'],
            ['name' => '福岡県'],
            ['name' => '佐賀県'],
            ['name' => '長崎県'],
            ['name' => '熊本県'],
            ['name' => '大分県'],
            ['name' => '宮崎県'],
            ['name' => '鹿児島県'],
            ['name' => '沖縄県'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefectures');
    }
};
