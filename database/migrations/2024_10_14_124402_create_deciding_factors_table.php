<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deciding_factors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_record_id')->constrained()->onDelete('cascade');
            
            // 1番目の決め手（必須）
            $table->enum('factor_1', [
                '企業ビジョンへの共感',
                '革新的なビジネスモデル',
                '優秀で熱意のある仲間',
                '成長できる環境･チャンス',
                '柔軟な働き方･場所',
                '給与･報酬など',
                'その他'
            ]);
            $table->unsignedTinyInteger('satisfaction_1');
            $table->text('detail_1');
            
            // 2番目の決め手（任意）
            $table->enum('factor_2', [
                '企業ビジョンへの共感',
                '革新的なビジネスモデル',
                '優秀で熱意のある仲間',
                '成長できる環境･チャンス',
                '柔軟な働き方･場所',
                '給与･報酬など',
                'その他'
            ])->nullable();
            $table->unsignedTinyInteger('satisfaction_2')->nullable();
            $table->text('detail_2')->nullable();
            
            // 3番目の決め手（任意）
            $table->enum('factor_3', [
                '企業ビジョンへの共感',
                '革新的なビジネスモデル',
                '優秀で熱意のある仲間',
                '成長できる環境･チャンス',
                '柔軟な働き方･場所',
                '給与･報酬など',
                'その他'
            ])->nullable();
            $table->unsignedTinyInteger('satisfaction_3')->nullable();
            $table->text('detail_3')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deciding_factors');
    }
};