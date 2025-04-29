<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = [
            'FQH' => 'Fiqih',
            'AQD' => 'Aqidah',
            'HDT' => 'Hadits',
            'TFS' => 'Tafsir',
            'NHW' => 'Nahwu',
            'SRF' => 'Shorof',
            'AKH' => 'Akhlaq',
            'TRK' => 'Tarikh',
        ];

        $code = $this->faker->randomElement(array_keys($subjects));

        return [
            'code' => $code,
            'name' => $subjects[$code],
        ];
    }
}
