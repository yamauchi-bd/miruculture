<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 重複データの削除
        $this->removeDuplicates();

        Schema::table('companies', function (Blueprint $table) {
            // corporate_numberを主キーに設定
            $table->string('corporate_number')->change();
            $table->primary('corporate_number');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropPrimary();
        });
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