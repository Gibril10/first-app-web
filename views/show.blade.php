{{-- resources/views/show.blade.php --}}

        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la personne</title>
</head>
<body>
<h1>Détails de la personne</h1>

@if(isset($personne))
    <ul>
        <li>ID: {{ $personne->getId() }}</li>
        <li>Nom: {{ $personne->getNom() }}</li>
        <li>Prénom: {{ $personne->getPrenom() }}</li>
        <li>Email: {{ $personne->getEmail() }}</li>
    </ul>
@else
    <h2>Personne non trouvée.</h2>
@endif

<a href="{{ url('/personnes') }}">Retour à la liste des personnes</a>
</body>
</html>
