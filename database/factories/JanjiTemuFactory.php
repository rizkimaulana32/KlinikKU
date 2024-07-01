<?php

namespace Database\Factories;

use App\Models\JadwalDokter;
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
        // Fetch a random existing JadwalDokter record
        $jadwalDokter = JadwalDokter::inRandomOrder()->first();

        // Update JadwalDokter status to 'Unavailable'
        $jadwalDokter->update(['status' => 'Unavailable']);

        return [
            'dokter_id' => $jadwalDokter->dokter_id,
            'pasien_id' => $this->faker->numberBetween(1, 10),
            'date' => $jadwalDokter->date,
            'start_time' => $jadwalDokter->start_time,
            'end_time' => $jadwalDokter->end_time,
            'status' => $this->faker->randomElement(['Scheduled', 'Completed']),
            'note' => $this->faker->sentence(),
        ];
    }
}
