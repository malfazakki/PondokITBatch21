<?php
namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Student;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::factory(8)->create()->each(function ($class) {
            // Assign random student to a class
            $students = Student::inRandomOrder()
                ->take(rand(5, 10))
                ->pluck('id');

            $class->students()->attach($students);
        });
    }
}
