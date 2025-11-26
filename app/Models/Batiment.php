<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batiment extends Model
{
    /** @use HasFactory<\Database\Factories\BatimentFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'type_batiment',
        'capacite_totale',
        'disponibilite',
        'adresse',
        'description',
    ];

    public function appartements(): HasMany
    {
        return $this->hasMany(Appartement::class);
    }
}
