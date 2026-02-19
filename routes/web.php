<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CoursController;

// Redirige automatiquement l'accueil vers la liste des étudiants
Route::get('/', function () {
    return redirect()->route('etudiants.index');
});

// Tes autres pages statiques (si tu en as besoin)
Route::get('login', function () { return view('login'); });
Route::get('tables', function () { return view('tables'); });

// LES ROUTES RESSOURCES (Le cœur du projet)
Route::resource('etudiants', EtudiantController::class);
Route::resource('cours', CoursController::class);