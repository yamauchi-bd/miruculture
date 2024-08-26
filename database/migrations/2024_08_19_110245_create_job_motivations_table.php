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
        Schema::create('job_motivations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['change', 'side']);
            $table->timestamps();
        });

        DB::table('job_motivations')->insert([
            ['name' => '積極的に検討中', 'type' => 'change'],
            ['name' => '検討している', 'type' => 'change'],
            ['name' => 'いい案件があれば', 'type' => 'change'],
            ['name' => '全く考えていない', 'type' => 'change'],
            ['name' => '積極的に検討中', 'type' => 'side'],
            ['name' => '検討している', 'type' => 'side'],
            ['name' => 'いい案件があれば', 'type' => 'side'],
            ['name' => '全く考えていない', 'type' => 'side'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_motivations');
    }
};
