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
        Schema::create('etats_lieux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribution_id')->constrained('attributions_logement')->onDelete('cascade');
            $table->enum('type_etat', ['Entrée', 'Sortie']);
            $table->date('date_etat');
            $table->text('observation_generale')->nullable();
            $table->string('agent_responsable', 100)->nullable();
            $table->string('signature_etudiant_path', 255)->nullable();
            $table->string('signature_agent_path', 255)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etats_lieux');
    }
};
