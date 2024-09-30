@extends('layouts.app')

@section('title', 'Détails du personnage')

@section('content')
    <div class="container">
        <h1>{{ $personnage->nom }}</h1>
        <img src="{{ asset($personnage->image) }}" alt="Image du personnage" class="img-fluid">

        <h2>Modificateurs</h2>
        <p>Modificateur total : {{ $modificateurTotal }}</p>
        <p>Modificateur d'attaque : {{ $modificateurAttaque }}</p>
        <p>Modificateur de défense : {{ $modificateurDefense }}</p>

        <h2>Classes</h2>
        <div class="row">
            @foreach ($personnage->classes as $classe)
                <div class="col-md-3">
                    <img src="{{ asset($classe->image) }}" alt="{{ $classe->nom }}" class="img-fluid">
                    <p>{{ $classe->nom }}</p>
                </div>
            @endforeach
        </div>

        <h2>Objets</h2>
        <ul>
            @if (!empty($personnage->objets) && count($personnage->objets) > 0)
                @foreach ($personnage->objets as $objet) <!-- Changed $personnageArr->objets to $personnage->objets -->
                <li>
                    {{ $objet->nom }}
                    var_dump(ob);
                    @if ($objet->modificateur)
                        <strong>(Modificateur: +{{ $objet->modificateur }} {{ $objet->type_modificateur }})</strong>
                    @endif
                </li>
                @endforeach
            @else
                <li>Aucun objet disponible.</li>
            @endif
        </ul>




        <h2>Compétences</h2>
        <ul>
            @foreach ($personnage->competences as $competence)
                <li>
                    {{ $competence->nom }} ({{ $competence->type }})
                </li>
            @endforeach
        </ul>
    </div>
@endsection
