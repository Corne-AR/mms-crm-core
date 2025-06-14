<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kit_assemblies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id')->nullable(); // optional — dealer-specific kits
            $table->string('kit_name');
            $table->text('kit_description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00); // optional total price for kit
            $table->boolean('vat_applicable')->default(true);
            $table->boolean('discount_allowed')->default(false);
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kit_assemblies');
    }
};