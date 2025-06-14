<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomersSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            [
                'company_name' => 'Acme Corporation',
                'contact_person' => 'John Doe',
                'email' => 'john.doe@acme.com',
                'phone' => '+1234567890',
                'vat_number' => 'VAT123456',
                'vendor_number' => 'VENDOR001',
                'catagory' => 'Retail', // Assuming typo should be "category" — but keeping as per your DB field
                'type' => 'Business',
                'language' => 'English',
                'currency' => 'USD',
                'address' => '123 Main Street, Springfield, USA',
            ],
            [
                'company_name' => 'Globex Ltd',
                'contact_person' => 'Jane Smith',
                'email' => 'jane.smith@globex.com',
                'phone' => '+9876543210',
                'vat_number' => 'VAT654321',
                'vendor_number' => 'VENDOR002',
                'catagory' => 'Wholesale',
                'type' => 'Business',
                'language' => 'English',
                'currency' => 'EUR',
                'address' => '456 Market Road, Berlin, Germany',
            ],
            // Add more customers as needed
        ];

        foreach ($customers as $data) {
            Customer::create($data);
        }
    }
}
