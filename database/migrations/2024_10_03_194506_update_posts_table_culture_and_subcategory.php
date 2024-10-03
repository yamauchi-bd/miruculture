<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // カルチャー項目を8つに減らす
            $table->dropColumn(['culture_8', 'culture_9', 'culture_detail_8', 'culture_detail_9']);
            
            // current_job_subcategory_id を追加（外部キー制約なし）
            $table->unsignedBigInteger('current_job_subcategory_id')->after('current_job_category_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // カルチャー項目を元に戻す
            $table->unsignedTinyInteger('culture_8')->nullable();
            $table->unsignedTinyInteger('culture_9')->nullable();
            $table->text('culture_detail_8')->nullable();
            $table->text('culture_detail_9')->nullable();
            
            // current_job_subcategory_id を削除
            $table->dropColumn('current_job_subcategory_id');
        });
    }
};