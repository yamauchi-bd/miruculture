<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('company_name');
            $table->char('corporate_number', 13);
            $table->enum('entry_type', ['新卒入社', '中途入社']);
            $table->enum('status', ['在籍中', '退職済み']);
            $table->year('start_year');
            $table->year('end_year')->nullable();
            $table->foreignId('current_job_category_id')->constrained('job_categories');
            $table->unsignedBigInteger('current_job_subcategory_id');
            $table->timestamps();
            $table->softDeletes(); // 論理削除のため

            $table->index('user_id');
            // corporate_numberのユニーク制約を削除
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment_records');
    }
};
