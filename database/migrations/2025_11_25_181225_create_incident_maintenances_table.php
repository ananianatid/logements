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
        Schema::create('incidents_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appartement_id')->constrained('appartements')->onDelete('cascade');
            $table->foreignId('etudiant_id')->nullable()->constrained('etudiants');
            $table->string('type_incident', 100);
            $table->text('description');
            $table->enum('priorite', ['Faible', 'Moyenne', 'Haute', 'Urgente'])->nullable();
            $table->enum('statut', ['Signalé', 'En cours', 'Résolu', 'Clôturé'])->default('Signalé');
            $table->timestamp('date_signalement')->useCurrent();
            $table->timestamp('date_resolution')->nullable();
            $table->string('technicien_assigne', 100)->nullable();
            $table->decimal('cout_reparation', 10, 2)->nullable();
            $table->timestamps();

            $table->index('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents_maintenance');
    }
};
