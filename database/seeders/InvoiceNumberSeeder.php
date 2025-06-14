<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceNumberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insertOrIgnore([
            'key' => 'invoice_next_number',
            'value' => '5001', // Start at 5001 — you can adjust 🚀
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}