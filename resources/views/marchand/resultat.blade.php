<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de l'achat/vente</title>
</head>
<body>
    <h1>{{ $message }}</h1>
    <p>{{ $details }}</p>
    <a href="{{ route('marchand.index') }}">Retour au marchand</a>
</body>
</html>
