@extends('layouts.app')

@section('title', 'Personnages')

@section('content')
    <h1>Liste des Personnages</h1>
    <!-- Ici, tu peux afficher la liste des personnages -->
    @foreach ($personnages as $personnage)
        <p>{{ $personnage->nom }} (Niveau: {{ $personnage->niveau }})</p>
    @endforeach
@endsection
