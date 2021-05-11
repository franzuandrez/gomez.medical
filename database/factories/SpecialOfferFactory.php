<?php

namespace Database\Factories;

use App\Models\SpecialOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'description' => $this->faker->word,
            'discount_pct' => $this->faker->randomFloat(2, 10, 25),
            'type'=>$this->faker->word,
            'category'=>$this->faker->word,
            'start_date'=>$this->faker->dateTimeThisMonth,
            'end_date'=>$this->faker->dateTimeThisMonth->add(new \DateInterval('P1Y')),
            'min_qty'=>$this->faker->randomFloat(1, 10, 12),
            'max_qty'=>$this->faker->randomFloat(1, 23, 25),
        ];
    }
}
