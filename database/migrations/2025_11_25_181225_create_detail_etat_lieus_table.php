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
        Schema::create('details_etat_lieux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etat_lieu_id')->constrained('etats_lieux')->onDelete('cascade');
            $table->string('element', 100);
            $table->enum('etat', ['Neuf', 'Bon', 'Moyen', 'Dégradé', 'Détérioré'])->nullable();
            $table->text('observations')->nullable();
            $table->string('photo_path', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_etat_lieux');
    }
};
