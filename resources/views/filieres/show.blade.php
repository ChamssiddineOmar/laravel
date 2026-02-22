@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('filieres.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
            <h2 class="fw-bold text-primary"><i class="fas fa-graduation-cap me-2"></i>{{ $filiere->nom }}</h2>
        </div>
        
        <div class="card shadow-sm border-0 bg-light p-3">
            <form action="{{ route('filieres.ajouter_etudiant', $filiere->id) }}" method="POST" class="d-flex gap-2">
                @csrf
                <select name="etudiant_id" class="form-select" required>
                    <option value="" selected disabled>Ajouter un étudiant libre...</option>
                    @foreach($etudiantsSansFiliere as $etudiantLibre)
                        <option value="{{ $etudiantLibre->id }}">{{ $etudiantLibre->prenom }} {{ $etudiantLibre->nom }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success text-nowrap">
                    <i class="fas fa-plus"></i> Inscrire
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 fw-bold border-bottom">
            Étudiants inscrits ({{ $filiere->etudiants->count() }})
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nom Complet</th>
                        <th>Email</th>
                        <th class="text-center">Actions sur la filière</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($filiere->etudiants as $etudiant)
                    <tr>
                        <td class="ps-4 align-middle fw-bold">{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                        <td class="align-middle text-muted">{{ $etudiant->email }}</td>
                        <td class="text-center">
                            <form action="{{ route('filieres.detacher', $etudiant->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-warning shadow-sm" title="Retirer de la filière">
                                    <i class="fas fa-unlink me-1"></i> Détacher
                                </button>
                            </form>

                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline ms-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm" onclick="return confirm('Supprimer définitivement cet étudiant ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5 text-muted italic">
                            Aucun étudiant dans cette filière.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection