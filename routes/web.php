<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EnseignantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('etudiants', EtudiantController::class);
Route::resource('enseignants', EnseignantController::class);