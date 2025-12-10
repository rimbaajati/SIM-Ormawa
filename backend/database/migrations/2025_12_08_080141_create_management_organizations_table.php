<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('management_organizations', function (Blueprint $table) {
            $table->id(); // Primary Key tabel ini sendiri
            $table->string('id_organization', 20);
            $table->unsignedBigInteger('id_period');
            $table->foreign('id_organization')
                  ->references('id_organization') 
                  ->on('organizations')
                  ->onDelete('cascade');
            $table->foreign('id_period')
                  ->references('id_period') 
                  ->on('periods')
                  ->onDelete('cascade');
            $table->string('ketua');
            $table->string('pembimbing')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('sk_file')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('management_organizations');
    }
};