<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Dealer/Sub-dealer
            $table->string('quote_template')->nullable(); // Could store path to Blade template or JSON config
            $table->string('email_template')->nullable(); // Optional email template
            $table->string('logo_path')->nullable(); // Company logo
            $table->text('address')->nullable(); // Company address
            $table->text('banking_details')->nullable(); // Banking details (multi-line text)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};