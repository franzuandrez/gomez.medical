<?php

namespace Database\Factories;

use App\Models\SalesReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name'=>$this->faker->word,
            'reason_type'=>$this->faker->word
        ];
    }
}
