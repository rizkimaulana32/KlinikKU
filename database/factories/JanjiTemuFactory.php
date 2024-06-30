<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JanjiTemu>
 */
class JanjiTemuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dokter_id' => $this->faker->numberBetween(1, 5),
            'pasien_id' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'status' => $this->faker->randomElement(['Scheduled', 'Completed']),
            'note' => $this->faker->sentence(),
        ];
    }
}
