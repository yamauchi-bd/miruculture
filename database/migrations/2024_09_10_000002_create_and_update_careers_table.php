<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('careers')) {
            Schema::create('careers', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
                $table->string('last_name');
                $table->string('first_name');
                $table->string('last_name_kana');
                $table->string('first_name_kana');
                $table->date('birth_date');
                $table->foreignId('gender_id')->constrained();
                $table->foreignId('prefecture_id')->constrained();
                $table->foreignId('career_status_id')->constrained('career_statuses');

                // career_status が 1:社会人 または 9:その他 の場合の追加フィールド
                $table->foreignId('job_change_motivation_id')->nullable()->constrained('job_motivations');
                $table->foreignId('side_job_motivation_id')->nullable()->constrained('job_motivations');
                $table->foreignId('current_industry_id')->nullable()->constrained('industries');
                $table->foreignId('current_job_category_id')->nullable()->constrained('job_categories');
                $table->foreignId('current_job_subcategory_id')->nullable()->constrained('job_categories');
                $table->foreignId('current_job_years_id')->nullable()->constrained('job_years');
                $table->foreignId('annual_income_id')->nullable()->constrained('annual_incomes');

                // career_status が 2:学生 の場合の追加フィールド
                $table->foreignId('college_type_id')->nullable()->constrained('college_types');
                $table->string('college_name')->nullable();
                $table->string('college_faculty')->nullable();
                $table->string('college_department')->nullable();
                $table->integer('graduation_year')->nullable();
                $table->integer('graduation_month')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('careers', function (Blueprint $table) {
                // 既存のテーブルに対する変更
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};