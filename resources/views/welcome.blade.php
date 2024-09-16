<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Jeu de Rôle</title>
</head>
<body>

<!-- Navbar -->
<nav>
    <ul>
        <li><a href="{{ route('home') }}">Accueil</a></li>
        <li><a href="{{ route('personnages') }}">Personnages</a></li>
        <li><a href="{{ route('marchands') }}">Marchand</a></li>
        <li><a href="{{ route('histoire') }}">Histoire</a></li>
        <li><a href="{{ route('competences') }}">Compétences</a></li>
        <li><a href="{{ route('objets') }}">Objets</a></li>
    </ul>
</nav>

<!-- Contenu de la page d'accueil -->
<div>
    <h1>Bienvenue dans notre univers de jeu de rôle !</h1>
    <p>Explorez l'histoire, rencontrez des personnages fascinants, et découvrez des objets et compétences extraordinaires.</p>
</div>

</body>
</html>
