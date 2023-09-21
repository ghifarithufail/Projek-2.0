<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique->randomNumber(9, true),
            'nokk' => $this->faker->unique->randomNumber(9, true),
            'nama_anggota'=> $this->faker->name(),
            'kabkota_id' => 1,
            'tgl_lahir' => $this->faker->dateTime(),
            'alamat' => $this->faker->address(),
            'rt'=> $this->faker->randomDigitNotNull(),
            'rw'=> $this->faker->randomDigitNotNull(),
            'tpsrw_id'=> 1,
            'phone' => $this->faker->unique->randomNumber(9, true),
            'status'=> '1',
            'keterangan'=>'test',
            'koordinator_id'=> 1,
            'created_at'     => '2023-09-21 12:16:40'
        ];
    }
}
