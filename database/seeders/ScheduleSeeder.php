<?php
namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::all()->each(function ($class) {
            $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

            foreach ($days as $day) {
                for ($session = 1; $session <= 4; $session++) {
                    $teacher = Teacher::inRandomOrder()->first();
                    $subject = $teacher->subjects()->inRandomOrder()->first();

                    Schedule::create([
                        'class_id'   => $class->id,
                        'subject_id' => $subject->id,
                        'teacher_id' => $teacher->id,
                        'day'        => $day,
                        'start_time' => sprintf('%02d:00:00', 7 + ($session - 1) * 2),
                        'end_time'   => sprintf('%02d:00:00', 9 + ($session - 1) * 2),
                    ]);
                }
            }
        });
    }
}
