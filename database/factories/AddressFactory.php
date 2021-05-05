<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'address_line_1'=>$this->faker->address,
            'address_line_2'=>$this->faker->secondaryAddress,
            'city'=>$this->faker->city,
            'postal_code'=>$this->faker->postcode,
            'latitude'=>$this->faker->latitude,
            'longitude'=>$this->faker->longitude,
        ];
    }
}
