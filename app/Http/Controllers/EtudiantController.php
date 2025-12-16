<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Enseignant;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    // Liste des étudiants
    public function index()
    {
        $etudiants = Etudiant::with('enseignant')->get();

        return Inertia::render('Etudiants', [
            'etudiants' => $etudiants
        ]);
    }

    // Formulaire création
    public function create()
    {
        $enseignants = Enseignant::all();

        return Inertia::render('EtudiantForm', [
            'enseignants' => $enseignants
        ]);
    }

    // Stockage étudiant
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:etudiants',
            'nom' => 'required',
            'prenom' => 'required',
            'filiere' => 'required',
            'niveau' => 'required|integer',
            'enseignant_id' => 'nullable|exists:enseignants,id',
        ]);

        Etudiant::create($request->all());

        return redirect()->route('etudiants.index');
    }

    // Formulaire édition
    public function edit(Etudiant $etudiant)
    {
        $enseignants = Enseignant::all();

        return Inertia::render('EtudiantForm', [
            'etudiant' => $etudiant,
            'enseignants' => $enseignants
        ]);
    }

    // Mise à jour étudiant
    public function update(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'matricule' => 'required|unique:etudiants,matricule,' . $etudiant->id,
            'nom' => 'required',
            'prenom' => 'required',
            'filiere' => 'required',
            'niveau' => 'required|integer',
            'enseignant_id' => 'nullable|exists:enseignants,id',
        ]);

        $etudiant->update($request->all());

        return redirect()->route('etudiants.index');
    }

    // Suppression étudiant
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index');
    }
}
