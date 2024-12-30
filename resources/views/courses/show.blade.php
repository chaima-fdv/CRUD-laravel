@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Détails du cours</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Titre</dt>
                        <dd class="col-sm-9">{{ $course->title }}</dd>

                        <dt class="col-sm-3">Description</dt>
                        <dd class="col-sm-9">{{ $course->description }}</dd>

                        <dt class="col-sm-3">Prix</dt>
                        <dd class="col-sm-9">{{ $course->price }} €</dd>

                        <dt class="col-sm-3">Catégorie</dt>
                        <dd class="col-sm-9">{{ $course->category->name }}</dd>

                        <dt class="col-sm-3">Créé le</dt>
                        <dd class="col-sm-9">{{ $course->created_at->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-3">Dernière mise à jour</dt>
                        <dd class="col-sm-9">{{ $course->updated_at->format('d/m/Y H:i') }}</dd>
                    </dl>

                    <div class="d-grid gap-2">
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Modifier</a>
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Retour à la liste</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection