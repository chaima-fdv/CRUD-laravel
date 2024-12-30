@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Liste des Cours</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('courses.create') }}" class="btn btn-primary">Nouveau Cours</a>
        </div>
    </div>

    <!-- Barre de recherche -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('courses.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ Str::limit($course->description, 50) }}</td>
                    <td>{{ $course->price }} €</td>
                    <td>{{ $course->category->name }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $courses->links() }}
    </div>
</div>
@endsection