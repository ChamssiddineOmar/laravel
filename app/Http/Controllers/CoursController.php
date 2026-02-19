<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours; // Ne pas oublier d'importer le modèle

class CoursController extends Controller
{
    // 1. Liste des cours
    public function index()
    {
        $cours = Cours::all();
        return view('cours.index', compact('cours'));
    }

    // 2. Formulaire de création
    public function create()
    {
        return view('cours.create');
    }

    // 3. Enregistrement d'un cours
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'professeur' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:1',
        ]);

        Cours::create($validated);
        return redirect()->route('cours.index')->with('success', 'Cours créé avec succès !');
    }

    // 4. Formulaire d'édition
    public function edit(Cours $cour) // Note: Laravel utilise souvent le singulier ici
    {
        return view('cours.edit', compact('cour'));
    }

    // 5. Mise à jour
    public function update(Request $request, Cours $cour)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
            'professeur' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:1',
        ]);

        $cour->update($validated);
        return redirect()->route('cours.index')->with('success', 'Cours mis à jour !');
    }

    // 6. Suppression
    public function destroy(Cours $cour)
    {
        $cour->delete();
        return redirect()->route('cours.index')->with('success', 'Cours supprimé !');
    }
}