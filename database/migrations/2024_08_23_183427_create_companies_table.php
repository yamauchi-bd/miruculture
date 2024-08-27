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
        Schema::create('companies', function (Blueprint $table) {
            $table->integer('corporate_number');
            $table->string('name');
            $table->text('business_summary');
            $table->text('company_mission')->nullable();
            $table->text('company_vision')->nullable();
            $table->text('company_values')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('industry')->nullable();
            $table->text('company_url');
            $table->string('location');
            $table->integer('employee_number');
            $table->integer('date_of_establishment');
            $table->integer('capital_stock');
            $table->string('representative_name');
            $table->string('listing_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
