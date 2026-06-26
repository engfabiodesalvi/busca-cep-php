<?php

use Engfabiodesalvi\BuscaCepPhp\Search;

$busca = new Search;

$resultado = $busca->getAddressFromZipcode('01001000');

print_r($resultado);