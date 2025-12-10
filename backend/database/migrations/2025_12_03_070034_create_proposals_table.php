<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            // 1. Primary Key
            $table->string('id_proposal', 50)->primary(); 
            // 2. Relasi ke Tabel Organizations (PERBAIKAN UTAMA)
            $table->string('id_organization', 20); 
            $table->foreign('id_organization')
                  ->references('id_organization') // Merujuk ke kolom id_organization
                  ->on('organizations')           // Di tabel organizations
                  ->onDelete('cascade');          // Hapus proposal jika organisasi dihapus

            // 3. Relasi ke User (Pembuat Proposal)
            // Kita gunakan cara singkat foreignId agar lebih rapi
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->onDelete('cascade');

            // 4. Data Utama
            $table->string('judul');
            $table->text('deskripsi');
            $table->dateTime('waktu_mulai'); 
            $table->dateTime('waktu_selesai'); 
            $table->string('tempat');
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->string('file_proposal'); 
            
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])
                  ->default('pending');
            
            $table->text('catatan_revisi')->nullable(); 

            // 5. Relasi ke Admin/User yang menyetujui
            $table->foreignId('approved_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); 

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