<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('terms_conditions')->insert([
            'title' => 'Standard MMS Quote Terms',
            'content' => '
                1. All prices exclude VAT unless otherwise stated.<br>
                2. Validity of this quotation is 14 days from issue date.<br>
                3. Goods remain the property of MMS Design until full payment is received.<br>
                4. Delivery subject to stock availability.<br>
                5. Warranty as per manufacturer terms.<br>
                6. Payment terms: 50% deposit on order, balance on delivery.<br>
                7. Bank Details:<br>
                Bank: XYZ Bank<br>
                Account No: 123456789<br>
                Branch Code: 12345<br>
                Swift Code: XYZABC<br>
                8. Contact us for any clarifications.<br>
            ',
            'is_default' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}