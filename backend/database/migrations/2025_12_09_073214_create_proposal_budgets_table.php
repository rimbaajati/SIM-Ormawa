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
        Schema::create('proposal_budgets', function (Blueprint $table) {
            $table->id();
            // Relasi ke ID Proposal
            $table->string('id_proposal'); 
            $table->foreign('id_proposal')
                ->references('id_proposal')->on('proposals')
                ->onDelete('cascade');

            $table->string('nama_barang'); 
            $table->decimal('harga', 15, 2); // Harga Satuan
            $table->integer('jumlah'); 
            $table->decimal('subtotal', 15, 2); // Total per item
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_budgets');
    }
};
