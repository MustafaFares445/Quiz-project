<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question_title' => $this->faker->text() . '?',
            'question_type' => $this->faker->randomElement(['true/false' , 'multiple-choice' , 'choose-one']),
            'score' => rand(1 , 10),
        ];
    }
}
