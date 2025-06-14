<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Who performed the action
            $table->string('action_type'); // e.g. 'Created Quote', 'Updated Invoice', 'Deleted Customer'
            $table->string('entity_type')->nullable(); // e.g. 'Quote', 'Invoice', 'Customer'
            $table->unsignedBigInteger('entity_id')->nullable(); // ID of entity affected
            $table->text('description')->nullable(); // Free text description of what happened
            $table->string('ip_address')->nullable(); // IP of user
            $table->string('user_agent')->nullable(); // Browser/device
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};