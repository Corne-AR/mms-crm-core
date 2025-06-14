<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_number_sequences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id')->nullable(); // Dealer/Sub-dealer specific numbering
            $table->unsignedBigInteger('current_number')->default(0);
            $table->string('prefix')->nullable(); // Example: Q-
            $table->string('suffix')->nullable(); // Example: -2025
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_number_sequences');
    }
};