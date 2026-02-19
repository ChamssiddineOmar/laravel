@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Modifier l'étudiant : {{ $etudiant->prenom }} {{ $etudiant->nom }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" value="{{ $etudiant->prenom }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" value="{{ $etudiant->nom }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $etudiant->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date de naissance</label>
                            <input type="date" name="date_naissance" class="form-control" value="{{ $etudiant->date_naissance }}" required>
                        </div>

                        <hr>
                        <h5>Cours suivis</h5>
                        <div class="mb-4">
                            @foreach($cours as $cour)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cours[]" value="{{ $cour->id }}" 
                                        id="cour_{{ $cour->id }}"
                                        {{ $etudiant->cours->contains($cour->id) ? 'checked' : '' }}> 
                                        <label class="form-check-label" for="cour_{{ $cour->id }}">
                                        {{ $cour->libelle }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection