<?php

namespace Database\Factories;

use App\Models\InventoryMovement;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryMovementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryMovement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'quantity' => $this->faker->randomFloat(0, 10, 40),

        ];
    }
}
