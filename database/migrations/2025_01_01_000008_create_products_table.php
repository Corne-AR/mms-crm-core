<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('part_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('currency')->default('ZAR');
            $table->boolean('vat_applicable')->default(true);
            $table->boolean('discount_applicable')->default(false);
            $table->boolean('bulk_discount_applicable')->default(false);
            $table->boolean('shipping_fee_applicable')->default(false);
            $table->text('list_contents')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};