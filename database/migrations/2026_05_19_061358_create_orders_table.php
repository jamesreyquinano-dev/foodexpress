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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name');
        $table->string('phone_number');
        $table->text('delivery_address');
        $table->string('payment_method');
        $table->decimal('total_price', 8, 2);
        $table->timestamps(); // Creates created_at and updated_at automatically
    });
}
};
