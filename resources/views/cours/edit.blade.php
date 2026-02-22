@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Modifier le Cours</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('cours.update', $cour->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom du cours</label>
                            <input type="text" name="nom" class="form-control" value="{{ old('nom', $cour->nom) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nom du Professeur</label>
                            <input type="text" name="professeur" class="form-control" value="{{ old('professeur', $cour->professeur) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Volume Horaire (heures)</label>
                            <input type="number" name="volume_horaire" class="form-control" value="{{ old('volume_horaire', $cour->volume_horaire) }}" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection