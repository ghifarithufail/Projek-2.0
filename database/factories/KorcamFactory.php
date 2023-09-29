<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Korcam>
 */
class KorcamFactory extends Factory
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
            'kabkota_id' => 12,
            'tgl_lahir'=> $this->faker->dateTime(),
            'alamat'=> $this->faker->address(),
            'rt'=> $this->faker->randomDigitNotNull(),
            'rw'=>$this->faker->randomDigitNotNull(),
            'kelurahan_id'=> 5,
            'status' => 2,
            'keterangan' => 3,
            'user_id' => 2,
            'kelurahan_id'=> 7,
        ];
    }
}
