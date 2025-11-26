<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentMaintenance extends Model
{
    /** @use HasFactory<\Database\Factories\IncidentMaintenanceFactory> */
    use HasFactory;

    protected $table = 'incidents_maintenance';

    protected $fillable = [
        'appartement_id',
        'etudiant_id',
        'type_incident',
        'description',
        'priorite',
        'statut',
        'date_signalement',
        'date_resolution',
        'technicien_assigne',
        'cout_reparation',
    ];

    protected $casts = [
        'date_signalement' => 'datetime',
        'date_resolution' => 'datetime',
        'cout_reparation' => 'decimal:2',
    ];

    public function appartement(): BelongsTo
    {
        return $this->belongsTo(Appartement::class);
    }

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
}
