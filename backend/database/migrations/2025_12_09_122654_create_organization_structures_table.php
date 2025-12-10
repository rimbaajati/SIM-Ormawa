<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_structures', function (Blueprint $table) {
            $table->id();
            $table->string('id_organization', 20);
            $table->foreign('id_organization')
                  ->references('id_organization')
                  ->on('organizations')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('id_period');
            $table->foreign('id_period')
                  ->references('id_period')
                  ->on('periods')
                  ->onDelete('cascade');
            $table->foreignId('id_ketua')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_wakilketua')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_sekretaris')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('id_bendahara')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_structures');
    }
};