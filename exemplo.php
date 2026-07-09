<?php

require_once __DIR__ . '/vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Search;

$busca = new Search();

// Busca o CEP
$resultado = $busca->getAdressFromZipcode('01001000');

print_r($resultado);



// Comando a serem executados após cada alteração de classe
// $composer dump-autoload
// $Composer validate
// $Composer update