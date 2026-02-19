@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Étudiants</h2>
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">Ajouter un Étudiant</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Cours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($etudiants as $etudiant)
                    <tr>
                        <td>{{ $etudiant->prenom }}</td>
                        <td>{{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->email }}</td>
                        <td>
                            @foreach($etudiant->cours as $c)
                                <span class="badge bg-info text-dark">{{ $c->libelle }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')">Supprimer</button>
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