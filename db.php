<?php
// if (PHP_SAPI != 'cli') {
//     exit('Rodar via CLI');
// }

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

$db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

$schema->create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo',100);
    $table->decimal('valor',11,2);
    $table->string('urlimg',250);
    $table->timestamps();
});

$db->table($tabela)->insert([

    'titulo' => 'Maçã',
    'valor' => '5.50',
    'urlimg' => '/src/image/download.jpg'

]);