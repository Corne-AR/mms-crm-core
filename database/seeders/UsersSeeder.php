<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role_id' => 1, // Master Admin
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        // Key Dealer user
        DB::table('users')->updateOrInsert(
            ['email' => 'keydealer@example.com'],
            [
                'name' => 'Key Dealer User',
                'password' => Hash::make('password'),
                'role_id' => 2, // Key Dealer
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );

        // Sub Dealer user
        DB::table('users')->updateOrInsert(
            ['email' => 'subdealer@example.com'],
            [
                'name' => 'Sub Dealer User',
                'password' => Hash::make('password'),
                'role_id' => 3, // Sub Dealer
                'updated_at' => Carbon::now(),
                'created_at' => Carbon::now(),
            ]
        );
    }
}
