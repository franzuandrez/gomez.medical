<?php

namespace Database\Factories;

use App\Models\PersonPhone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonPhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonPhone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'phone_number' => $this->faker->phoneNumber
        ];
    }
}
