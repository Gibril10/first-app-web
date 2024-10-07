<?php
// src/Controllers/Welcome.php
namespace DevWeb\WebPhp\Controllers;

use DevWeb\WebPhp\Utils\App;

class Welcome {

    public function about(): string {
        return App::getBladeInstance()->run('welcome', [
            "title" => "À propos",
            "msg" => "Bonjour Monde (à partir d'un contrôleur)"
        ]);
    }

    // Méthode pour déclencher l'affichage du formulaire
    public function declenche() {
        response()->httpCode(200);
        return App::getBladeInstance()->run("formulaire", ['titre' => 'Un contact']);
    }

    // Méthode pour traiter les données du formulaire
    public function storeJson(): void {
        response()->json([
            'method' => request()->getMethod(),
            'uri' => request()->getUrl(),
            'headers' => request()->getHeaders(),
            'data' => input()->all()
        ]);
    }
}

