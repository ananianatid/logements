<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'telephone',
        'sexe',
        'situation_familiale',
        'date_obtention_baccalaureat',
        'matricule',
        'handicap',
        'photo_profil',
    ];

    protected $casts = [
        'date_obtention_baccalaureat' => 'date',
    ];

    public function dossiersCandidature(): HasMany
    {
        return $this->hasMany(DossierCandidature::class);
    }

    public function antecedentsLogement(): HasMany
    {
        return $this->hasMany(AntecedentLogement::class);
    }

    public function justificatifs(): HasMany
    {
        return $this->hasMany(Justificatif::class);
    }

    public function exclusions(): HasMany
    {
        return $this->hasMany(Exclusion::class);
    }

    public function incidentsMaintenance(): HasMany
    {
        return $this->hasMany(IncidentMaintenance::class);
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }
}
