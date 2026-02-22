<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Cours;
use App\Models\Filiere;
use Illuminate\Support\Facades\Storage; // <--- IMPORTANT pour gérer les fichiers
use Carbon\Carbon;

class EtudiantController extends Controller
{
    // 1. Liste des étudiants
    public function index(Request $request) {
        $search = $request->input('search');
        $query = Etudiant::with(['cours', 'filiere']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $etudiants = $query->orderBy('nom', 'asc')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    // 2. Formulaire de création
    public function create() {
        $cours = Cours::all();
        $filieres = Filiere::all();
        return view('etudiants.create', compact('cours', 'filieres'));
    }

    // 3. Enregistrement (Store)
    public function store(Request $request) {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'date_naissance' => 'required|date',
            'filiere_id' => 'required|exists:filieres,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation photo
        ]);

        // Gestion de l'upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        }

        $etudiant = Etudiant::create($validated);

        if ($request->has('cours')) {
            $etudiant->cours()->attach($request->cours);
        }

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès !');
    }

    // 4. Détails (Show)
    public function show(Etudiant $etudiant) {
        $etudiant->load(['cours', 'filiere']);
        return view('etudiants.show', compact('etudiant'));
    }

    // 5. Formulaire de modification
    public function edit(Etudiant $etudiant) {
        $cours = Cours::all();
        $filieres = Filiere::all();
        return view('etudiants.edit', compact('etudiant', 'cours', 'filieres'));
    }

    // 6. Mise à jour (Update)
    public function update(Request $request, Etudiant $etudiant) {
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,'.$etudiant->id,
            'date_naissance' => 'required|date',
            'filiere_id' => 'required|exists:filieres,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe pour gagner de la place
            if ($etudiant->photo) {
                Storage::disk('public')->delete($etudiant->photo);
            }
            // Enregistrer la nouvelle
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        }

        $etudiant->update($validated);
        $etudiant->cours()->sync($request->input('cours', []));

        return redirect()->route('etudiants.index')->with('success', 'Mise à jour réussie !');
    }

    // 7. Suppression (Destroy)
    public function destroy(Etudiant $etudiant) {
        // Supprimer la photo du disque avant de supprimer l'étudiant
        if ($etudiant->photo) {
            Storage::disk('public')->delete($etudiant->photo);
        }
        
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé.');
    }
}