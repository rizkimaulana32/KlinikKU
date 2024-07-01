<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pasien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            // generate urut number 1 sampai 10
            'user_id' => $this->faker->unique()->numberBetween(1, 10), // Generate unique user_id between 1 and 10
            'birth_date' => $this->faker->date(),
            // enum gender
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'age' => $this->faker->numberBetween(18, 50),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
