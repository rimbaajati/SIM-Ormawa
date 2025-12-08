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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('id_organization', 20)->unique();
            $table->string('name')->unique();
            $table->string('full_name')->nullable();
            $table->string('logo')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable(); 
            $table->string('ketua')->nullable();
            $table->string('pembimbing')->nullable();
            $table->string('kontak')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('instagram')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
