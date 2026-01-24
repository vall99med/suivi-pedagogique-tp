<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Etudiant;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::with('etudiant')->orderBy('date', 'desc')->get();
        
        return Inertia::render('Absences', [
            'absences' => $absences
        ]);
    }

    public function create()
    {
        return Inertia::render('AbsenceForm', [
            'etudiants' => Etudiant::orderBy('nom')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'date' => 'required|date',
            'motif' => 'nullable|string|max:255',
            'justifiee' => 'boolean',
            'observation' => 'nullable|string',
        ]);

        Absence::create($data);

        return redirect()->route('absences.index')
            ->with('success', 'Absence enregistrée avec succès');
    }

    public function edit(Absence $absence)
    {
        return Inertia::render('AbsenceForm', [
            'absence' => $absence->load('etudiant'),
            'etudiants' => Etudiant::orderBy('nom')->get()
        ]);
    }

    public function update(Request $request, Absence $absence)
    {
        $data = $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id',
            'date' => 'required|date',
            'motif' => 'nullable|string|max:255',
            'justifiee' => 'boolean',
            'observation' => 'nullable|string',
        ]);

        $absence->update($data);

        return redirect()->route('absences.index')
            ->with('success', 'Absence modifiée avec succès');
    }

    public function destroy(Absence $absence)
    {
        $absence->delete();

        return redirect()->route('absences.index')
            ->with('success', 'Absence supprimée avec succès');
    }

    // Méthode pour voir les absences d'un étudiant spécifique
    public function parEtudiant($etudiantId)
    {
        $etudiant = Etudiant::with('absences')->findOrFail($etudiantId);
        
        $stats = [
            'total' => $etudiant->absences->count(),
            'justifiees' => $etudiant->absences->where('justifiee', true)->count(),
            'non_justifiees' => $etudiant->absences->where('justifiee', false)->count(),
            'taux_presence' => $etudiant->tauxPresence(),
        ];

        return Inertia::render('AbsencesEtudiant', [
            'etudiant' => $etudiant,
            'absences' => $etudiant->absences()->orderBy('date', 'desc')->get(),
            'stats' => $stats
        ]);
    }
}