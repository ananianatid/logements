<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appartement extends Model
{
    /** @use HasFactory<\Database\Factories\AppartementFactory> */
    use HasFactory;

    protected $fillable = [
        'batiment_id',
        'numero',
        'etage',
        'type_appartement',
        'capacite_personnes',
        'disponibilite',
        'etat',
        'superficie',
        'loyer_mensuel',
    ];

    protected $casts = [
        'disponibilite' => 'boolean',
        'superficie' => 'decimal:2',
        'loyer_mensuel' => 'decimal:2',
    ];

    public function batiment(): BelongsTo
    {
        return $this->belongsTo(Batiment::class);
    }

    public function attributionsLogement(): HasMany
    {
        return $this->hasMany(AttributionLogement::class);
    }

    public function equipements(): HasMany
    {
        return $this->hasMany(EquipementAppartement::class);
    }

    public function incidentsMaintenance(): HasMany
    {
        return $this->hasMany(IncidentMaintenance::class);
    }
}
