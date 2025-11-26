<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Utilisateur extends Model
{
    /** @use HasFactory<\Database\Factories\UtilisateurFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenoms',
        'email',
        'password_hash',
        'role',
        'actif',
        'derniere_connexion',
    ];

    protected $casts = [
        'actif' => 'boolean',
        'derniere_connexion' => 'datetime',
    ];

    public function logsActivite(): HasMany
    {
        return $this->hasMany(LogActivite::class);
    }
}
