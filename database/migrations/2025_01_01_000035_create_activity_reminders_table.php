<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Dealer / Sub-dealer / Admin
            $table->unsignedBigInteger('customer_id')->nullable(); // Optionally linked to customer
            $table->unsignedBigInteger('quote_id')->nullable(); // Optionally linked to quote
            $table->unsignedBigInteger('invoice_id')->nullable(); // Optionally linked to invoice
            $table->date('reminder_date'); // When to remind
            $table->string('title');
            $table->text('notes')->nullable();
            $table->boolean('completed')->default(false); // Mark done
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('set null');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_reminders');
    }
};