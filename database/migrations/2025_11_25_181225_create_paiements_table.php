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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('attribution_id')->nullable()->constrained('attributions_logement');
            $table->enum('type_paiement', ['Caution', 'Loyer', 'Pénalité', 'Réparation']);
            $table->decimal('montant', 10, 2);
            $table->enum('methode_paiement', ['Flooz', 'Mixx', 'Xpress', 'Virement bancaire', 'Espèces'])->nullable();
            $table->string('reference_transaction', 100)->nullable()->unique();
            $table->enum('statut_paiement', ['En attente', 'Validé', 'Échoué', 'Remboursé'])->default('En attente');
            $table->timestamp('date_paiement')->useCurrent();
            $table->string('mois_concerne', 20)->nullable();
            $table->string('recu_path', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('statut_paiement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
