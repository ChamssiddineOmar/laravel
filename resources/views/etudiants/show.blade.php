@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Bouton retour --}}
    <div class="mb-3">
        <a href="{{ route('etudiants.index') }}" class="btn btn-link text-decoration-none text-muted p-0">
            <i class="fas fa-arrow-left me-1"></i> Retour à la liste
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 overflow-hidden">
                {{-- En-tête du profil avec dégradé --}}
                <div class="card-header bg-primary text-white p-4" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                    <div class="d-flex align-items-center">
                        
                        {{-- BLOC PHOTO OU INITIALES RECTIFIÉ --}}
<div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center shadow-lg overflow-hidden" 
     style="width: 100px; height: 100px; border: 4px solid rgba(255,255,255,0.3); flex-shrink: 0;">
    
    @php
        // On vérifie si la photo existe en base ET physiquement sur le serveur
        $photoExists = $etudiant->photo && Storage::disk('public')->exists($etudiant->photo);
    @endphp

    @if($photoExists)
        {{-- Affichage de la photo avec gestion du formatage --}}
        <img src="{{ asset('storage/' . $etudiant->photo) }}" 
             alt="Photo de {{ $etudiant->nom }}" 
             style="width: 100%; height: 100%; object-fit: cover; display: block;">
    @else
        {{-- Initiales de secours si pas de photo ou si le lien est mort --}}
        <span style="font-size: 2.5rem; font-weight: bold; line-height: 1;">
            {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->nom, 0, 1)) }}
        </span>
    @endif
</div>

                        <div class="ms-4">
                            <h2 class="mb-0 fw-bold">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h2>
                            <span class="badge bg-light text-primary mt-1 shadow-sm">
                                <i class="fas fa-graduation-cap me-1"></i> {{ $etudiant->filiere->nom ?? 'Sans Filière' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="row g-0">
                        {{-- Infos Personnelles --}}
                        <div class="col-md-5 bg-light p-4 border-end">
                            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Détails Personnels</h5>
                            
                            <div class="mb-3">
                                <label class="text-muted small d-block">Adresse Email</label>
                                <span class="fw-bold text-dark">{{ $etudiant->email }}</span>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted small d-block">Date de Naissance</label>
                                <span class="fw-bold text-dark">
                                    {{ \Carbon\Carbon::parse($etudiant->date_naissance)->translatedFormat('d F Y') }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label class="text-muted small d-block">Identifiant Unique</label>
                                <span class="badge bg-secondary">ID-{{ str_pad($etudiant->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>

                        {{-- Liste des Cours --}}
                        <div class="col-md-7 p-4">
                            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Cours Inscrits</h5>
                            
                            @forelse($etudiant->cours as $cour)
                                <div class="d-flex justify-content-between align-items-center p-3 mb-2 bg-white border rounded shadow-sm">
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ $cour->nom }}</h6>
                                        <small class="text-muted">Prof. {{ $cour->professeur }}</small>
                                    </div>
                                    <span class="badge rounded-pill bg-info text-dark">{{ $cour->volume_horaire }}h</span>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted">
                                    <i class="fas fa-book-open fa-2x mb-2"></i>
                                    <p>Aucun cours assigné.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Barre d'actions --}}
                <div class="card-footer bg-white p-3 text-end">
                    <button onclick="window.print()" class="btn btn-outline-dark me-2">
                        <i class="fas fa-print me-1"></i> Imprimer
                    </button>
                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning px-4 fw-bold">
                        <i class="fas fa-edit me-1"></i> Modifier le profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .btn, .mb-3, .card-footer { display: none !important; }
        .card { border: none !important; box-shadow: none !important; }
    }
</style>
@endsection