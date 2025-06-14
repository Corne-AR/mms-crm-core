<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->string('phone')->nullable();
			$table->string('address')->nullable();
			$table->text('banking_details')->nullable();
			$table->string('vat_number')->nullable();
			$table->string('logo_path')->nullable();
			$table->string('role')->default('user');
			$table->foreignId('region_id')->nullable()->constrained('sub_dealer_regions')->onDelete('set null');
			$table->foreignId('role_id')->nullable()->constrained('user_roles')->onDelete('set null');
			$table->rememberToken();
			$table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
