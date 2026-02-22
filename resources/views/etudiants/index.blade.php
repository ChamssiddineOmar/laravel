@extends('layouts.app')

@section('content')
<div class="container">
    {{-- En-tête avec bouton d'ajout --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-users me-2"></i>Liste des Étudiants</h2>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Ajouter un Étudiant
        </a>
    </div>

    {{-- Barre de recherche --}}
    <div class="row mb-4">
        <div class="col-md-5">
            <form action="{{ route('etudiants.index') }}" method="GET">
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" 
                           placeholder="Rechercher par nom ou prénom..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                    
                    @if(request('search'))
                        <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary" title="Effacer la recherche">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Tableau des étudiants --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Prénom</th>
                        <th>Nom</th>
                        <th>Filière</th>
                        <th>Email</th>
                        <th>Cours</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etudiant)
                    <tr>
                        <td class="ps-4 align-middle">{{ $etudiant->prenom }}</td>
                        <td class="align-middle text-uppercase fw-bold">{{ $etudiant->nom }}</td>
                        
                        <td class="align-middle">
                            @if($etudiant->filiere)
                                <span class="badge bg-secondary">
                                    <i class="fas fa-graduation-cap me-1"></i> {{ $etudiant->filiere->nom }}
                                </span>
                            @else
                                <span class="text-muted small italic">Non assignée</span>
                            @endif
                        </td>

                        <td class="align-middle">{{ $etudiant->email }}</td>
                        
                        <td class="align-middle">
                            {{-- Affichage des cours avec la propriété 'nom' --}}
                            @forelse($etudiant->cours as $c)
                                <span class="badge bg-info text-dark shadow-sm me-1">
                                    <i class="fas fa-book-open me-1" style="font-size: 0.7rem;"></i>{{ $c->nom }}
                                </span>
                            @empty
                                <small class="text-muted italic">Aucun cours</small>
                            @endforelse
                        </td>

                        <td class="text-center align-middle">
                            <div class="btn-group">
                                <a href="{{ route('etudiants.show', $etudiant->id) }}" class="btn btn-sm btn-outline-info border-0" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-outline-warning border-0" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Supprimer cet étudiant ?')" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3"></i>
                            <p>Aucun étudiant trouvé.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection