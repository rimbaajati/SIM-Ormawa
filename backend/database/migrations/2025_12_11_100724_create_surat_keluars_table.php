<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_keluars', function (Blueprint $table) {
            $table->id(); 
            
            // 1. Relasi ke Organisasi (Pemilik Surat)
            $table->foreignId('id_organization')
                  ->constrained('organizations')
                  ->onDelete('cascade');

            // 2. Relasi ke Jenis Surat
            $table->foreignId('id_jenis_surat')
                  ->constrained('jenis_surats')
                  ->onDelete('cascade');

            // 3. Data Surat Keluar
            $table->string('kepada');  // Penerima Surat (Penting!)
            $table->date('tanggal');   // Tanggal Surat
            $table->string('perihal'); // Isi Ringkas
            $table->string('file');    // Path File PDF
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};