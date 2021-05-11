<?php

namespace Database\Factories;

use App\Models\PhoneNumberType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneNumberTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhoneNumberType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->boolean ? 'Home' : 'Office'
        ];
    }
}
