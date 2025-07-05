<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Dealer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserDealerAssignmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_factory_assigns_dealer_id()
    {
        // 1) Create a dealer
        $dealer = Dealer::factory()->create();

        // 2) Create a user, explicitly passing dealer_id
        $user = User::factory()->create([
            'dealer_id' => $dealer->id,
        ]);

        // 3) Assert in the database that the user has the correct dealer_id
        $this->assertDatabaseHas('users', [
            'id'        => $user->id,
            'dealer_id' => $dealer->id,
        ]);
    }
}
