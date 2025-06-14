<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_kits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('kit_assembly_id');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->default(0.00); // price per kit (may be overridden)
            $table->decimal('total_price', 12, 2)->default(0.00); // total = unit_price * quantity
            $table->boolean('vat_applicable')->default(true);
            $table->boolean('discount_applied')->default(false);
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->foreign('kit_assembly_id')->references('id')->on('kit_assemblies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_kits');
    }
};