@extends('layouts.app')

@section('title', 'Détails du personnage')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>{{ $personnage->nom }}</h1>
                <img src="{{ asset($personnage->image) }}" alt="Image du personnage" class="img-fluid mb-3">

                <h3>Or :</h3>
                <p>{{ $personnage->or }} Pièces</p>

                <h2>État de santé</h2>
                <ul>
                    @if ($personnage->blesse || $personnage->severement_blesse || $personnage->malade || $personnage->tres_malade)
                        @if ($personnage->blesse)
                            <li>Blessé : Malus de -3</li>
                        @endif
                        @if ($personnage->severement_blesse)
                            <li>Sévèrement blessé : Malus de -8</li>
                        @endif
                        @if ($personnage->malade)
                            <li>Malade : Malus de -3</li>
                        @endif
                        @if ($personnage->tres_malade)
                            <li>Très malade : Malus de -8</li>
                        @endif
                    @else
                        <li>Tout va bien</li>
                    @endif
                </ul>
            </div>

            <div class="col-md-8">
                <h2>Classes</h2>
                <div class="row d-flex flex-wrap mb-4">
                    @foreach ($personnage->classes as $classe)
                        <div class="col-md-4 d-flex flex-column align-items-center mb-3">
                            <a href="{{ route('competences') }}">
                                <img src="{{ asset($classe->image) }}" alt="{{ $classe->nom }}" class="img-fluid mb-2">
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h3>Équipements</h3>
                        <ul>
                            @foreach ($personnage->objets->where('type', 'équipement') as $objet)
                                <li class="objet-container">
                                    <img src="{{ asset($objet->image) }}" alt="{{ $objet->nom }}" class="img-fluid" style="width: 30px; height: 30px; vertical-align: middle;">
                                    {{ $objet->nom }}
                                    @if ($objet->modificateur)
                                        <strong>(Modificateur: +{{ $objet->modificateur }} {{ $objet->type_modificateur }})</strong>
                                    @endif
                                    <div class="objet-description">{{ $objet->description }}</div> <!-- Description au hover -->
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h3>Consommables</h3>
                        <ul>
                            @foreach ($personnage->objets->where('type', 'consommable') as $objet)
                                <li class="objet-container">
                                    <img src="{{ asset($objet->image) }}" alt="{{ $objet->nom }}" class="img-fluid" style="width: 30px; height: 30px; vertical-align: middle;">
                                    {{ $objet->nom }} (Quantité : {{ $objet->pivot->quantite }})
                                    @if ($objet->modificateur)
                                        <strong>(Modificateur: +{{ $objet->modificateur }} {{ $objet->type_modificateur }})</strong>
                                    @endif
                                    <div class="objet-description">{{ $objet->description }}</div> <!-- Description au hover -->
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-md-4">
                        <h3>Autres</h3>
                        <ul>
                            @foreach ($personnage->objets->where('type', 'autre') as $objet)
                                <li class="objet-container">
                                    <img src="{{ asset($objet->image) }}" alt="{{ $objet->nom }}" class="img-fluid" style="width: 30px; height: 30px; vertical-align: middle;">
                                    {{ $objet->nom }} (Quantité : {{ $objet->pivot->quantite }})
                                    @if ($objet->modificateur)
                                        <strong>(Modificateur: +{{ $objet->modificateur }} {{ $objet->type_modificateur }})</strong>
                                    @endif
                                    <div class="objet-description">{{ $objet->description }}</div> <!-- Description au hover -->
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <h2>Compétences</h2>
                <form id="competences-form">
                    <ul>
                        @foreach ($personnage->competences as $competence)
                            <li>
                                <input type="checkbox" name="competences[]" value="{{ $competence->id }}"
                                       class="competence-checkbox"
                                       data-modificateur="{{ $competence->modificateur }}"
                                       data-type="{{ $competence->type_modificateur }}">
                                {{ $competence->nom }} ({{ $competence->type }})
                                <strong>(Modificateur: +{{ $competence->modificateur }} {{ $competence->type_modificateur }})</strong>
                                <br>
                                <small>{{ $competence->description }}</small> <!-- Affichage de la description -->
                            </li>
                        @endforeach
                    </ul>

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('images/general.png') }}" alt="Modificateur Total" class="image-small">
                            <p> <b> Modificateur total : <span id="modificateur-total">{{ $modificateurTotal }}</span> </b> </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('images/Attaque.png') }}" alt="Modificateur d'attaque" class="image-small">
                            <p> <b> Modificateur d'attaque : <span id="modificateur-attaque">{{ $modificateurAttaque }}</span> </b> </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('images/defense.png') }}" alt="Modificateur de défense" class="image-small">
                            <p> <b>Modificateur de défense : <span id="modificateur-defense">{{ $modificateurDefense }}</span> </b></p>
                        </div>
                    </div>
                </form>

                <!-- Ajout des variables pour le JavaScript -->
                <script>
                    const niveau = {{ $personnage->niveau }}; // Niveau du personnage
                    const equipements = @json($personnage->objets); // Équipements du personnage
                    const malus = {{ $malus }}; // Total des malus
                </script>
            </div>
        </div>
    </div>

    <!-- Inclure jQuery à partir du CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .objet-container {
            position: relative;
        }

        .objet-description {
            display: none;
            position: absolute;
            bottom: -20px;
            left: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 0.9em;
            width: 100%;
        }

        .objet-container:hover .objet-description {
            display: block;
        }
    </style>

@endsection
