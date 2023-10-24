<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'user',
             'email' => 'user@gmail.com',
         ]);

        Student::factory(5)->create();
        Question::factory(20)->create();
        Choice::factory(100)->create();
        Answer::factory(25)->create();
    }
}
