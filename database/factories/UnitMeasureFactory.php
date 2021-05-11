<?php

namespace Database\Factories;

use App\Models\UnitMeasure;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitMeasureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnitMeasure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->word
        ];
    }
}
