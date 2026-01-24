<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use Inertia\Inertia;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        return Inertia::render('Enseignants', [
            'enseignants' => Enseignant::with('etudiants')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('EnseignantForm');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'matricule' => 'required|unique:enseignants',
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        Enseignant::create($data);

        return redirect()->route('enseignants.index');
    }

    public function edit(Enseignant $enseignant)
    {
        return Inertia::render('EnseignantForm', [
            'enseignant' => $enseignant
        ]);
    }

    public function update(Request $request, Enseignant $enseignant)
    {
        $data = $request->validate([
            'matricule' => 'required|unique:enseignants,matricule,' . $enseignant->id,
            'nom' => 'required',
            'prenom' => 'required',
            'specialite' => 'required',
        ]);

        $enseignant->update($data);

        return redirect()->route('enseignants.index');
    }

    public function destroy(Enseignant $enseignant)
    {
        $enseignant->delete();

        return redirect()->route('enseignants.index');
    }
}