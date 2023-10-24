<?php

namespace Database\Factories;

use App\Models\Choice;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first(),
            'choice_id' => $choice = Choice::inRandomOrder()->first(),
            'correct' => $choice->correct,
        ];
    }
}
