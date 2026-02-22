@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-layer-group me-2"></i>Gestion des Filières</h2>
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addFiliereModal">
            <i class="fas fa-plus-circle me-1"></i> Nouvelle Filière
        </button>
    </div>

    <div class="row">
        @forelse($filieres as $filiere)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title fw-bold">
                            <a href="{{ route('filieres.show', $filiere->id) }}" class="text-primary text-decoration-none hover-link">
                                {{ $filiere->nom }}
                            </a>
                        </h5>
                        <i class="fas fa-graduation-cap text-muted"></i>
                    </div>
                    
                    <p class="card-text text-muted small flex-grow-1">
                        {{ $filiere->description ?: 'Aucune description disponible pour cette filière.' }}
                    </p>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-light text-dark border">
                            <i class="fas fa-users me-1"></i> {{ $filiere->etudiants->count() }} Étudiants
                        </span>
                        
                        <form action="{{ route('filieres.destroy', $filiere->id) }}" method="POST" onsubmit="return confirm('Attention : Supprimer cette filière impactera les étudiants liés. Continuer ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger border-0" title="Supprimer la filière">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>

                    <a href="{{ route('filieres.show', $filiere->id) }}" class="btn btn-sm btn-outline-primary w-100">
                        <i class="fas fa-eye me-1"></i> Voir les étudiants inscrits
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted italic">Aucune filière disponible.</p>
        </div>
        @endforelse
    </div>
</div>

<div class="modal fade" id="addFiliereModal" tabindex="-1" aria-labelledby="addFiliereModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addFiliereModalLabel">Ajouter une Filière</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('filieres.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label fw-bold">Nom de la Filière</label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="ex: Génie Logiciel" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description (Optionnel)</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description de la filière..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection