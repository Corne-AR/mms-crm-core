<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('method_name')->unique(); // Example: Bank Transfer, Cash, Credit Card, PayPal
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 🚩 Do NOT alter 'payments' table here — payments table does not exist
        // Instead, add payment_method_id in 'invoice_payments' migration (correct)
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
