<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'user_id' => $this->faker->unique()->numberBetween(11, 18), // Generate unique user_id between 1 and 10
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'age' => $this->faker->numberBetween(18, 80),
            'spesialis' => $this->faker->jobTitle,
            'phone' => $this->faker->phoneNumber,
            'image' => $this->faker->imageUrl(600, 600),
        ];
    }
}
