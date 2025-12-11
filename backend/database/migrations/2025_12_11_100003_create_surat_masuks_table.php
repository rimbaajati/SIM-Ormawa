<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuks', function (Blueprint $table) {
            // 1. Primary Key
            $table->id(); 
            
            // 2. Relasi ke Organisasi (Wajib ada)
            $table->foreignId('id_organization')
                  ->constrained('organizations')
                  ->onDelete('cascade');

            // 3. Relasi ke Jenis Surat (SK, Undangan, dll)
            // Ini akan terhubung ke tabel yang baru saja Anda buat
            $table->foreignId('id_jenis_surat')
                  ->constrained('jenis_surats')
                  ->onDelete('cascade');

            // 4. Data Surat Masuk
            $table->date('tanggal');   // Tanggal Surat
            $table->string('asal');    // Pengirim / Asal Surat
            $table->string('perihal'); // Isi ringkas / Judul
            $table->string('file');    // Path file PDF/Gambar
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};