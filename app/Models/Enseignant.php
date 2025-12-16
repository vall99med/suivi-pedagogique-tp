<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;

class Enseignant extends Model
{
    // Définir la relation One-to-Many avec Etudiant
    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
}
