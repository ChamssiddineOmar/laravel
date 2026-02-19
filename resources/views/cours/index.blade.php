@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Cours</h2>
        <a href="{{ route('cours.create') }}" class="btn btn-success">Ajouter un Cours</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Professeur</th>
                        <th>Volume Horaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cours as $cour)
                    <tr>
                        <td>{{ $cour->libelle }}</td>
                        <td>{{ $cour->professeur }}</td>
                        <td>{{ $cour->volume_horaire }} h</td>
                        <td>
                            <form action="{{ route('cours.destroy', $cour->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce cours ?')">Supprimer</button>
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