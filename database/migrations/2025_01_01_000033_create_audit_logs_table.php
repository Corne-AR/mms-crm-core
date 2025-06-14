<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Who did the action
            $table->string('action_type'); // e.g. "created quote", "updated invoice", "deleted product"
            $table->string('related_table')->nullable(); // e.g. "quotes", "customers"
            $table->unsignedBigInteger('related_id')->nullable(); // ID of the affected record
            $table->text('details')->nullable(); // Free text - what changed
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};