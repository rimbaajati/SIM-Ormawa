<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            // 1. Primary Key (Angka - Wajib untuk Relasi)
            $table->id(); 

            // 2. Kode Organisasi (String Unik - UKM-001)
            $table->string('id_organization', 20)->unique(); 
            
            // 3. Data Utama
            $table->string('name');      // Nama Singkatan (HIMATIF)
            $table->string('full_name'); // Nama Lengkap (Himpunan Mahasiswa...) <-- INI YANG TADI HILANG
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            
            // 4. Struktur & Visi Misi (Bahasa Indonesia - Sesuai Controller)
            $table->string('ketua');       // Controller kirim 'ketua'
            $table->string('pembimbing')->nullable(); // Controller kirim 'pembimbing'
            $table->string('kontak');      // Controller kirim 'kontak'
            $table->string('instagram')->nullable(); // Controller kirim 'instagram'
            
            $table->text('visi')->nullable(); // Controller kirim 'visi'
            $table->text('misi')->nullable(); // Controller kirim 'misi'
            
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};