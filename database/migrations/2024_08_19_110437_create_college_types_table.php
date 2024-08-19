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
        Schema::create('college_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('college_types')->insert([
            ['name' => '大学院（博士）'],
            ['name' => '大学院（修士）'],
            ['name' => '大学'],
            ['name' => '短大'],
            ['name' => '専門'],
            ['name' => '高専'],
            ['name' => 'その他'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('college_types');
    }
};
