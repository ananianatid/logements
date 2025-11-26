<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailEtatLieu extends Model
{
    /** @use HasFactory<\Database\Factories\DetailEtatLieuFactory> */
    use HasFactory;

    protected $table = 'details_etat_lieux';

    public $timestamps = false;

    protected $fillable = [
        'etat_lieu_id',
        'element',
        'etat',
        'observations',
        'photo_path',
    ];

    public function etatLieu(): BelongsTo
    {
        return $this->belongsTo(EtatLieu::class);
    }
}
