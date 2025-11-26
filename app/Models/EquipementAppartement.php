<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipementAppartement extends Model
{
    /** @use HasFactory<\Database\Factories\EquipementAppartementFactory> */
    use HasFactory;

    protected $table = 'equipements_appartement';

    public $timestamps = false;

    protected $fillable = [
        'appartement_id',
        'nom_equipement',
        'quantite',
        'etat',
    ];

    public function appartement(): BelongsTo
    {
        return $this->belongsTo(Appartement::class);
    }
}
