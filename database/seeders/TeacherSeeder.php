<?php
namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::factory(15)->create()->each(function ($teacher) {
            // Assign 1-3 random subjects to each teacher
            $teacher->subjects()->attach(
                Subject::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });
    }
}
