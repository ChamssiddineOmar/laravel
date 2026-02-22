<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;

class CoursController extends Controller
{
    public function index()
    {
        $cours = Cours::all();
        return view('cours.index', compact('cours'));
    }

    public function create()
    {
        return view('cours.create');
    }

    public function store(Request $request)
    {
        // On change 'libelle' par 'nom' ici
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'professeur' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:1',
        ]);

        Cours::create($validated);
        return redirect()->route('cours.index')->with('success', 'Cours créé avec succès !');
    }

    public function edit(Cours $cour)
    {
        return view('cours.edit', compact('cour'));
    }

    public function update(Request $request, Cours $cour)
    {
        // Idem ici pour la mise à jour
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'professeur' => 'required|string|max:255',
            'volume_horaire' => 'required|integer|min:1',
        ]);

        $cour->update($validated);
        return redirect()->route('cours.index')->with('success', 'Cours mis à jour !');
    }

    public function destroy(Cours $cour)
    {
        $cour->delete();
        return redirect()->route('cours.index')->with('success', 'Cours supprimé !');
    }
}