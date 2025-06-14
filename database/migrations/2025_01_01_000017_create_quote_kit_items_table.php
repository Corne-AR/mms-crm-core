<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_kit_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_kit_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0.00); // at quote time (can capture price used at time)
            $table->decimal('total_price', 12, 2)->default(0.00); // unit * qty
            $table->timestamps();

            $table->foreign('quote_kit_id')->references('id')->on('quote_kits')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_kit_items');
    }
};