<?php

use \Slim\App;
use function \src\slimConfiguration;
use \App\Controllers\ProductController;

$app = new App(slimConfiguration());

// ======================================
$app->get('/',ProductController::class . ':getProducts');
// ======================================

$app->run();



