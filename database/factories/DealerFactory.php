<?php

namespace Database\Factories;

use App\Models\Dealer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dealer>
 */
class DealerFactory extends Factory
{
    /**
     * The corresponding model for this factory.
     *
     * @var string
     */
    protected $model = Dealer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'dealer_name'    => $this->faker->company(),
            'contact_person' => $this->faker->name(),
            'email'          => $this->faker->unique()->companyEmail(),
            'phone'          => $this->faker->phoneNumber(),
            'address'        => $this->faker->address(),
            'type'           => 'key_dealer',
            'bank_details'   => $this->faker->iban(),
        ];
    }
}
