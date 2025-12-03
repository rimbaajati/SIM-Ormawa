<?php

namespace Database\Seeders;

// database/seeders/DatabaseSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema; // <--- TAMBAHKAN INI

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // --- HAPUS DATA LAMA UNTUK MENGHINDARI KONFLIK ---
        Schema::disableForeignKeyConstraints(); // Penting jika ada Foreign Keys
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        // -------------------------------------------------

        // Masukkan logic admin Anda:
        DB::table('users')->insert([
            'name' => 'Manager Admin',
            'email' => 'manager@sim.umpku', 
            'password' => Hash::make('password'), 
            'role' => 'manager', 
        ]);

        // ... (Kode seeding lainnya)
    }
}