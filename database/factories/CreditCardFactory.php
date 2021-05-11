<?php

namespace Database\Factories;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

class CreditCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CreditCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'card_type'=>$this->faker->creditCardType,
            'card_number'=>$this->faker->creditCardNumber,
            'exp_month'=>$this->faker->creditCardExpirationDate->format('m'),
            'exp_year'=>$this->faker->creditCardExpirationDate->format('Y')
        ];
    }
}
