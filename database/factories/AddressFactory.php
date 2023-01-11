<?php

namespace Database\Factories;


use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;




/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        return [
            'line_1'  => fake()->address(),
            'zip'     => fake()->postcode(),
            'city'    => fake()->city(),
            'state'   => fake()->country(),
            'country' => fake()->country(),
            'lat'     => fake()->latitude(),
            'long'    => fake()->longitude(),
        ];
    }
}
