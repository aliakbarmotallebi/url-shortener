<?php require __DIR__ . '/../bootstrap/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', getenv('APP_DEBUG'));

use BulveyzRouter\Router;

// Defained routes
require_once '../routes/web.php';

// Run router
Router::routeVoid();
