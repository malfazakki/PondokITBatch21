<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['ula', 'wustha', 'ulya'];
        $level  = $this->faker->randomElement($levels);
        $class  = $this->faker->numberBetween(1, 3);

        return [
            'name'  => ucfirst($level) . ' ' . $class,
            'level' => $level,
        ];
    }
}
