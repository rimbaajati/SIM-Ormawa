<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException; // Diperlukan untuk menangani error duplikasi

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PENTING: Menonaktifkan/Mengaktifkan Foreign Keys saat truncate
        Schema::disableForeignKeyConstraints();
        
        // Membersihkan tabel users sebelum menyisipkan data baru.
        // Jika Anda tidak ingin data terhapus, ganti dengan logic update.
        DB::table('users')->truncate(); 
        
        Schema::enableForeignKeyConstraints();

        // 1. BUAT AKUN ADMIN UTAMA (UNTUK MENGATASI 403 FORBIDDEN)
        try {
            DB::table('users')->insert([
                'name' => 'SIM Administrator',
                'email' => 'admin@sim.umpku', // Kredensial untuk login
                'password' => Hash::make('password'), 
                'role' => 'admin', // Role 'admin' harus mengatasi 403
            ]);

            // 2. BUAT AKUN MANAGER SEKUNDER (Jika dibutuhkan)
            DB::table('users')->insert([
                'name' => 'SIM Manager',
                'email' => 'manager@sim.umpku', // Kredensial untuk login
                'password' => Hash::make('password'), 
                'role' => 'manager', 
            ]);

            // 3. BUAT AKUN USER BIASA (Contoh Mahasiswa)
            DB::table('users')->insert([
                'name' => 'Mahasiswa Test',
                'email' => 'user@sim.umpku', // Kredensial untuk login
                'password' => Hash::make('password'), 
                'role' => 'user', 
            ]);

        } catch (QueryException $e) {
            // Tangani error jika terjadi duplikasi meskipun sudah di-truncate (jarang terjadi)
            echo "Error saat seeding: " . $e->getMessage() . "\n";
        }
        
        // Panggil seeder lain di sini jika ada (Contoh: OrmawaSeeder::class)
        // $this->call([
        //     OrmawaSeeder::class,
        // ]);
    }
}