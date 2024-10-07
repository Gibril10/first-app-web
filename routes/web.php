<?php

// routes/web.php
use DevWeb\WebPhp\Controllers\Welcome;
use Pecee\SimpleRouter\SimpleRouter;

// Route pour afficher le formulaire
SimpleRouter::get('/formulaire', [Welcome::class, 'declenche']);

// Route pour traiter les données saisies dans le formulaire
SimpleRouter::post('/formulaire', [Welcome::class, 'storeJson']);


// Création d'une route vers la page d'accueil qui utilise une fonction callback
SimpleRouter::get('/', function() {
    return 'Hello world';
});

// Création d'une route vers la page "À Propos" qui utilise un contrôleur (Welcome) et une méthode (about)
SimpleRouter::get('/about', [Welcome::class, 'about']);
