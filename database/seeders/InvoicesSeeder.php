<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoicesSeeder extends Seeder
{
    public function run(): void
    {
        $invoices = [
            [
                'invoice_number' => 'INV-00001',
                'customer_id' => 2,
                'user_id' => 1,
                'invoice_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Pending',
                'terms' => json_encode(['Payment due in 30 days.']),
                'subtotal' => 50000,
                'vat_amount' => 7500,
                'total_amount' => 57500,
                'currency' => 'ZAR',
                'is_pdf_generated' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'invoice_number' => 'INV-00002',
                'customer_id' => 1,
                'user_id' => 1,
                'invoice_date' => Carbon::now()->format('Y-m-d'),
                'status' => 'Paid',
                'terms' => json_encode(['Full prepayment.']),
                'subtotal' => 30000,
                'vat_amount' => 4500,
                'total_amount' => 34500,
                'currency' => 'ZAR',
                'is_pdf_generated' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($invoices as $invoice) {
            Invoice::updateOrInsert(
                ['invoice_number' => $invoice['invoice_number']],
                $invoice
            );
        }
    }
}
