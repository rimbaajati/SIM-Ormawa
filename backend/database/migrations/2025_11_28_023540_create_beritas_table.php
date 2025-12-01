<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('isi');
        $table->text('ringkasan')->nullable();
        $table->string('gambar')->nullable(); // Untuk simpan nama file
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa penulisnya
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
