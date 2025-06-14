<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvoiceItem;
use Carbon\Carbon;

class InvoiceItemsSeeder extends Seeder
{
    public function run(): void
    {
        $invoiceItems = [
            [
                'invoice_id' => 1,
                'item_type' => 'Kit',
                'item_id' => 1, // Kit ID
                'description' => 'Surveyor Starter Kit',
                'quantity' => 1,
                'unit_price' => 50000,
                'vat_amount' => 7500,
                'discount_amount' => 0,
                'line_total' => 57500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'invoice_id' => 2,
                'item_type' => 'Product',
                'item_id' => 1, // Product ID
                'description' => 'NX510 SE GNSS Receiver',
                'quantity' => 1,
                'unit_price' => 30000,
                'vat_amount' => 4500,
                'discount_amount' => 0,
                'line_total' => 34500,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($invoiceItems as $item) {
            InvoiceItem::updateOrInsert(
                [
                    'invoice_id' => $item['invoice_id'],
                    'item_type' => $item['item_type'],
                    'item_id' => $item['item_id'],
                ],
                $item
            );
        }
    }
}
