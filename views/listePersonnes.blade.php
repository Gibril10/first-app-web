<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des personnes</title>
</head>
<body>
<h1>Liste des personnes</h1>
<ul>
    @foreach ($personnes as $personne)
        <li>ID: {{ $personne->getId() }}, Nom: {{ $personne->getName() }}, Email: {{ $personne->getEmail() }}</li>
    @endforeach
</ul>
</body>
</html>
