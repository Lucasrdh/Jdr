<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jeu de Rôle')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/js/app.js') <!-- Importation de Vite -->

    <style>
        .image-small {
            max-width: 50px; /* Ajustez la largeur selon vos besoins */
            height: auto; /* Maintient le ratio d'aspect */
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Georgia', serif;
        }
        nav {
            background-color: #343a40;
        }
        nav ul {
            padding: 0;
        }
        nav li {
            list-style-type: none;
        }
        nav a {
            color: #ffffff;
            padding: 15px;
            text-decoration: none;
            transition: background 0.3s;
        }
        nav a:hover {
            background-color: #495057;
        }
        .container {
            margin-top: 20px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Jeu de Rôle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('personnages') }}">Personnages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{  route('marchand.index') }}">Marchand</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('histoire') }}">Histoire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('competences') }}">Compétences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('objets') }}">Objets</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container">
    @yield('content')
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Inclusion du fichier JavaScript compilé par Vite -->
@vite('resources/js/app.js')

</body>
</html>
