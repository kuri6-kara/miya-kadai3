<?php

namespace Database\Factories;

use App\Models\Weight_log;
use Illuminate\Database\Eloquent\Factories\Factory;

class Weight_logFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->(1),
            'date' => $this->faker->date(),
            'weight' => $this->faker->randomFloat(1),
            'calories' => $this->faker->randomNumber(4, true),
            'exercise_time' => $this->faker->time(),
            'exercise_content' => $this->faker->realText(),
        ];
    }
}
