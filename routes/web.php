<?php

// routes/web.php
use DevWeb\WebPhp\Controllers\PersonnesControleur;
use DevWeb\WebPhp\Controllers\Welcome; // N'oubliez pas d'importer le contrôleur Welcome si nécessaire
use Pecee\SimpleRouter\SimpleRouter;

// Route pour la liste des personnes
SimpleRouter::get('/personnes', [PersonnesControleur::class, 'index']);

// Route pour afficher le formulaire
SimpleRouter::get('/formulaire', [Welcome::class, 'declenche']);

// Route pour traiter les données saisies dans le formulaire
SimpleRouter::post('/formulaire', [Welcome::class, 'storeJson']);

// Route pour afficher une personne par ID
SimpleRouter::get('/personnes/{id}', [PersonnesControleur::class, 'show']); // Correction ici

// Création d'une route vers la page d'accueil qui utilise une fonction callback
SimpleRouter::get('/', function() {
    return 'Hello world';
});

// Création d'une route vers la page "À Propos" qui utilise un contrôleur (Welcome) et une méthode (about)
SimpleRouter::get('/about', [Welcome::class, 'about']);
