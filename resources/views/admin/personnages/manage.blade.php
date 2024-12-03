@extends('layouts.app')

@section('content')
    <h1>Gérer les Personnages</h1>

    <!-- Sélection du personnage -->
    <form method="GET" action="{{ route('admin.personnages.manage') }}">
        <label for="personnage">Choisir un personnage :</label>
        <select id="personnage" name="personnage" class="form-control" onchange="this.form.submit()">
            <option value="">-- Sélectionnez un personnage --</option>
            @foreach ($personnages as $personnage)
                <option value="{{ $personnage->id }}" {{ request('personnage') == $personnage->id ? 'selected' : '' }}>
                    {{ $personnage->nom }}
                </option>
            @endforeach
        </select>
    </form>

    @if(request('personnage'))
        @php
            $selectedPersonnage = $personnages->find(request('personnage'));
        @endphp

        <h2>Personnage : {{ $selectedPersonnage->nom }}</h2>

        <!-- Formulaire pour mettre à jour les propriétés -->
        <form action="{{ route('admin.personnages.update', $selectedPersonnage->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="niveau">Niveau :</label>
                <input type="number" id="niveau" name="niveau" value="{{ old('niveau', $selectedPersonnage->niveau) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="or">Or :</label>
                <input type="number" id="or" name="or" value="{{ old('or', $selectedPersonnage->or) }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="blesse">Blessé :</label>
                <input type="hidden" name="blesse" value="0">
                <input type="checkbox" name="blesse" id="blesse" value="1" {{ $selectedPersonnage->blesse ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="severement_blesse">Sévèrement blessé :</label>
                <input type="hidden" name="severement_blesse" value="0">
                <input type="checkbox" name="severement_blesse" id="severement_blesse" value="1" {{ $selectedPersonnage->severement_blesse ? 'checked' : '' }}>
            </div>

            <div class="form-group">
                <label for="malade">Malade :</label>
                <input type="hidden" name="malade" value="0">
                <input type="checkbox" name="malade" id="malade" value="1" {{ $selectedPersonnage->malade ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="tres_malade">Très malade :</label>
                <input type="hidden" name="tres_malade" value="0">
                <input type="checkbox" name="tres_malade" id="tres_malade" value="1" {{ $selectedPersonnage->tres_malade ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="bras_couper">Bras coupé :</label>
                <input type="hidden" name="bras_couper" value="0">
                <input type="checkbox" name="bras_couper" id="bras_couper" value="1" {{ $selectedPersonnage->bras_couper ? 'checked' : '' }}>
            </div>
            <div class="form-group">
                <label for="jambe_couper">Jambe coupée :</label>
                <input type="hidden" name="jambe_couper" value="0">
                <input type="checkbox" name="jambe_couper" id="jambe_couper" value="1" {{ $selectedPersonnage->jambe_couper ? 'checked' : '' }}>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <hr>

        <!-- Formulaire pour gérer les objets -->
        <h3>Objets :</h3>
        <ul>
            @foreach ($selectedPersonnage->objets as $objet)
                <li>
                    {{ $objet->nom }} (Quantité : {{ $objet->pivot->quantite }})
                    <form action="{{ route('admin.personnages.updateObjet', $selectedPersonnage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                        <input type="number" name="quantite" value="{{ $objet->pivot->quantite }}" class="form-control" style="width:100px; display:inline;" required>
                        <button type="submit" class="btn btn-success btn-sm">Mettre à jour</button>
                    </form>
                    <form action="{{ route('admin.personnages.removeObjet', $selectedPersonnage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <!-- Ajouter un objet -->
        <form action="{{ route('admin.personnages.addObjet', $selectedPersonnage->id) }}" method="POST">
            @csrf
            <label for="objet">Ajouter un Objet :</label>
            <select name="objet_id" id="objet" class="form-control" required>
                @foreach ($objets as $objet)
                    <option value="{{ $objet->id }}">{{ $objet->nom }}</option>
                @endforeach
            </select>
            <input type="number" name="quantite" class="form-control" placeholder="Quantité" min="1" required>
            <button type="submit" class="btn btn-success">Ajouter</button>
        </form>

        <hr>

        <!-- Gestion des compétences -->
        <h3>Compétences :</h3>
        <ul>
            @foreach ($selectedPersonnage->competences as $competence)
                <li>
                    {{ $competence->nom }}
                    <form action="{{ route('admin.personnages.removeCompetence', $selectedPersonnage->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="competence_id" value="{{ $competence->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">Retirer</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <!-- Ajouter une compétence -->
        <form action="{{ route('admin.personnages.addCompetence', $selectedPersonnage->id) }}" method="POST">
            @csrf
            <label for="competence">Ajouter une Compétence :</label>
            <select name="competence_id" id="competence" class="form-control" required>
                @foreach ($competences as $competence)
                    <option value="{{ $competence->id }}">{{ $competence->nom }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
    @endif
@endsection
