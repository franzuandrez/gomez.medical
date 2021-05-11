<?php

namespace Database\Factories;

use App\Models\PurchaseOrderHeader;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseOrderHeaderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrderHeader::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $subtotal = $this->faker->randomFloat(2, 1, 100);
        $tax_amount_percent = 0.12;
        return [
            //
            'status' => $this->faker->randomFloat(0, 1, 4),
            'order_date' => $this->faker->dateTime,
            'subtotal' => $subtotal - ($subtotal * $tax_amount_percent),
            'tax_amount' => $subtotal * $tax_amount_percent,
            'freight' => 0,
            'total_due' => $subtotal,
        ];
    }
}
