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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        // foreignId connects this row directly back to the main order id
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->string('food_name');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}
};
