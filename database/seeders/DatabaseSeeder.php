<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Run seeders in correct order:

        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            //PermissionsSeeder::class,
            PaymentMethodsSeeder::class,
            CustomersSeeder::class,
            ProductsSeeder::class,
            KitSeeder::class,
            TermsSeeder::class,
            QuoteNumberSeeder::class,
            InvoiceNumberSeeder::class,
            SettingsSeeder::class,
            SystemSettingsSeeder::class,
            SubDealersSeeder::class,
        ]);
    }
}
