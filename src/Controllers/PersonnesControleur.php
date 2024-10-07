<?php
// src/Controllers/PersonnesControleur.php
namespace DevWeb\WebPhp\Controllers;

use DevWeb\WebPhp\BD\BDMapper;
use DevWeb\WebPhp\Utils\App;

class PersonnesControleur {

    // Fonction pour déclencher l'affichage de la liste des personnes
    public function index() {
        // Récupérer l'instance de BDMapper
        $bdMapper = BDMapper::getInstance(); // Utilisation de votre méthode getInstance

        // Récupérer la liste des personnes à partir du BDMapper
        $personnes = $bdMapper->all(); // Appel de la méthode all() qui retourne toutes les personnes

        // Rendre la vue index avec la liste des personnes
        return App::getBladeInstance()->run('index', ['personnes' => $personnes]);
    }

    // Fonction pour afficher une personne par ID
    public function show($id) {
        // Récupérer l'instance de BDMapper
        $bdMapper = BDMapper::getInstance();

        // Récupérer la personne par ID
        $personne = $bdMapper->findById($id);

        // Vérifier si la personne existe
        if ($personne) {
            // Rendre la vue show avec les détails de la personne
            return App::getBladeInstance()->run('show', ['personne' => $personne]);
        } else {
            // Rendre la vue page404 si la personne n'existe pas
            return App::getBladeInstance()->run('page404');
        }
    }
}
