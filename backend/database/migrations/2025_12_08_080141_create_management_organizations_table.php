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
        Schema::create('management_organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_organization')->constrained('organizations')->onDelete('cascade');
            $table->foreignId('period_id')->constrained('periods')->onDelete('cascade');
            // Data yang berubah tiap tahun
            $table->string('ketua');
            $table->string('pembimbing')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('sk_file')->nullable(); // Tambahan (Opsional): SK Kepengurusan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_organizations');
    }
};
