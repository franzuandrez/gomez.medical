<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

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
            'color' => $this->faker->colorName,
            'safety_stock_level' => $this->faker->numberBetween(50, 150),
            'size' => $this->faker->word,
            'weight' => $this->faker->numberBetween(1, 10),
            'instructions' => $this->faker->text
        ];
    }
}
