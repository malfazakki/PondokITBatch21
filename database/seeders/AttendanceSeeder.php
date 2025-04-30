<?php
namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = Schedule::all();
        $students  = Student::all();
        $statuses  = ['hadir', 'izin', 'alfa', 'terlambat', 'sakit', 'piket'];

        Attendance::factory()->count(1000)->make()->each(function ($attendance) use ($schedules, $students, $statuses) {
            $schedule = $schedules->random();
            $student  = $students->random();

            $attendance->schedule_id = $schedule->id;
            $attendance->student_id  = $student->id;
            $attendance->status      = $statuses[array_rand($statuses)];
            $attendance->save();
        });
    }
}
