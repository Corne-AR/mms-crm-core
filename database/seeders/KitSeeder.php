<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kit;
use Carbon\Carbon;

class KitSeeder extends Seeder
{
    public function run(): void
    {
        $kits = [
            [
                'name' => 'Surveyor Starter Kit',
                'description' => 'Includes receiver, tripod, software license.',
                'price' => 50000,
                'vat_applicable' => 1,
                'discount_allowed' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Advanced Surveyor Kit',
                'description' => 'Full kit with extra accessories.',
                'price' => 80000,
                'vat_applicable' => 1,
                'discount_allowed' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        foreach ($kits as $kit) {
            Kit::updateOrInsert(
                ['name' => $kit['name']],
                $kit
            );
        }
    }
}
