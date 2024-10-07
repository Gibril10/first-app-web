<?php

require_once("../vendor/autoload.php"); // Chargement de l'autoloader de Composer
require_once("../src/BD/BDMapper.php"); // Inclus la classe BDMapper

use DevWeb\WebPhp\BD\BDMapper; // Utilisez le bon namespace
use eftec\bladeone\BladeOne; // Assurez-vous d'importer BladeOne

// Créer une instance de BDMapper
$mapper = BDMapper::getInstance(); // Utilisez la méthode statique pour obtenir l'instance
$personnes = $mapper->all(); // Récupérer toutes les personnes

// Configuration de Blade
$blade = new BladeOne(__DIR__ . "/../views", __DIR__ . "/../cache", BladeOne::MODE_AUTO);

// Exécution de la vue 'listePersonnes' avec les données récupérées
echo $blade->run('listePersonnes', ['personnes' => $personnes]);
