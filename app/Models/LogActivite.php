<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogActivite extends Model
{
    /** @use HasFactory<\Database\Factories\LogActiviteFactory> */
    use HasFactory;

    protected $table = 'logs_activite';

    public $timestamps = false;

    protected $fillable = [
        'utilisateur_id',
        'action',
        'table_concernee',
        'enregistrement_id',
        'details',
        'ip_address',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
