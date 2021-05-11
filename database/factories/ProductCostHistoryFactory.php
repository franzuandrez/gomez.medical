<?php

namespace Database\Factories;

use App\Models\ProductCostHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCostHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCostHistory::class;

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
            'standard_cost' => $this->faker->randomFloat(2),
        ];
    }
}
