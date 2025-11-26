<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DossierCandidature extends Model
{
    /** @use HasFactory<\Database\Factories\DossierCandidatureFactory> */
    use HasFactory;

    protected $table = 'dossiers_candidature';

    protected $fillable = [
        'etudiant_id',
        'annee_universitaire',
        'date_soumission',
        'statut',
        'score_selection',
        'commentaire_admin',
    ];

    protected $casts = [
        'date_soumission' => 'datetime',
        'score_selection' => 'decimal:2',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function attributionLogement(): HasOne
    {
        return $this->hasOne(AttributionLogement::class);
    }
}
