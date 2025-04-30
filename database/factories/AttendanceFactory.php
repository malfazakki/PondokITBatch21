<?php
namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        $statuses = ['hadir', 'izin', 'alfa', 'terlambat', 'sakit', 'piket'];

        return [
            'date'   => $this->faker->dateTimeBetween('-3 months', 'now'),
            'status' => $this->faker->randomElement($statuses),
            'notes'  => $this->faker->optional(0.3)->sentence(),
        ];
    }
}
