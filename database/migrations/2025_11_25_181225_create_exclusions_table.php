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
        Schema::create('exclusions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('attribution_id')->nullable()->constrained('attributions_logement');
            $table->string('motif', 100);
            $table->text('description_motif')->nullable();
            $table->date('date_decision');
            $table->enum('statut_exclusion', ['En cours', 'Effective', 'Annulée'])->default('En cours');
            $table->date('date_effective')->nullable();
            $table->string('agent_responsable', 100)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusions');
    }
};
