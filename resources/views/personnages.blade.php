@extends('layouts.app')

@section('title', 'Personnages')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Personnages</h1>
        <div class="row">
            @foreach ($personnages as $personnage)
                <div class="col-md-4 mb-4">
                    <div class="card text-center">
                        <img src="{{ asset($personnage->image) }}" class="card-img-top" alt="{{ $personnage->nom }}">
                        <div class="card-header">
                            <h5 class="card-title">{{ $personnage->nom }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Niveau: {{ $personnage->niveau }}</p>
                            <p class="card-text">Classe: {{ $personnage->classe }}</p>
                            <a href="{{ route('personnage.show', $personnage->id) }}" class="btn btn-primary">Voir Détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
