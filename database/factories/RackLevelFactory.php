<?php

namespace Database\Factories;

use App\Models\RackLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RackLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RackLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->randomFloat(0, 1, 5)
        ];
    }
}
