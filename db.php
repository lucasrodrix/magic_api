<?php

if (PHP_SAPI != 'cli') {
    exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

// Load settings
$settings = require __DIR__ . '/config/settings.php';

// Instantiate the app
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/config/dependencies.php';
$container = $app->getContainer();
$dependencies($container);

// Set up Database
$db = $container->get('db');

$schema = $db->schema();
// $tabela = 'editions';

// $schema->dropIfExists($tabela);

// // Criação da tabela
// $schema->create($tabela, function ($table) {
//     $table->increments('id');
//     $table->string('name_pt');
//     $table->string('name_en');
//     $table->date('release_date');
//     $table->integer('card_count');
// });

// Popula a tabela com alguns dados de exemplo
// $db->table($tabela)->insert([
//     [
//         'name_pt' => 'Edição Exemplo 1',
//         'name_en' => 'Example Edition 1',
//         'release_date' => '2023-01-01',
//         'card_count' => 100
//     ],
//     [
//         'name_pt' => 'Edição Exemplo 2',
//         'name_en' => 'Example Edition 2',
//         'release_date' => '2023-06-01',
//         'card_count' => 150
//     ],
// ]);

// echo "Tabela $tabela populada com sucesso.\n";

// $tabela = 'users';

// $db->table($tabela)->insert([
//     [
//         'username' => 'admin1',
//         'password' => password_hash('admin.2024', PASSWORD_DEFAULT),
//     ],
//     [
//         'username' => 'admin2',
//         'password' => password_hash('admin.2024', PASSWORD_DEFAULT),
//     ],
// ]);

// echo "Tabela $tabela populada com sucesso.\n";

/**
 * Explicação
CLI Check: Verifica se o script está sendo executado a partir da linha de comando.
Autoload: Carrega o autoloader do Composer.
Slim App: Instancia o aplicativo Slim e carrega as configurações e dependências.
Database Setup: Obtém a instância do banco de dados e o schema.
Tabela editions: Cria a tabela editions com as colunas especificadas e a popula com alguns dados de exemplo.
 */