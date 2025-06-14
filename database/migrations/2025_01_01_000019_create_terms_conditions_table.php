<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('terms_conditions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // So each Dealer/Sub-dealer can have their own Terms!
            $table->string('title'); // Name of this Terms version
            $table->text('content'); // Full rich text Terms
            $table->boolean('is_default')->default(false); // If this is default for new Quotes
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('terms_conditions');
    }
};