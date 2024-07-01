<?php

namespace Database\Factories;

use App\Models\JanjiTemu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RekamMedis>
 */
class RekamMedisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fetch a random JanjiTemu record with status 'Completed'
        $completedJanjiTemu = JanjiTemu::where('status', 'Completed')->inRandomOrder()->first();

        return [
            'pasien_id' => $completedJanjiTemu->pasien_id,
            'janji_temu_id' => $completedJanjiTemu->id,
            'diagnosis' => $this->faker->sentence(),
            'tindakan' => $this->faker->sentence(),
            'obat' => $this->faker->sentence(),
        ];
    }
}
