@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        @if (!$personnage)
            <h1>Identifiez-vous</h1>
            <form action="{{ route('marchand.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nom">Nom du personnage :</label>
                    <input type="text" name="nom" id="nom" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        @else
            <h1>Marchand</h1>
            <h3>Bienvenue, {{ $personnage->nom }}</h3>
            <h4>Or: {{ $personnage->or }} Pièces</h4>

            <h2>Objets disponibles à l'achat</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($objets as $objet)
                    <tr>
                        <td>{{ $objet->nom }}</td>
                        <td>{{ $objet->prix }} Pièces</td>
                        <td>
                            <form action="{{ route('marchand.acheter') }}" method="POST">
                                @csrf
                                <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                                <button type="submit" class="btn btn-success">Acheter</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h2>Objets en votre possession</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($personnage->objets as $objet)
                    <tr>
                        <td>{{ $objet->nom }}</td>
                        <td>{{ $objet->prix }} Pièces</td>
                        <td>
                            <form action="{{ route('marchand.vendre') }}" method="POST">
                                @csrf
                                <input type="hidden" name="objet_id" value="{{ $objet->id }}">
                                <button type="submit" class="btn btn-danger">Vendre</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
