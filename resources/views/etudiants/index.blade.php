@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-users me-2"></i>Liste des Étudiants</h2>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Ajouter un Étudiant
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Cours</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $etudiant)
                    <tr>
                        <td class="ps-4">{{ $etudiant->prenom }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->email }}</td>
                        <td>
                            @foreach($etudiant->cours as $c)
                                <span class="badge bg-info text-dark">{{ $c->libelle }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-outline-warning border-0">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger border-0" onclick="return confirm('Supprimer ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection