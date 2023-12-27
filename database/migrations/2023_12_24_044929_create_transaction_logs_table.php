<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use app\Enums\TransactionCurrency;
use App\Enums\TransactionType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('title',30);
            $table->double('amount');
            $table->enum('type', ['deposit', 'withdraw']);
            $table->enum('currency', ['usd', 'yr', 'sr']);
            $table->string('description')->nullable();
            $table->string('status',20)->default('pending')->includes('pending', 'cancelled', 'completed');
            $table->date('request_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_logs');
    }
};
