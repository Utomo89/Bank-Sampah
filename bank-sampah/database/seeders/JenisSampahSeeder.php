<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisSampah;
class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $now = now();
        $data = [
            ['nama' => 'Plastik', 'harga_per_kg' => 3000, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Kertas', 'harga_per_kg' => 2000, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Logam', 'harga_per_kg' => 5000, 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Kaca', 'harga_per_kg' => 4000, 'created_at' => $now, 'updated_at' => $now],
        ];

        JenisSampah::insert($data);
    }
}
