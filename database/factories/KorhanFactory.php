<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Korhan>
 */
class KorhanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_koordinator'=> $this->faker->name,
            'phone'=> $this->faker->unique->randomNumber(9, true),
            'nik' => $this->faker->unique->randomNumber(9, true),
            'nokk' => $this->faker->unique->randomNumber(9, true),
            'kabkota_id' => 25,
            'tgl_lahir'=> $this->faker->dateTime(),
            'alamat'=> $this->faker->address(),
            'rt'=> $this->faker->randomDigitNotNull(),
            'rw'=>$this->faker->randomDigitNotNull(),
            'kelurahan_id'=> 20,
            'status' => 1,
            'keterangan' => 1,
            'user_id' => 1,
            'kelurahan_id'=> 28,
            'korcam_id' => 1,
        ];
    }
}
