<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\DashboardController;

// 1. MODIFICATION ICI : On ne redirige plus, on affiche la vue welcome_custom
Route::get('/', function () {
    return view('welcome_custom'); 
});

// 2. Tes autres pages (garde-les si tu les utilises)
Route::get('login', function () { return view('login'); });
Route::get('tables', function () { return view('tables'); });

// 3. LES ROUTES RESSOURCES (Ne rien changer ici)
Route::resource('etudiants', EtudiantController::class);
Route::resource('cours', CoursController::class);
Route::resource('filieres', FiliereController::class);
// Détacher un étudiant de sa filière
Route::post('/etudiants/{etudiant}/detacher', [FiliereController::class, 'detacherEtudiant'])->name('filieres.detacher');

// Ajouter un étudiant existant à une filière
Route::post('/filieres/{filiere}/ajouter-etudiant', [FiliereController::class, 'ajouterEtudiant'])->name('filieres.ajouter_etudiant');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');