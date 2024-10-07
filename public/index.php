<?php

use Pecee\SimpleRouter\SimpleRouter;

// Load composer dependencies
require '../vendor/autoload.php';

// Load our helpers
require_once '../routes/helpers.php';

/* Load external routes file */
require_once '../routes/web.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */
SimpleRouter::setDefaultNamespace('\DevWeb\WebPhp\Controllers');

// Start the routing
SimpleRouter::start();
