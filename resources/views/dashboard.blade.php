@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark">
                <i class="fas fa-tachometer-alt text-primary me-2"></i>Tableau de Bord
            </h2>
            <p class="text-muted">Résumé global des activités de l'IPD Gestion Scolaire.</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary me-3">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Total Étudiants</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['total_etudiants'] }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('etudiants.index') }}" class="btn btn-sm btn-outline-primary w-100">Voir la liste</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success me-3">
                            <i class="fas fa-layer-group fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Filières Actives</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['total_filieres'] }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('filieres.index') }}" class="btn btn-sm btn-outline-success w-100">Gérer les filières</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning me-3">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0">Cours au programme</h6>
                            <h2 class="fw-bold mb-0">{{ $stats['total_cours'] }}</h2>
                        </div>
                    </div>
                    <a href="{{ route('cours.index') }}" class="btn btn-sm btn-outline-warning w-100">Voir les cours</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-award text-primary me-2"></i>Filière Majoritaire</h5>
                </div>
                <div class="card-body text-center py-5">
                    @if($stats['top_filiere'])
                        <h3 class="text-primary fw-bold mb-2">{{ $stats['top_filiere']->nom }}</h3>
                        <p class="text-muted">Cette filière compte actuellement <strong>{{ $stats['top_filiere']->etudiants_count }}</strong> étudiants inscrits.</p>
                        <a href="{{ route('filieres.show', $stats['top_filiere']->id) }}" class="btn btn-primary mt-3 px-4">Consulter la filière</a>
                    @else
                        <p class="text-muted italic">Aucune donnée pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 bg-dark text-white">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center p-5">
                    <i class="fas fa-print fa-3x mb-4 opacity-50"></i>
                    <h4 class="fw-bold">Rapport d'activité</h4>
                    <p class="opacity-75">Générez un aperçu imprimable des statistiques actuelles de l'école.</p>
                    <button class="btn btn-light px-5 mt-2" onclick="window.print()">
                        <i class="fas fa-download me-2"></i>Imprimer en PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection