<?php

namespace Database\Factories;

use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrderDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $unit_price = $this->faker->randomFloat(2, 20, 100);
        $order_quantity = $this->faker->randomFloat(0, 1, 100);
        $received_quantity = $this->faker->randomFloat(1, 1, $order_quantity);
        return [
            //
            'due_date' => $this->faker->dateTimeThisMonth,
            'order_quantity' => $order_quantity,
            'unit_price' => $unit_price,
            'line_total' => $unit_price * $order_quantity,
            'received_quantity' => $received_quantity,
            'rejected_quantity' => 0,
            'stocked_quantity' => $received_quantity
        ];
    }
}
