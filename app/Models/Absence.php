<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'date',
        'motif',
        'justifiee',
        'observation',
    ];

    protected $casts = [
        'date' => 'date',
        'justifiee' => 'boolean',
    ];

    // Relation avec Etudiant
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
}