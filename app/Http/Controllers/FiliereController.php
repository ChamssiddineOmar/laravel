<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Etudiant; // Ne pas oublier d'importer le modèle Etudiant
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        $filieres = Filiere::withCount('etudiants')->get();
        return view('filieres.index', compact('filieres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:filieres,nom',
            'description' => 'nullable|string',
        ]);

        Filiere::create($validated);
        return redirect()->route('filieres.index')->with('success', 'La filière a été créée avec succès !');
    }

    public function show(Filiere $filiere)
    {
        // On charge les étudiants de la filière
        $filiere->load('etudiants');

        // On récupère les étudiants qui n'ont PAS de filière (filiere_id est null)
        // pour pouvoir les proposer dans la liste d'ajout
        $etudiantsSansFiliere = Etudiant::whereNull('filiere_id')->get();

        return view('filieres.show', compact('filiere', 'etudiantsSansFiliere'));
    }

    // NOUVELLE MÉTHODE : Détacher l'étudiant (on vide son filiere_id)
    public function detacherEtudiant(Etudiant $etudiant)
    {
        $etudiant->update(['filiere_id' => null]);
        return back()->with('success', "L'étudiant a été retiré de la filière.");
    }

    // NOUVELLE MÉTHODE : Ajouter un étudiant existant à cette filière
    public function ajouterEtudiant(Request $request, Filiere $filiere)
    {
        $request->validate([
            'etudiant_id' => 'required|exists:etudiants,id'
        ]);

        $etudiant = Etudiant::find($request->etudiant_id);
        $etudiant->update(['filiere_id' => $filiere->id]);

        return back()->with('success', "L'étudiant a été ajouté à la filière avec succès.");
    }

    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        return redirect()->route('filieres.index')->with('success', 'Filière supprimée.');
    }
}