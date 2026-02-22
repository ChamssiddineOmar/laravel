@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-book-medical me-2"></i>Ajouter un nouveau Cours</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('cours.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom du cours</label>
                            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" placeholder="ex: Algorithmique Avancée" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom du Professeur</label>
                            <input type="text" name="professeur" class="form-control @error('professeur') is-invalid @enderror" value="{{ old('professeur') }}" placeholder="ex: M. Diop" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Volume Horaire (heures)</label>
                            <input type="number" name="volume_horaire" class="form-control @error('volume_horaire') is-invalid @enderror" value="{{ old('volume_horaire') }}" placeholder="ex: 30" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i> Créer le cours
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection