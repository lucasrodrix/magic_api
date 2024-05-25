<?php
// public/index.php

require __DIR__ . '/../vendor/autoload.php';

use Slim\App;

// Load settings
$settings = require __DIR__ . '/../config/settings.php';

// Definir o fuso horário baseado nas configurações
date_default_timezone_set($settings['settings']['timezone']);

// Instantiate the app
$app = new App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../config/dependencies.php';
$dependencies($app->getContainer());

// Register routes
require __DIR__ . '/../routes/routes.php';

// Run app
$app->run();
