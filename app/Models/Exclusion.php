<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exclusion extends Model
{
    /** @use HasFactory<\Database\Factories\ExclusionFactory> */
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'attribution_id',
        'motif',
        'description_motif',
        'date_decision',
        'statut_exclusion',
        'date_effective',
        'agent_responsable',
    ];

    protected $casts = [
        'date_decision' => 'date',
        'date_effective' => 'date',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function attributionLogement(): BelongsTo
    {
        return $this->belongsTo(AttributionLogement::class, 'attribution_id');
    }
}
