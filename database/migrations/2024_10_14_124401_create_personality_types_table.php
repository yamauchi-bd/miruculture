<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personality_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enrollment_record_id')->constrained()->onDelete('cascade');
            $table->string('type', 4); // INTJ, ENFP など
            $table->timestamps();

            // 複合インデックス
            $table->index(['enrollment_record_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personality_types');
    }
};