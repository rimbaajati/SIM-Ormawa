<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->string('id_proposal', 50)->primary(); // Misal: PROP-001
            // 2. Relasi ke Tabel Organizations 
            $table->unsignedBigInteger('id_organization');
            $table->unsignedBigInteger('id_user');   
            // 4. Data Utama
            $table->string('judul');
            $table->text('deskripsi');
            $table->dateTime('waktu');
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