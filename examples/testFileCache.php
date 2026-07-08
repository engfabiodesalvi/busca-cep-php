<?php

declare(strict_types=1);

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\CepSearch;
use Engfabiodesalvi\BuscaCepPhp\Domain\Exceptions\CepException;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Cache\FileCache;

require_once __DIR__ . '/../vendor/autoload.php';


try {

    $cepSearch = new CepSearch();

    $address = $cepSearch->search('01001000');

    $cache = new FileCache(
        __DIR__.'/cache'
    );

    $cache->put(
        '01001000',
        $address,//'Praça da Sé',
        3600
    );

    /** @var Address $addressCached */
    $addressCached = $cache->get(
        '01001000'
    );

    echo $cache->get(
        '01001000'
    ) . PHP_EOL;

    echo $addressCached->__toString() . PHP_EOL;

} catch (CepException $e) {

    echo 'Erro: ' . $e->getMessage() . PHP_EOL;
}    