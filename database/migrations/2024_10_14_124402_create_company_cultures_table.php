<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_cultures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_record_id')->constrained()->onDelete('cascade');
            
            // 動的にカラムを生成
            for ($i = 0; $i < 8; $i++) {
                $table->unsignedTinyInteger("culture_{$i}");
                $table->text("culture_detail_{$i}")->nullable();
            }

            $table->timestamps();

            // インデックスを追加
            $table->index(['enrollment_record_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_cultures');
    }
};