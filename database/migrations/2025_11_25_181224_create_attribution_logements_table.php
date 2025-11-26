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
        Schema::create('attributions_logement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dossier_candidature_id')->constrained('dossiers_candidature')->onDelete('cascade');
            $table->foreignId('appartement_id')->constrained('appartements');
            $table->date('date_attribution');
            $table->date('date_debut_contrat');
            $table->date('date_fin_contrat');
            $table->enum('statut_attribution', ['Actif', 'Terminé', 'Résilié'])->default('Actif');
            $table->timestamps();

            $table->index('appartement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributions_logement');
    }
};
