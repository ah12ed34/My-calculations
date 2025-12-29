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
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->double('amount_egp')->default(0)->after('amount_sr');
            $table->double('amount_try')->default(0)->after('amount_egp');
            $table->enum('currency_default', ['usd', 'yr', 'sr', 'egp', 'try'])->default('usd')->after('amount_try');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->dropColumn('amount_egp');
            $table->dropColumn('amount_try');
        });
    }
};
