<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'account_number' => $this->faker->bankAccountNumber,
            'name' => $this->faker->word,
            'credit_rating' => $this->faker->randomDigit,
            'preferred_vendor_status' => $this->faker->randomDigit,
            'active_flag' => $this->faker->boolean ? '1' : '0',
            'url_web' => 'https://' . $this->faker->word . '.com',
        ];
    }
}
