<?php
namespace Database\Seeders;

use App\Models\Room;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 students
        Student::factory(50)->create()->each(function ($student) {
            // Assign each student to a random rooms
            $student->rooms()->attach(Room::inRandomOrder()->first());
        });
    }
}
