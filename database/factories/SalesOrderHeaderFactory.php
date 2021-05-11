<?php

namespace Database\Factories;

use App\Models\SalesOrderHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesOrderHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesOrderHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        $subtotal = $this->faker->randomFloat(2, 1, 100);
        $tax_amount_percent = 0.12;
        return [
            //
            'order_date' => $this->faker->dateTime,
            'status' => $this->faker->randomFloat(0, 1, 6),
            'online_order_flag' => $this->faker->boolean,
            'sales_order_number' => $this->faker->uuid,
            'payment_type' => $this->faker->boolean ? 'cash' : 'credit card',
            'subtotal' => $subtotal - ($subtotal * $tax_amount_percent),
            'tax_amount' => $subtotal * $tax_amount_percent,
            'freight' => 0,
            'total_due' => $subtotal,
            'comments' => $this->faker->text
        ];
    }
}
