<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'national_id_number' => $this->faker->creditCardNumber,
            'login_id' => $this->faker->randomDigit,
            'job_title' => $this->faker->jobTitle,
            'birth_date' => $this->faker->dateTime,
            'marital_status' => $this->faker->boolean ? 'Single' : 'Married',
            'gender' => $this->faker->boolean ? 'M' : 'F',
            'hired_date' => $this->faker->dateTimeThisDecade
        ];
    }
}
