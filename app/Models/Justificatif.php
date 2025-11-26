<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Justificatif extends Model
{
    /** @use HasFactory<\Database\Factories\JustificatifFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'etudiant_id',
        'type_justificatif',
        'fichier_path',
        'date_depot',
        'statut',
    ];

    protected $casts = [
        'date_depot' => 'datetime',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
}
