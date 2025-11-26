<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContratHabitation extends Model
{
    /** @use HasFactory<\Database\Factories\ContratHabitationFactory> */
    use HasFactory;

    protected $table = 'contrats_habitation';

    protected $fillable = [
        'attribution_id',
        'numero_contrat',
        'fichier_contrat_path',
        'date_signature',
        'caution_montant',
        'caution_payee',
        'reglement_signe',
    ];

    protected $casts = [
        'date_signature' => 'date',
        'caution_montant' => 'decimal:2',
        'caution_payee' => 'boolean',
        'reglement_signe' => 'boolean',
    ];

    public function attributionLogement(): BelongsTo
    {
        return $this->belongsTo(AttributionLogement::class, 'attribution_id');
    }
}
