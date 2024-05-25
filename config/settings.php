<?php
// config/settings.php
return [
    'settings' => [
        'displayErrorDetails' => true, // Defina como false em produção
        'cache_directory' => __DIR__ . '/../cache',
        
        // DB settings
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'magic-api',
            'username' => 'root',
            'password' => 'Rodrix.8583',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',            
        ],

        //SecretKey
        'secretKey' => 'ba493994548c882b280be5ef747a1702f822984a',

        // Timezone
        'timezone' => 'America/Sao_Paulo',        
    ],
];
