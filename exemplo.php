<?php

require_once __DIR__ . '/vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Search;

$busca = new Search;

// Busca o CEP
// $resultado = $busca->getAdressFromZipcode('01001000');
$resultado = $busca->getAdressFromZipcode('14810598');

print_r($resultado);