<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KitItem;
use Carbon\Carbon;

class KitItemsSeeder extends Seeder
{
    public function run(): void
    {
        $kitItems = [
            // Surveyor Starter Kit (kit_id = 1), example products
            [
                'kit_id' => 1,
                'product_id' => 1, // Example → GNSS Receiver
                'quantity' => 1,
                'unit_price' => 20000,
                'line_total' => 20000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kit_id' => 1,
                'product_id' => 2, // Example → Tripod
                'quantity' => 1,
                'unit_price' => 5000,
                'line_total' => 5000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Advanced Surveyor Kit (kit_id = 2)
            [
                'kit_id' => 2,
                'product_id' => 1,
                'quantity' => 1,
                'unit_price' => 20000,
                'line_total' => 20000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kit_id' => 2,
                'product_id' => 3, // Example → Software license
                'quantity' => 1,
                'unit_price' => 10000,
                'line_total' => 10000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($kitItems as $item) {
            KitItem::updateOrInsert(
                [
                    'kit_id' => $item['kit_id'],
                    'product_id' => $item['product_id'],
                ],
                $item
            );
        }
    }
}
