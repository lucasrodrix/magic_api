<?php

// routes/routes.php

use App\Controllers\AuthController;
use App\Controllers\CardController;
use App\Controllers\EditionController;
use App\Middleware\AuthMiddleware;

$app->group('/api', function () {
    $this->post('/login', AuthController::class . ':login');
    $this->post('/logout', AuthController::class . ':logout');

    // Rotas das edições com middleware de autenticação
    $this->group('/editions', function () {
        $this->get('/list', EditionController::class . ':getAll');
        $this->get('/list/{id}', EditionController::class . ':getById');
        $this->post('/create', EditionController::class . ':create');
        $this->put('/update/{id}', EditionController::class . ':update');
        $this->delete('/delete/{id}', EditionController::class . ':delete');
    })->add(new AuthMiddleware($this->getContainer()));

    // Rotas das cartas com middleware de autenticação
    $this->group('/cards', function () {
        $this->get('/list/{id}', CardController::class . ':getById');
        $this->post('/create', CardController::class . ':create');
        $this->put('/update/{id}', CardController::class . ':update');
        $this->delete('/delete/{id}', CardController::class . ':delete');
    })->add(new AuthMiddleware($this->getContainer()));
});

// Rota para listar todas as cartas sem autenticação
$app->get('/api/cards/list', CardController::class . ':getAll');
