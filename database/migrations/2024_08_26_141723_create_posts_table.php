<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('company_name');
            $table->char('corporate_number', 13);
            $table->enum('employment_type', ['正社員', '契約社員', 'その他']);
            $table->enum('entry_type', ['新卒入社', '中途入社']);
            $table->enum('status', ['在籍中', '退職済み']);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('job_category_id')->constrained('job_categories');

            // 1番目の入社の決め手（必須）
            $table->enum('factor_1', ['企業ビジョン', '事業内容', '仲間', '成長環境', '働き方', '給与', 'その他']);
            $table->text('factor_1_detail');
            $table->unsignedTinyInteger('factor_1_satisfaction');
            $table->text('factor_1_satisfaction_reason');

            // 2番目の入社の決め手（任意）
            $table->enum('factor_2', ['企業ビジョン', '事業内容', '仲間', '成長環境', '働き方', '給与', 'その他'])->nullable();
            $table->text('factor_2_detail')->nullable();
            $table->unsignedTinyInteger('factor_2_satisfaction')->nullable();
            $table->text('factor_2_satisfaction_reason')->nullable();

            // 3番目の入社の決め手（任意）
            $table->enum('factor_3', ['企業ビジョン', '事業内容', '仲間', '成長環境', '働き方', '給与', 'その他'])->nullable();
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};