<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Master Admin
        DB::table('user_roles')->updateOrInsert(
            ['role_name' => 'Master Admin'],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Key Dealer
        DB::table('user_roles')->updateOrInsert(
            ['role_name' => 'Key Dealer'],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Sub-Dealer
        DB::table('user_roles')->updateOrInsert(
            ['role_name' => 'Sub-Dealer'],
            [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
