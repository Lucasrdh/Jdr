@extends('layouts.app')

@section('title', 'Objets')

@section('content')
    <h1>Liste des objets</h1>

    <!-- Filtres pour trier par valeur ou rareté -->
    <div class="filters">
        <label for="sort-by-value">Trier par valeur : </label>
        <select id="sort-by-value">
            <option value="desc">Décroissant</option>
            <option value="asc">Croissant</option>
        </select>

        <label for="filter-by-rarete">Afficher par rareté : </label>
        <select id="filter-by-rarete">
            <option value="all">Tous</option>
            <option value="1">★ Très commun</option>
            <option value="2">★★ Commun</option>
            <option value="3">★★★ Rare</option>
            <option value="4">★★★★ Légendaire</option>
        </select>
    </div>

    <!-- Conteneur pour les sections -->
    <div class="object-sections">
        <!-- Section Équipement -->
        <div class="object-section">
            <h2>Équipement</h2>
            <table id="table-equipement">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Valeur</th>
                    <th>Rareté</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($equipements as $equipement)
                    <tr class="objet-row" data-rarete="{{ getRarityValue($equipement->rarete) }}" data-valeur="{{ $equipement->valeur }}" data-description="{{ $equipement->description }}">
                        <td><img src="{{ asset($equipement->image) }}" alt="{{ $equipement->nom }}" width="50"></td>
                        <td>{{ $equipement->nom }}</td>
                        <td>{{ $equipement->valeur }}</td>
                        <td>{!! getRarityStars($equipement->rarete) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section Consommables -->
        <div class="object-section">
            <h2>Consommables</h2>
            <table id="table-consommable">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Valeur</th>
                    <th>Rareté</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($consommables as $consommable)
                    <tr class="objet-row" data-rarete="{{ getRarityValue($consommable->rarete) }}" data-valeur="{{ $consommable->valeur }}">
                        <td><img src="{{ asset($consommable->image) }}" alt="{{ $consommable->nom }}" width="50"></td>
                        <td>{{ $consommable->nom }}</td>
                        <td>{{ $consommable->valeur }}</td>
                        <td>{!! getRarityStars($consommable->rarete) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section Autres -->
        <div class="object-section">
            <h2>Autres</h2>
            <table id="table-autre">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Valeur</th>
                    <th>Rareté</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($autres as $autre)
                    <tr class="objet-row" data-rarete="{{ getRarityValue($autre->rarete) }}" data-valeur="{{ $autre->valeur }}">
                        <td><img src="{{ asset($autre->image) }}" alt="{{ $autre->nom }}" width="50"></td>
                        <td>{{ $autre->nom }}</td>
                        <td>{{ $autre->valeur }}</td>
                        <td>{!! getRarityStars($autre->rarete) !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inclure jQuery à partir du CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Inclure votre fichier JavaScript externe -->
    <script src="{{ asset('js/objets.js') }}"></script>

    <style>
        .tooltip {
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 8px;
            border-radius: 5px;
            display: none; /* Par défaut, le tooltip est caché */
            z-index: 1000;
            max-width: 200px;
            word-wrap: break-word;
            pointer-events: none; /* Éviter que la souris interagisse avec le tooltip */
        }

        .object-sections {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .object-section {
            flex: 1;
            min-width: 350px;
            max-width: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; /* Permet aux colonnes de s'ajuster automatiquement */
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            overflow: visible; /* Permet le texte de déborder s'il est trop long */
        }

        /* Ajustement de la largeur des colonnes */
        td:nth-child(2) {
            max-width: 200px; /* Ajustez la largeur maximale si nécessaire */
            word-wrap: break-word; /* Permet le retour à la ligne */
        }

        td:nth-child(3), th:nth-child(3) {
            max-width: 100px; /* Ajustez la largeur maximale si nécessaire */
            text-align: right; /* Alignement à droite pour la valeur */
        }

        /* Ajustement spécifique pour le tableau "Autres" */
        #table-autre td:nth-child(4), #table-autre th:nth-child(4) {
            max-width: 150px; /* Largeur maximale pour le tableau "Autres" */
        }

        th {
            background-color: #f2f2f2; /* Couleur de fond pour l'en-tête */
        }
    </style>

    <script>
        $(document).ready(function() {
            const filterByRarete = $('#filter-by-rarete');
            const sortByValue = $('#sort-by-value');

            // Filtrer les objets par rareté
            filterByRarete.on('change', function() {
                const rarete = $(this).val();
                $('.objet-row').each(function() {
                    const rowRarete = $(this).data('rarete');
                    $(this).toggle(rarete === 'all' || rowRarete == rarete);
                });
            });

            // Trier les objets par valeur
            sortByValue.on('change', function() {
                const order = $(this).val();
                const tables = ['#table-equipement tbody', '#table-consommable tbody', '#table-autre tbody'];

                tables.forEach(function(tableSelector) {
                    const table = $(tableSelector);
                    const rows = table.find('tr').get();

                    rows.sort(function(a, b) {
                        const valA = parseInt($(a).data('valeur'));
                        const valB = parseInt($(b).data('valeur'));
                        return order === 'asc' ? valA - valB : valB - valA;
                    });

                    $.each(rows, function(index, row) {
                        table.append(row);
                    });
                });
            });
        });
    </script>
@endsection

@php
    function getRarityStars($rarete) {
        switch ($rarete) {
            case 'Très commun':
                return '★';
            case 'Commun':
                return '★★';
            case 'Rare':
                return '★★★';
            case 'Légendaire':
                return '★★★★';
            default:
                return '';
        }
    }

    function getRarityValue($rarete) {
        switch ($rarete) {
            case 'Très commun':
                return '1';
            case 'Commun':
                return '2';
            case 'Rare':
                return '3';
            case 'Légendaire':
                return '4';
            default:
                return '0'; // Option par défaut
        }
    }
@endphp
