<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'specialite',
    ];

    // Relation avec les étudiants
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}