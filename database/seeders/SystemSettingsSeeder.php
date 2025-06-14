<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('system_settings')->insert([
            [
                'key'   => 'site_name',
                'value' => 'MMS Design CRM',
            ],
            [
                'key'   => 'default_currency',
                'value' => 'ZAR',
            ],
            [
                'key'   => 'default_vat_percentage',
                'value' => '15',
            ],
            [
                'key'   => 'quote_prefix',
                'value' => 'Q-',
            ],
            [
                'key'   => 'invoice_prefix',
                'value' => 'INV-',
            ],
            [
                'key'   => 'default_terms_id',
                'value' => '1',
            ],
            [
                'key'   => 'default_email_from',
                'value' => 'crm@mmsdesign.co.za',
            ],
        ]);
    }
}
