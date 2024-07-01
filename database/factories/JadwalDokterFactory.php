<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalDokter>
 */
class JadwalDokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dokter_id' => $this->faker->numberBetween(1, 8),
            'date' => $this->faker->dateTimeBetween('now', '+3 days')->format('Y-m-d'),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'status' => $this->faker->randomElement(['Available', 'Unavailable']),
        ];
    }
}
