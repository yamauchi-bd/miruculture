<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('company_name');
            $table->char('corporate_number', 13)->nullable();
            $table->enum('employment_type', ['正社員', '契約社員', 'その他']);
            $table->enum('entry_type', ['新卒入社', '中途入社']);
            $table->enum('status', ['在籍中', '退職済み']);
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->foreignId('current_job_category_id')->constrained('job_categories');
            $table->foreignId('current_job_subcategory_id')->constrained('job_categories');

            // 1番目の入社の決め手（必須）
            $table->enum('deciding_factor_1', ['企業ビジョンへの共感', '革新的なビジネスモデル', '優秀で熱意のある仲間', '成長できる環境･チャンス', '柔軟な働き方･場所', '給与･報酬など', 'その他']);
            $table->text('factor_1_detail');
            $table->unsignedTinyInteger('factor_1_satisfaction');
            $table->text('factor_1_satisfaction_reason');

            // 2番目の入社の決め手（任意）
            $table->enum('deciding_factor_2', ['企業ビジョンへの共感', '革新的なビジネスモデル', '優秀で熱意のある仲間', '成長できる環境･チャンス', '柔軟な働き方･場所', '給与･報酬など', 'その他'])->nullable();
            $table->text('factor_2_detail')->nullable();
            $table->unsignedTinyInteger('factor_2_satisfaction')->nullable();
            $table->text('factor_2_satisfaction_reason')->nullable();

            // 3番目の入社の決め手（任意）
            $table->enum('deciding_factor_3', ['企業ビジョンへの共感', '革新的なビジネスモデル', '優秀で熱意のある仲間', '成長できる環境･チャンス', '柔軟な働き方･場所', '給与･報酬など', 'その他'])->nullable();
            $table->text('factor_3_detail')->nullable();
            $table->unsignedTinyInteger('factor_3_satisfaction')->nullable();
            $table->text('factor_3_satisfaction_reason')->nullable();

            $table->timestamps();

            // インデックスと制約
            $table->unique(['user_id', 'corporate_number']);
            $table->index('company_name');
            $table->index('corporate_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};