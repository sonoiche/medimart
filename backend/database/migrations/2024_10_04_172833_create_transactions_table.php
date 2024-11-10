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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('seller_id');
            $table->integer('customer_id');
            $table->string('order_number')->nullable();
            $table->enum('transaction_type', ['Pending', 'Delivered', 'Confirmed']);
            $table->enum('payment_method', ['Cash', 'GCash', 'Bank Transfer'])->nullable();
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->text('seller_remarks')->nullable();
            $table->text('customer_remarks')->nullable();
            $table->integer('ratings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
