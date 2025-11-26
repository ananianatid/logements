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
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenoms', 150);
            $table->string('email', 150)->unique();
            $table->string('telephone', 20)->nullable();
            $table->enum('sexe', ['Masculin', 'Féminin', 'Autre'])->nullable();
            $table->enum('situation_familiale', ['Célibataire', 'Marié(e)', 'Avec enfants'])->nullable();
            $table->date('date_obtention_baccalaureat');
            $table->string('matricule', 50)->unique();
            $table->string('handicap', 100)->nullable();
            $table->string('photo_profil', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etudiants');
    }
};
