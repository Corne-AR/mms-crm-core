<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('converted_to_invoice_id')->nullable()->after('status');
            $table->timestamp('converted_at')->nullable()->after('converted_to_invoice_id');

            $table->foreign('converted_to_invoice_id')->references('id')->on('invoices')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropForeign(['converted_to_invoice_id']);
            $table->dropColumn(['converted_to_invoice_id', 'converted_at']);
        });
    }
};
