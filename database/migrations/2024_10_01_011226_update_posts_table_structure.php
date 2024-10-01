<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 不要なフィールドを削除
            $table->dropColumn('employment_type');
            $table->dropForeign(['current_job_subcategory_id']);
            $table->dropColumn('current_job_subcategory_id');
            $table->dropColumn('factor_1_satisfaction_reason');
            $table->dropColumn('factor_2_satisfaction_reason');
            $table->dropColumn('factor_3_satisfaction_reason');

            // 新しい文化関連フィールドを追加
            for ($i = 0; $i < 10; $i++) {
                $table->unsignedTinyInteger("culture_{$i}")->nullable();
                $table->text("culture_detail_{$i}")->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // 削除したフィールドを復元
            $table->enum('employment_type', ['正社員', '契約社員', 'その他'])->after('corporate_number');
            $table->foreignId('current_job_subcategory_id')->after('current_job_category_id')->constrained('job_categories');
            $table->text('factor_1_satisfaction_reason')->after('factor_1_satisfaction');
            $table->text('factor_2_satisfaction_reason')->nullable()->after('factor_2_satisfaction');
            $table->text('factor_3_satisfaction_reason')->nullable()->after('factor_3_satisfaction');

            // 追加した文化関連フィールドを削除
            for ($i = 0; $i < 10; $i++) {
                $table->dropColumn("culture_{$i}");
                $table->dropColumn("culture_detail_{$i}");
            }
        });
    }
};