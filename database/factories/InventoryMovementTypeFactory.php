<?php

namespace Database\Factories;

use App\Models\InventoryMovementType;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryMovementTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryMovementType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //

            'name' => $this->faker->word,
            'factor' => $this->faker->boolean ? 1 : -1
        ];
    }
}
