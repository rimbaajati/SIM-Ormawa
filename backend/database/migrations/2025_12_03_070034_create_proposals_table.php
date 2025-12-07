<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            // 1. Identitas Proposal (Unik)
            $table->string('nomor_proposal')->unique()->nullable(); // Misal: PROP-001
            // 2. Relasi ke Tabel Organizations (PENTING!)
            $table->foreignId('organization_id')
                  ->constrained('organizations')
                  ->onDelete('cascade'); 
            // 3. Relasi ke User (Siapa yang upload)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            // 4. Data Utama
            $table->string('judul');
            $table->text('deskripsi');
            $table->dateTime('waktu'); // Tanggal & Jam Mulai
            $table->string('tempat');
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->string('file_proposal'); // Path file PDF
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])
                  ->default('pending');
            $table->text('catatan_revisi')->nullable(); // Alasan jika ditolak/revisi
            $table->foreignId('approved_by') // Siapa admin yang menyetujui?
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); // Jika admin dihapus, data proposal tetap ada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};