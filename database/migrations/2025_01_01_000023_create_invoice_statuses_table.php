<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name')->unique(); // Example: Draft, Sent, Paid, Overdue, Cancelled
            $table->string('color')->nullable(); // Optional UI color
            $table->timestamps();
        });

        // Add status_id to invoices table
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable()->after('invoice_number');

            $table->foreign('status_id')->references('id')->on('invoice_statuses')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // First drop FK in invoices table
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
        });

        Schema::dropIfExists('invoice_statuses');
    }
};