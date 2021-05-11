<?php

namespace Database\Factories;

use App\Models\EmailAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'email_address' => $this->faker->email
        ];
    }
}
