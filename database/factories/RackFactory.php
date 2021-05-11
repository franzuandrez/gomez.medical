<?php

namespace Database\Factories;

use App\Models\Rack;
use Illuminate\Database\Eloquent\Factories\Factory;

class RackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rack::class;

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
