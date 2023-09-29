<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Anggota;
use App\Models\Korcam;
use App\Models\Korhan;
use App\Models\KorTps;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(8200)->create();

        // Anggota::factory(70000)->create();
        // Korcam::factory(1000)->create();
        // Korhan::factory(3000)->create();
        // KorTps::factory(5000)->create();
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
