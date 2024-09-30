@extends('layouts.app')

@section('title', 'Compétences')

@section('content')
    <h1>Liste des Classes et Compétences</h1>

    <div class="container">
        <div class="row">
            @foreach ($classes as $classe)
                <div class="col-md-4 text-center">
                    <div class="card mb-4">
                        <img src="{{ asset($classe->image) }}" class="card-img-top" alt="{{ $classe->nom }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $classe->nom }}</h5>
                            <p class="card-text">{{ $classe->description }}</p>
                            <button class="btn btn-primary" data-toggle="collapse" data-target="#competences-{{ $classe->id }}" aria-expanded="false" aria-controls="competences-{{ $classe->id }}">
                                Voir Compétences
                            </button>
                        </div>
                    </div>

                    <div class="collapse" id="competences-{{ $classe->id }}">
                        <ul class="list-group">
                            @foreach ($classe->competences as $competence)
                                <li class="list-group-item">
                                    <strong>{{ $competence->nom }}</strong>: {{ $competence->description }}
                                    <br>
                                    <em>Type: {{ $competence->type }}</em>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>


@endsection
