<?php

namespace Database\Factories;

use App\Models\ProductListPriceHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductListPriceHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductListPriceHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'start_date' => $this->faker->dateTimeThisMonth,
            'end_date' => $this->faker->dateTimeThisMonth->add(new \DateInterval('P1Y')),
            'list_price' => $this->faker->randomFloat(2),
        ];
    }
}
