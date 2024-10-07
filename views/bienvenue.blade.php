<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $titre ?? "Bienvenue" }}</title>
    <style>
        .rouge {
            color: red;
        }
    </style>
</head>
<body>
<h1>{{ $titre ?? "Bienvenue" }}</h1>
<p>Bienvenue, {{ $prenom ?? "Cher utilisateur" }} !</p>
<p>Un exemple d'utilisation du moteur de vues <span class="rouge">Blade</span>.</p>
</body>
</html>
