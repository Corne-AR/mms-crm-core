<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
			$table->id();
			$table->string('company_name');
			$table->string('contact_person')->nullable();  // <-- ADD THIS LINE
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
			$table->string('vat_number')->nullable();
			$table->string('vendor_number')->nullable();
			$table->string('catagory')->nullable();
			$table->string('type')->nullable();
			$table->string('language')->nullable();
			$table->string('currency')->nullable();
			$table->text('address')->nullable();
			$table->unsignedBigInteger('created_by')->nullable();
			$table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};