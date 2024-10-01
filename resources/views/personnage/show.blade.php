@extends('layouts.app')

@section('title', 'Détails du personnage')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>{{ $personnage->nom }}</h1>
                <img src="{{ asset($personnage->image) }}" alt="Image du personnage" class="img-fluid mb-3">
            </div>

            <div class="col-md-8">
                <h3>Or :</h3>
                <p>{{ $personnage->Or }} Pièces</p>

                <h2>Classes</h2>
                <div class="row d-flex flex-wrap">
                    @foreach ($personnage->classes as $classe)
                        <div class="col-md-4 d-flex flex-column align-items-center mb-3">
                            <img src="{{ asset($classe->image) }}" alt="{{ $classe->nom }}" class="img-fluid mb-2">
                        </div>
                    @endforeach
                </div>

                <h2>Objets</h2>
                <ul>
                    @if ($personnage->objets && $personnage->objets->isNotEmpty())
                        @foreach ($personnage->objets as $objet)
                            <li>
                                {{ $objet->nom }}
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
                <form id="competences-form">
                    <ul>
                        @foreach ($personnage->competences as $competence)
                            <li>
                                <input type="checkbox" name="competences[]" value="{{ $competence->id }}"
                                       class="competence-checkbox"
                                       data-modificateur="{{ $competence->modificateur }}"
                                       data-type="{{ $competence->type_modificateur }}">
                                {{ $competence->nom }} ({{ $competence->type }}) <strong>(Modificateur:
                                    +{{ $competence->modificateur }} {{ $competence->type_modificateur }})</strong>
                            </li>
                        @endforeach
                    </ul>

                    <h2>État de santé</h2>
                    <ul>
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

                    </ul>

                    <p>Modificateur total : <span id="modificateur-total">{{ $modificateurTotal }}</span></p>
                    <p>Modificateur d'attaque : <span id="modificateur-attaque">{{ $modificateurAttaque }}</span></p>
                    <p>Modificateur de défense : <span id="modificateur-defense">{{ $modificateurDefense }}</span></p>
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
@endsection
