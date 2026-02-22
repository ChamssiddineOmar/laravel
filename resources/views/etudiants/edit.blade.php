@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Modifier l'Étudiant</h4>
                </div>
                <div class="card-body p-4">
                    {{-- TRÈS IMPORTANT : enctype="multipart/form-data" aussi ici --}}
                    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Section Photo avec prévisualisation --}}
                        <div class="text-center mb-4">
                            <div class="mb-2">
                                @if($etudiant->photo)
                                    <img src="{{ asset('storage/' . $etudiant->photo) }}" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px; font-size: 3rem;">
                                        {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="mx-auto" style="max-width: 300px;">
                                <label for="photo" class="form-label fw-bold">Changer la photo</label>
                                <input type="file" name="photo" id="photo" class="form-control form-control-sm @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="prenom" class="form-label fw-bold">Prénom</label>
                                <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom', $etudiant->prenom) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label fw-bold">Nom</label>
                                <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $etudiant->nom) }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Adresse Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $etudiant->email) }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="date_naissance" class="form-label fw-bold">Date de Naissance</label>
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance', $etudiant->date_naissance) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="filiere_id" class="form-label fw-bold">Filière</label>
                                <select name="filiere_id" id="filiere_id" class="form-select @error('filiere_id') is-invalid @enderror" required>
                                    @foreach($filieres as $filiere)
                                        <option value="{{ $filiere->id }}" {{ old('filiere_id', $etudiant->filiere_id) == $filiere->id ? 'selected' : '' }}>
                                            {{ $filiere->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold d-block">Cours assignés</label>
                            <div class="row bg-light p-3 rounded border mx-0">
                                @foreach($cours as $c)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="cours[]" value="{{ $c->id }}" id="cours_{{ $c->id }}" 
                                                {{ in_array($c->id, old('cours', $etudiant->cours->pluck('id')->toArray())) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cours_{{ $c->id }}">{{ $c->nom }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('etudiants.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning px-4 fw-bold">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection