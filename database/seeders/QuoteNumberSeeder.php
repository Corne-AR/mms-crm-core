<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuoteNumberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insertOrIgnore([
            'key' => 'quote_next_number',
            'value' => '1001', // Start at 1001 — you can change this 🚀
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}