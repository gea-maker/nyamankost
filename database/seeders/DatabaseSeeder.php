<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kos;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat akun Pemilik Kos
        $pemilik = User::create([
            'name' => 'Bapak Kos',
            'email' => 'pemilik@papikost.com',
            'password' => Hash::make('password'), // password loginnya: password
            'no_hp' => '081234567890',
            'role' => 'pemilik',
        ]);

        // 2. Membuat 3 Data Kos yang terhubung ke Bapak Kos
        Kos::create([
            'id_pemilik' => $pemilik->id,
            'nama_kos' => 'Kos Mawar Merah',
            'alamat' => 'Jl. Kebon Jeruk No. 12, Jakarta Barat',
            'harga_per_bulan' => 2500000,
            'jenis_kos' => 'Campur'
        ]);

        Kos::create([
            'id_pemilik' => $pemilik->id,
            'nama_kos' => 'Kos Melati Putih',
            'alamat' => 'Jl. Dago Asri No. 8, Bandung',
            'harga_per_bulan' => 1800000,
            'jenis_kos' => 'Putri'
        ]);

        Kos::create([
            'id_pemilik' => $pemilik->id,
            'nama_kos' => 'Kos Anggrek Jingga',
            'alamat' => 'Jl. Kaliurang KM 5, Sleman',
            'harga_per_bulan' => 1200000,
            'jenis_kos' => 'Putra'
        ]);
    }
}