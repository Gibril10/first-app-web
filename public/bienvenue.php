<?php

use eftec\bladeone\BladeOne;

require_once("../vendor/autoload.php");

$blade = new BladeOne(__DIR__ . "/../views", __DIR__ . "/../cache");

// Passer les paramètres pour le modèle Blade
echo $blade->run('bienvenue', [
    'titre' => "Page de Bienvenue",
    'prenom' => "Gibril"
]);
