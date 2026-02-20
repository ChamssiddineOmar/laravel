@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="fas fa-book me-2"></i>Liste des Cours</h2>
        <a href="{{ route('cours.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Ajouter un Cours
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Libellé</th>
                        <th>Professeur</th>
                        <th>Volume Horaire</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cours as $cour)
                    <tr>
                        <td class="ps-4">{{ $cour->libelle }}</td>
                        <td>{{ $cour->professeur }}</td>
                        <td>{{ $cour->volume_horaire }} h</td>
                        <td class="text-center">
                            <form action="{{ route('cours.destroy', $cour->id) }}" method="POST">
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