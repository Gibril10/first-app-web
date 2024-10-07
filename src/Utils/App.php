<?php
// src/Utils/App.php
namespace DevWeb\WebPhp\Utils;

use eftec\bladeone\BladeOne;
use DevWeb\WebPhp\BD\BDMapper; // Assurez-vous d'importer BDMapper ici

class App {
    private static App $instance;
    private static BladeOne $bladeOne;

    private function __construct() {
        $views = __DIR__ . '/../../views';
        $cache = __DIR__ . '/../../cache';
        App::$bladeOne = new BladeOne($views, $cache, BladeOne::MODE_AUTO);
    }

    public static function getBladeInstance() {
        if (!isset(self::$instance)) {
            App::$instance = new App();
        }
        return App::$bladeOne;
    }

    // Méthode pour récupérer l'instance de BDMapper
    public static function getBDInstance(): BDMapper {
        return BDMapper::getInstance(); // Retourne l'instance de BDMapper
    }
}
