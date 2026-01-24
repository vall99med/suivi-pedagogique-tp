<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Enseignant;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        return Inertia::render('Etudiants', [
            'etudiants' => Etudiant::with('enseignant')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('EtudiantForm', [
            'enseignants' => Enseignant::all()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricule' => 'required|unique:etudiants',
            'nom' => 'required',
            'prenom' => 'required',
            'filiere' => 'required',
            'niveau' => 'required|integer',
            'enseignant_id' => 'nullable|exists:enseignants,id'
        ]);

        Etudiant::create($data);

        return redirect()->route('etudiants.index');
    }

    public function edit(Etudiant $etudiant)
    {
        return Inertia::render('EtudiantForm', [
            'etudiant' => $etudiant,
            'enseignants' => Enseignant::all()
        ]);
    }

    public function update(Request $request, Etudiant $etudiant)
    {
        $data = $request->validate([
            'matricule' => 'required|unique:etudiants,matricule,' . $etudiant->id,
            'nom' => 'required',
            'prenom' => 'required',
            'filiere' => 'required',
            'niveau' => 'required|integer',
            'enseignant_id' => 'nullable|exists:enseignants,id'
        ]);

        $etudiant->update($data);

        return redirect()->route('etudiants.index');
    }

    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index');
    }
}