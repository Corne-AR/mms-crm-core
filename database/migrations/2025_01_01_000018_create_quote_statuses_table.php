<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->unique(); // Example: Draft, Sent, Accepted, Rejected, Lost, Expired
            $table->string('color')->nullable(); // Optional UI color
            $table->timestamps();
        });

        // Add status_id to quotes table
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->after('quote_number');

            $table->foreign('status_id')->references('id')->on('quote_statuses')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // First drop FK in quotes table
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        Schema::dropIfExists('quote_statuses');
    }
};