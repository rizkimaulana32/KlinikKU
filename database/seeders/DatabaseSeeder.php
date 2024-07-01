<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\JadwalDokter;
use App\Models\JanjiTemu;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Database\Factories\UserDokterFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create pasien (1-10)
        User::factory(10)->create();
        Pasien::factory(10)->create();

        // create dokter (11-18)
        User::factory(8)->create(
            [
                'role' => 'dokter',
            ]
        );
        Dokter::factory(8)->create();

        User::factory()->create([
            'username' => 'admin',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        JadwalDokter::factory(40)->create();
        JanjiTemu::factory(15)->create();
        RekamMedis::factory(10)->create();
    }
}

// INSERT INTO jadwal_dokters (dokter_id, date, start_time, end_time, status)
// VALUES
//     (1, '2024-06-10', '08:00:00', '12:00:00', available), -- 1 for Active, assuming true
//     (2, '2024-06-11', '09:30:00', '15:00:00', available),
//     (1, '2024-06-12', '10:00:00', '14:00:00', unavailable), -- 0 for Inactive, assuming false
//     (3, '2024-06-13', '11:00:00', '16:30:00', available);
