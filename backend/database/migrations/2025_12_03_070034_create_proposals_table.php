<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id(); // 1. PRIMARY KEY UTAMA (Angka Auto Increment)
            $table->string('id_proposal', 50)->unique(); // 2. ID PROPOSAL (String PROP/...)
            $table->foreignId('id_organization') // 3. RELASI ORGANISASI
                  ->constrained('organizations') // Otomatis cari id di tabel organizations
                  ->onDelete('cascade');
            $table->foreignId('id_user') // 4. RELASI USER
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('judul'); // 5. DATA LAINNYA
            $table->text('deskripsi');
            $table->dateTime('waktu_mulai'); 
            $table->dateTime('waktu_selesai'); 
            $table->string('tempat');
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->string('file_proposal'); 
            $table->enum('status', ['pending', 'approved', 'rejected', 'revision'])
                  ->default('pending');
            $table->text('catatan_revisi')->nullable(); 
            $table->foreignId('approved_by') // 6. APPROVER
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};