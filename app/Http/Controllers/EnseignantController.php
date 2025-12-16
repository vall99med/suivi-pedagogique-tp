<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    // Liste des enseignants avec leurs étudiants
    public function index()
    {
        $enseignants = Enseignant::with('etudiants')->get();

        return Inertia::render('Enseignants', [
            'enseignants' => $enseignants
        ]);
    }

    // Formulaire création
    public function create()
    {
        return Inertia::render('EnseignantForm');
    }

    // Stockage enseignant
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:enseignants',
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        Enseignant::create($request->all());

        return redirect()->route('enseignants.index');
    }

    // Formulaire édition
    public function edit(Enseignant $enseignant)
    {
        return Inertia::render('EnseignantForm', [
            'enseignant' => $enseignant
        ]);
    }

    // Mise à jour enseignant
    public function update(Request $request, Enseignant $enseignant)
    {
        $request->validate([
            'matricule' => 'required|unique:enseignants,matricule,' . $enseignant->id,
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        $enseignant->update($request->all());

        return redirect()->route('enseignants.index');
    }

    // Suppression enseignant
    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();

        return redirect()->route('enseignants.index');
    }
}
