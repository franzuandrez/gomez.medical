<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $person_types = [
            'SC',
            'IN',
            'SP',
            'EM',
            'VC',
            'GC'
        ];

        return [
            //
            'person_type' => $person_types[$this->faker->numberBetween(0, 5)],
            'title' => $this->faker->title,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'suffix' => $this->faker->boolean ? 'Jr' : 'Sr'
        ];
    }
}
