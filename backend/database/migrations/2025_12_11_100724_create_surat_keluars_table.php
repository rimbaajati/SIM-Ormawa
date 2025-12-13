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
            $table->foreignId('id_organization')
                  ->constrained('organizations')
                  ->onDelete('cascade');
            $table->foreignId('id_jenis_surat')
                  ->constrained('jenis_surats')
                  ->onDelete('cascade');
            $table->foreignId('tujuan_organization_id')
                  ->nullable() 
                  ->constrained('organizations')
                  ->onDelete('set null');
            $table->string('kepada')->nullable();  
            $table->date('tanggal');  
            $table->string('perihal'); 
            $table->string('file');   
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_keluars');
    }
};