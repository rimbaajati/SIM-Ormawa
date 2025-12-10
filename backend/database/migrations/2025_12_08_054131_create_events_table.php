<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('id_organization', 20);
            $table->foreign('id_organization')
                  ->references('id_organization') // Tunjuk ke kolom PK baru
                  ->on('organizations')
                  ->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('poster')->nullable(); // Jika ada upload poster
            $table->dateTime('event_date');
            $table->string('location');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};