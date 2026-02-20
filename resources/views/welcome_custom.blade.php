@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <div class="py-5">
        <i class="fas fa-graduation-cap fa-10x text-primary mb-4"></i>
        <h1 class="display-3 fw-bold">IPD GESTION</h1>
        <p class="lead text-muted">Système de gestion des étudiants et des enseignements</p>
        
        <div class="mt-5">
            <a href="{{ route('etudiants.index') }}" class="btn btn-primary btn-lg px-4 me-3">
                <i class="fas fa-user-graduate me-2"></i> Gérer les Étudiants
            </a>
            <a href="{{ route('cours.index') }}" class="btn btn-outline-success btn-lg px-4">
                <i class="fas fa-book me-2"></i> Consulter les Cours
            </a>
        </div>
    </div>
</div>
@endsection