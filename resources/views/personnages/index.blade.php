@extends('layouts.app') <!-- Assure-toi que tu as un layout de base, sinon tu peux ignorer cette ligne pour l'instant -->

@section('content')
    <h1>Personnages</h1>

    @foreach($personnages as $personnage)
        <div class="personnage">
            <h2>{{ $personnage->nom }}</h2>

            <p><strong>Blessure:</strong> {{ $personnage->blessure ?? 'Aucune' }}</p>
            <p><strong>Maladie:</strong> {{ $personnage->maladie ?? 'Aucune' }}</p>
            <p><strong>Malus:</strong> {{ $personnage->malus ?? 'Aucun' }}</p>
            <p><strong>Salles restantes avant guérison:</strong> {{ $personnage->salles_restantes ?? 'N/A' }}</p>
            <p><strong>Nourriture restante:</strong> {{ $personnage->nourriture_restante }}</p>

            <h3>Compétences</h3>
            <ul>
                @foreach($personnage->competences as $competence)
                    <li>{{ $competence->nom }} - {{ $competence->description }}</li>
                @endforeach
            </ul>

            <h3>Équipements</h3>
            <ul>
                @foreach($personnage->equipements as $equipement)
                    <li>{{ $equipement->nom }} - {{ $equipement->description }}</li>
                @endforeach
            </ul>

            <h3>Objets</h3>
            <ul>
                @foreach($personnage->objets as $objet)
                    <li>{{ $objet->nom }} - {{ $objet->description }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endsection
