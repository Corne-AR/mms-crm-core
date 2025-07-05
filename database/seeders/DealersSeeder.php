<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DealerRegion; // this is your dealer_regions model

class DealersSeeder extends Seeder
{
    public function run(): void
    {
        $Dealers = [
            [
                'name' => 'Dealer 1',
                'email' => 'Dealer1@example.com',
                'password' => bcrypt('password'), // add password!
                'phone' => '1234567890',
                'address' => '123 Main St, City, Country',
                'banking_details' => 'Bank XYZ, Account 123456789',
                'vat_number' => 'VAT123456',
                'logo_path' => 'logos/Dealer1.png',
                'region_name' => 'Region A',
            ],
            [
                'name' => 'Dealer 2',
                'email' => 'Dealer2@example.com',
                'password' => bcrypt('password'), // add password!
                'phone' => '9876543210',
                'address' => '456 Another St, City, Country',
                'banking_details' => 'Bank ABC, Account 654321987',
                'vat_number' => 'VAT654321',
                'logo_path' => 'logos/Dealer2.png',
                'region_name' => 'Region B',
            ],
        ];

        foreach ($Dealers as $dealer) {
            $region = DealerRegion::where('name', $dealer['region_name'])->first();

            User::create([
                'name' => $dealer['name'],
                'email' => $dealer['email'],
                'password' => $dealer['password'],
                'phone' => $dealer['phone'],
                'address' => $dealer['address'],
                'banking_details' => $dealer['banking_details'],
                'vat_number' => $dealer['vat_number'],
                'logo_path' => $dealer['logo_path'],
                'role' => 'sub_dealer',
                'region_id' => $region ? $region->id : null, // safe fallback
            ]);
        }
    }
}
