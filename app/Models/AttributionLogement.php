<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AttributionLogement extends Model
{
    /** @use HasFactory<\Database\Factories\AttributionLogementFactory> */
    use HasFactory;

    protected $table = 'attributions_logement';

    protected $fillable = [
        'dossier_candidature_id',
        'appartement_id',
        'date_attribution',
        'date_debut_contrat',
        'date_fin_contrat',
        'statut_attribution',
    ];

    protected $casts = [
        'date_attribution' => 'date',
        'date_debut_contrat' => 'date',
        'date_fin_contrat' => 'date',
    ];

    public function dossierCandidature(): BelongsTo
    {
        return $this->belongsTo(DossierCandidature::class);
    }

    public function appartement(): BelongsTo
    {
        return $this->belongsTo(Appartement::class);
    }

    public function contratHabitation(): HasOne
    {
        return $this->hasOne(ContratHabitation::class, 'attribution_id');
    }

    public function etatsLieux(): HasMany
    {
        return $this->hasMany(EtatLieu::class, 'attribution_id');
    }

    public function exclusions(): HasMany
    {
        return $this->hasMany(Exclusion::class, 'attribution_id');
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class, 'attribution_id');
    }
}
