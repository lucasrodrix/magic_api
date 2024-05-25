<?php
// config/dependencies.php

use App\Controllers\CardController;
use Slim\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

// DIC configuration
return function (Container $container) {
    $settings = $container->get('settings');

    // Configure Eloquent ORM
    $capsule = new Capsule;
    $capsule->addConnection($settings['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db'] = function ($container) use ($capsule) {
        return $capsule;
    };
    
    // Configure Symfony Cache
    $container['cache'] = function ($container) {
        return new FilesystemAdapter('app_cache', 0, $container->get('settings')['cache_directory']);
    };
    
    // Configure CardController with CacheItemPoolInterface dependency
    $container[CardController::class] = function($container){
        $cache = $container->get('cache');
        return new CardController($cache);
    };

    // Configure AuthController
    $container['AuthController'] = function ($container) {
        return new \App\Controllers\AuthController($container->get('settings')['secretKey']);
    };
};

/**
 * Registro do Symfony Cache: A função anônima $container['cache'] agora retorna uma instância de FilesystemAdapter. Essa é a configuração básica para usar o Symfony Cache com um adaptador de sistema de arquivos.
 * 
 * Configuração do CardController: Agora, o CardController está registrado corretamente com a injeção de dependência para CacheItemPoolInterface. Isso é feito obtendo a instância de cache ($cache) do contêiner e passando-a para o construtor do CardController.
 */