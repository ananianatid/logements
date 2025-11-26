<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AntecedentLogement extends Model
{
    /** @use HasFactory<\Database\Factories\AntecedentLogementFactory> */
    use HasFactory;

    protected $table = 'antecedents_logement';

    protected $fillable = [
        'etudiant_id',
        'annee_universitaire',
        'regularite_paiements',
        'troubles_colocation',
        'description_troubles',
    ];

    protected $casts = [
        'troubles_colocation' => 'boolean',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
}
