<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quote;
use Carbon\Carbon;

class QuotesSeeder extends Seeder
{
    public function run(): void
    {
        $quotes = [
            [
                'quote_number' => 'Q-00001',
                'subdealer_id' => 1,
                'customer_id' => 1,
                'user_id' => 1,
                'quote_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Draft',
                'terms' => json_encode(['Standard terms apply.']),
                'subtotal' => 30000,
                'vat_amount' => 4500,
                'total_amount' => 34500,
                'currency' => 'ZAR',
                'is_pdf_generated' => 0,
                'converted_to_invoice_id' => null,
                'converted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'quote_number' => 'Q-00002',
                'subdealer_id' => 1,
                'customer_id' => 2,
                'user_id' => 1,
                'quote_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Invoiced',
                'terms' => json_encode(['Payment within 30 days.']),
                'subtotal' => 50000,
                'vat_amount' => 7500,
                'total_amount' => 57500,
                'currency' => 'ZAR',
                'is_pdf_generated' => 1,
                'converted_to_invoice_id' => 1, // invoice_id=1 → will link to InvoicesSeeder
                'converted_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($quotes as $quote) {
            Quote::updateOrInsert(
                ['quote_number' => $quote['quote_number']],
                $quote
            );
        }
    }
}
