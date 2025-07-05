<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            // Drop old subdealer_id column if it exists
            if (Schema::hasColumn('quotes', 'subdealer_id')) {
                $table->dropForeign(['subdealer_id']);
                $table->dropColumn('subdealer_id');
            }

            // Add dealer_id as foreign key to dealers table
            $table->unsignedBigInteger('dealer_id')->nullable()->after('customer_id');
            $table->foreign('dealer_id')->references('id')->on('dealers')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            // Reverse the changes
            $table->dropForeign(['dealer_id']);
            $table->dropColumn('dealer_id');

            $table->unsignedBigInteger('subdealer_id')->nullable()->after('customer_id');
            $table->foreign('subdealer_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
