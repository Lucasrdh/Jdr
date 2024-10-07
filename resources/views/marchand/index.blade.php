@extends('layouts.app')

@section('content')
    <h1>Bienvenue, {{ $personnage->nom }}</h1>
    <h3>Voici les objets que vous possédez :</h3>

    <ul>
        @foreach ($personnage->objets as $objet)
            <li>
                <img src="{{ asset($objet->image) }}" alt="{{ $objet->nom }}" class="img-fluid" style="width: 30px; height: 30px; vertical-align: middle;">
            {{ $objet->nom }}
            </li>
        @endforeach
    </ul>
@endsection
