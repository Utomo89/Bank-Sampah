<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SetoranSampah;
use App\Models\User;
use App\Models\JenisSampah;

class SetoranSampahSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user biasa (role = user)
        $users = User::where('role', 'user')->get();
        $jenisSampah = JenisSampah::all();

        // Jika belum ada data user atau jenis sampah, hentikan dulu
        if ($users->isEmpty() || $jenisSampah->isEmpty()) {
            $this->command->warn('Seeder SetoranSampah dilewati karena data user/jenis sampah belum ada.');
            return;
        }

        // Buat data setoran dummy
        foreach ($users as $user) {
            // Buat 3 setoran per user
            foreach (range(1, 3) as $i) {
                $jenis = $jenisSampah->random();
                $berat = fake()->randomFloat(2, 0.5, 5); // antara 0.5 kg - 5 kg
                $total = $berat * $jenis->harga_per_kg;

                SetoranSampah::create([
                    'user_id' => $user->id,
                    'jenis_sampah_id' => $jenis->id,
                    'berat' => $berat,
                    'total_harga' => $total,
                    'status' => fake()->randomElement(['pending', 'disetujui', 'ditolak']),
                ]);
            }
        }
    }
}
