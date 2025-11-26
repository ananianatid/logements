<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EtatLieu extends Model
{
    /** @use HasFactory<\Database\Factories\EtatLieuFactory> */
    use HasFactory;

    protected $table = 'etats_lieux';

    protected $fillable = [
        'attribution_id',
        'type_etat',
        'date_etat',
        'observation_generale',
        'agent_responsable',
        'signature_etudiant_path',
        'signature_agent_path',
    ];

    protected $casts = [
        'date_etat' => 'date',
    ];

    public function attributionLogement(): BelongsTo
    {
        return $this->belongsTo(AttributionLogement::class, 'attribution_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailEtatLieu::class);
    }
}
