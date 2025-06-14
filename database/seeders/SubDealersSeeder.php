<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SubDealerRegion; // this is your sub_dealer_regions model

class SubDealersSeeder extends Seeder
{
    public function run(): void
    {
        $subDealers = [
            [
                'name' => 'SubDealer 1',
                'email' => 'subdealer1@example.com',
                'password' => bcrypt('password'), // add password!
                'phone' => '1234567890',
                'address' => '123 Main St, City, Country',
                'banking_details' => 'Bank XYZ, Account 123456789',
                'vat_number' => 'VAT123456',
                'logo_path' => 'logos/subdealer1.png',
                'region_name' => 'Region A',
            ],
            [
                'name' => 'SubDealer 2',
                'email' => 'subdealer2@example.com',
                'password' => bcrypt('password'), // add password!
                'phone' => '9876543210',
                'address' => '456 Another St, City, Country',
                'banking_details' => 'Bank ABC, Account 654321987',
                'vat_number' => 'VAT654321',
                'logo_path' => 'logos/subdealer2.png',
                'region_name' => 'Region B',
            ],
        ];

        foreach ($subDealers as $dealer) {
            $region = SubDealerRegion::where('name', $dealer['region_name'])->first();

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
