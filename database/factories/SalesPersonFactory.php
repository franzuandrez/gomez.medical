<?php

namespace Database\Factories;

use App\Models\SalesPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesPersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesPerson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'sales_quota' => $this->faker->randomFloat(2, 1000, 2000),
            'bonus'=>$this->faker->randomFloat(2, 1000, 2000),
            'commission_pct'=>$this->faker->randomFloat(2,10,15),
        ];
    }
}
