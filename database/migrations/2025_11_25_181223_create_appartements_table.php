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
        Schema::create('appartements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batiment_id')->constrained('batiments')->onDelete('cascade');
            $table->string('numero', 20);
            $table->integer('etage');
            $table->enum('type_appartement', ['Studio', 'T1', 'T2', 'Chambre partagée'])->nullable();
            $table->integer('capacite_personnes')->default(1);
            $table->boolean('disponibilite')->default(true);
            $table->enum('etat', ['Neuf', 'Bon', 'Moyen', 'Nécessite réparations', 'Hors service'])->default('Bon');
            $table->decimal('superficie', 6, 2)->nullable();
            $table->decimal('loyer_mensuel', 10, 2);
            $table->timestamps();

            $table->unique(['batiment_id', 'numero']);
            $table->index('disponibilite');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appartements');
    }
};
