<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->string('corporate_number')->primary();
            $table->string('company_name');
            $table->text('business_summary')->nullable();
            $table->text('company_mission')->nullable();
            $table->text('company_vision')->nullable();
            $table->text('company_values')->nullable();
            $table->string('company_logo')->nullable();
            $table->text('company_url')->nullable();
            $table->string('location');
            $table->integer('employee_number')->nullable();
            $table->date('date_of_establishment')->nullable();
            $table->bigInteger('capital_stock')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('listing_status')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->timestamps();
        });

        // 重複データの削除（必要な場合）
        $this->removeDuplicates();
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }

    private function removeDuplicates()
    {
        DB::statement('
            DELETE c1 FROM companies c1
            INNER JOIN (
                SELECT corporate_number, MIN(created_at) as min_created_at
                FROM companies
                GROUP BY corporate_number
            ) c2 
            ON c1.corporate_number = c2.corporate_number 
            AND c1.created_at > c2.min_created_at
        ');
    }
};