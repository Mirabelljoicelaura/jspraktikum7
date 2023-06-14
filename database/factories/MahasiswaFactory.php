<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nim'=>$this->faker->randomNumber(9, true),
            'Nama'=>$this->faker->name(),
            'Email'=>$this->faker->email(),
            'Tanggal_Lahir'=>$this->faker->date(),
            'kelas_id' => $this->faker->numberBetween(1, 9),
            'Jurusan'=>$this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi Bisnis']),
            'No_Handphone'=>$this->faker->randomNumber(9, true),
        ];

    }
}
