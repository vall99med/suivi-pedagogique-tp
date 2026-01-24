<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\AbsenceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Accueil');
});

Route::resource('etudiants', EtudiantController::class);
Route::resource('enseignants', EnseignantController::class);
Route::resource('absences', AbsenceController::class);

// Route spéciale pour voir les absences d'un étudiant
Route::get('absences/etudiant/{etudiant}', [AbsenceController::class, 'parEtudiant'])
    ->name('absences.etudiant');