<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Cours; // Importation du modèle Cours pour les relations

class EtudiantController extends Controller
{
    // 1. Afficher la liste des étudiants
    public function index() {
        $etudiants = Etudiant::all(); 
        return view('etudiants.index', compact('etudiants'));
    }

    // 2. Afficher le formulaire de création
    public function create() {
        $cours = Cours::all(); // On récupère les cours pour pouvoir les cocher
        return view('etudiants.create', compact('cours'));
    }

    // 3. Enregistrer un nouvel étudiant (C'EST CETTE FONCTION QUI TE MANQUAIT)
    public function store(Request $request) {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'date_naissance' => 'required|date',
        ]);

        $etudiant = Etudiant::create($validated);

        // Si des cours ont été cochés, on les lie à l'étudiant
        if ($request->has('cours')) {
            $etudiant->cours()->attach($request->cours);
        }

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté !');
    }

    // 4. Afficher le formulaire de modification
    public function edit(Etudiant $etudiant) {
        $cours = Cours::all();
        return view('etudiants.edit', compact('etudiant', 'cours'));
    }

    // 5. Mettre à jour les données
    public function update(Request $request, Etudiant $etudiant) {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,'.$etudiant->id,
            'date_naissance' => 'required|date',
        ]);

        $etudiant->update($validated);

        // Synchronisation des cours (Many-to-Many)
        $etudiant->cours()->sync($request->input('cours', []));

        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour !');
    }

    // 6. Supprimer un étudiant
    public function destroy(Etudiant $etudiant) {
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé !');
    }
}