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
        Schema::create('dossiers_candidature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->string('annee_universitaire', 20);
            $table->timestamp('date_soumission')->useCurrent();
            $table->enum('statut', ['En cours', 'Validé', 'Rejeté', 'En attente paiement', 'Attribué'])->default('En cours');
            $table->decimal('score_selection', 5, 2)->nullable();
            $table->text('commentaire_admin')->nullable();
            $table->timestamps();

            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers_candidature');
    }
};
