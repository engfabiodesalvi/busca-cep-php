<!-- # Buscador de CEP

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

``` -->

# Buscador de CEP

Biblioteca PHP para consulta de CEP utilizando múltiplos provedores brasileiros.

## Recursos

- ViaCEP
- CEP.la
- WebmaniaBR
- WideNet

## Instalação

composer require engfabiodesalvi/busca-cep-php

## Requisitos

- PHP 8.2+

## Licença

MIT