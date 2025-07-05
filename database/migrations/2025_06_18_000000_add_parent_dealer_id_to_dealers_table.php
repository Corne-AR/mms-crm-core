<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dealers', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_dealer_id')
                  ->nullable()
                  ->after('id');

            $table->foreign('parent_dealer_id')
                  ->references('id')
                  ->on('dealers')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('dealers', function (Blueprint $table) {
            $table->dropForeign(['parent_dealer_id']);
            $table->dropColumn('parent_dealer_id');
        });
    }
};
