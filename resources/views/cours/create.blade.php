@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white"><h4>Ajouter un nouveau Cours</h4></div>
                <div class="card-body">
                    <form action="{{ route('cours.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Libellé du cours</label>
                            <input type="text" name="libelle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nom du Professeur</label>
                            <input type="text" name="professeur" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Volume Horaire (heures)</label>
                            <input type="number" name="volume_horaire" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('cours.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-success">Créer le cours</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection