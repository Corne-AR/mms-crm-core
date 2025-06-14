<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'MMS Design CRM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'default_currency',
                'value' => 'ZAR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'default_vat_percentage',
                'value' => '15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'quote_prefix',
                'value' => 'Q-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'invoice_prefix',
                'value' => 'INV-',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'default_terms_id',
                'value' => '1', // will match TermsSeeder 🚀
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'default_email_from',
                'value' => 'crm@mmsdesign.co.za',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}