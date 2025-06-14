<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'NX510 SE GNSS Receiver',
                'part_number' => '8 000 900 108',
                'description' => 'NX510 SE GNSS Receiver with UHF Radio (Rx / Tx)',
                'price' => 33200,
                'currency' => 'ZAR',
                'vat_applicable' => 1,
                'discount_applicable' => 1,
                'bulk_discount_applicable' => 1,
                'shipping_fee_applicable' => 1,
                'list_contents' => '<ul><li>PA-3UB-FAYWY GNSS Receiver</li><li>Mounting Kit</li><li>User Manual</li></ul>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more products here
        ];

        foreach ($products as $product) {
            Product::updateOrInsert(
                ['part_number' => $product['part_number']],  // UNIQUE key
                $product
            );
        }
    }
}
