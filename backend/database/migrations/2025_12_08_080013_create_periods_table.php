<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id('id_period');
            $table->string('name'); // Contoh: "2024/2025"
            $table->date('start_date'); // Awal periode
            $table->date('end_date');   // Akhir periode
            $table->boolean('is_active')->default(false); // Penanda periode aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
