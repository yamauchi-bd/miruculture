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
            $table->text('business_summary')->nullable();;
            $table->text('company_mission')->nullable();
            $table->text('company_vision')->nullable();
            $table->text('company_values')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('industry')->nullable();
            $table->text('company_url')->nullable();
            $table->string('location');
            $table->integer('employee_number')->nullable();
            $table->integer('date_of_establishment')->nullable();
            $table->integer('capital_stock')->nullable();
            $table->string('representative_name')->nullable();
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
