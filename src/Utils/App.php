<?php

namespace DevWeb\WebPhp\Utils;

use eftec\bladeone\BladeOne;

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
}
