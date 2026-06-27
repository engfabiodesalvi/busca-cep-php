# Buscador de CEP

Primeira versão do buscador de CEP.

## Exemplo de uso

```php

<?php

require_once __DIR__ . '/vendor/autoload.php';

use Engfabiodesalvi\BuscaCepPhp\Search;

$busca = new Search;

// Busca o CEP
$resultado = $busca->getAdressFromZipcode('01001000');

print_r($resultado);

```