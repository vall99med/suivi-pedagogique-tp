<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'filiere',
        'niveau',
        'enseignant_id',
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }
    
     // NOUVELLE RELATION
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }

    // Méthode utilitaire pour calculer le taux de présence
    public function tauxPresence($nombreJoursCours = 100)
    {
        $nombreAbsences = $this->absences()->count();
        if ($nombreJoursCours == 0) return 100;
        return round((($nombreJoursCours - $nombreAbsences) / $nombreJoursCours) * 100, 2);
    }
}