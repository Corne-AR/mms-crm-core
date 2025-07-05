<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
	public function up(): void
	{
		Schema::table('dealers', function (Blueprint $table) {
			$table->string('logo')->nullable()->after('bank_details');
		});
	}

	public function down(): void
	{
		Schema::table('dealers', function (Blueprint $table) {
			$table->dropColumn('logo');
		});
	}

};
