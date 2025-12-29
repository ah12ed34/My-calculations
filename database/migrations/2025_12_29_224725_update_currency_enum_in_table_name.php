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
        DB::statement("
            ALTER TABLE transaction_logs
            MODIFY currency ENUM('usd', 'yr', 'sr', 'egp', 'try')
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('table_name', function (Blueprint $table) {
        //     //
        // });
    }
};
