<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    /** @use HasFactory<\Database\Factories\PaiementFactory> */
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'attribution_id',
        'type_paiement',
        'montant',
        'methode_paiement',
        'reference_transaction',
        'statut_paiement',
        'date_paiement',
        'mois_concerne',
        'recu_path',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'datetime',
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
