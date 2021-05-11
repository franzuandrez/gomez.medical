<?php

namespace Database\Factories;

use App\Models\SalesOrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesOrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order_quantity = $this->faker->randomFloat(1, 10, 20);
        $unit_price = $this->faker->randomFloat(2, 21, 100);
        $unit_price_discount = $this->faker->randomFloat(2, 5, 20);

        return [
            //
            'order_quantity' => $order_quantity,
            'unit_price' => $unit_price,
            'unit_price_discount' => $unit_price_discount,
            'line_total' => ($order_quantity * $unit_price) - ($unit_price_discount * $order_quantity)
        ];
    }
}
