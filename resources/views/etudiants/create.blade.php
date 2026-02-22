@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Ajouter un nouvel Étudiant</h4>
                </div>
                <div class="card-body p-4">
                    {{-- TRÈS IMPORTANT : enctype="multipart/form-data" ajouté ici --}}
                    <form action="{{ route('etudiants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            {{-- Section Photo --}}
                            <div class="col-md-12 mb-3">
                                <label for="photo" class="form-label fw-bold">Photo de profil</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                                    <input type="file" name="photo" id="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                </div>
                                <small class="text-muted">Formats : JPG, PNG, JPG (Max 2Mo)</small>
                                @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label fw-bold">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') }}" required>
                                @error('prenom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label fw-bold">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                                @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Adresse Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label fw-bold">Date de Naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}" required>
                                @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="filiere_id" class="form-label fw-bold">Filière</label>
                                <select name="filiere_id" id="filiere_id" class="form-select @error('filiere_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Choisir une filière...</option>
                                    @foreach($filieres as $filiere)
                                        <option value="{{ $filiere->id }}" {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                            {{ $filiere->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('filiere_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Cours à assigner</label>
                            <div class="row bg-light p-3 rounded border mx-0">
                                @foreach($cours as $c)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="cours[]" value="{{ $c->id }}" id="cours_{{ $c->id }}" 
                                                {{ is_array(old('cours')) && in_array($c->id, old('cours')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cours_{{ $c->id }}">{{ $c->nom }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Enregistrer l'étudiant
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection