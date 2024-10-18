@extends('layouts.app')

@section('content')
    <h1>Bienvenue, {{ $personnage->nom }}</h1>
    <h3>Votre Or : {{ $personnage->or }} Pièces</h3>

    <h3>Voici les objets que vous pouvez acheter :</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th> <!-- Nouvelle colonne pour la description -->
            <th>Prix</th>
            <th>Stock disponible</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($objets as $objet)
            <tr>
                <td>{{ $objet->nom }}</td>
                <td>{{ $objet->description }}</td> <!-- Affiche la description de l'objet -->
                <td>{{ $objet->valeur }} Pièces</td>
                <td>{{ $objet->stock ?: 'Rupture de stock' }}</td>
                <td>
                    @if($personnage->or >= $objet->valeur && $objet->stock > 0)
                        <form action="{{ route('marchand.acheter') }}" method="POST">
                            @csrf
                            <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                            <button type="submit" class="btn btn-success">Acheter</button>
                        </form>
                    @else
                        <span class="text-muted">Indisponible</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>Vos objets :</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Vendre</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($personnage->objets as $objet)
            <tr>
                <td>{{ $objet->nom }}</td>
                <td>{{ $objet->pivot->quantite }}</td> <!-- Affiche la quantité -->
                <td>{{ $objet->valeur }}</td>
                <td>
                    <form action="{{ route('marchand.vendre') }}" method="POST">
                        @csrf
                        <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                        <button type="submit">Vendre</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
