<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Enseignant;

class Etudiant extends Model
{
    // Définir la relation Many-to-One vers Enseignant
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
}
