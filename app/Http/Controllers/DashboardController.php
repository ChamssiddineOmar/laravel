<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Cours;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_etudiants' => Etudiant::count(),
            'total_filieres'  => Filiere::count(),
            'total_cours'     => Cours::count(),
            'top_filiere'     => Filiere::withCount('etudiants')
                                    ->orderBy('etudiants_count', 'desc')
                                    ->first(),
        ];

        return view('dashboard', compact('stats'));
    }
}