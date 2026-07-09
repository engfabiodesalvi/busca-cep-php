<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\WebService;

use Engfabiodesalvi\BuscaCepPhp\Search;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ViaCepSearchTest extends TestCase
{
    #[DataProvider('cepTestData')]
    public function testShouldSearchCepUsingViaCep(string $zipCode, array $data): void
    {
        $busca = new Search();

        // Busca o CEP
        $resultado = $busca->getAdressFromZipcode($zipCode);

        // Verifica
        $this->assertSame(
            $data['cep'],
            $resultado['cep']
        );

    }

    public static function cepTestData(): array {
        return [
            "Address Praça da Sé" => [ 
                'zipCode' => '01001000', 
                "data" => [
                    'cep' => '01001-000',
                    'logradouro' => 'Praça da Sé',
                    'complemento' => 'lado ímpar',
                    'unidade' => '',
                    'bairro' => 'Sé',
                    'localidade' => 'São Paulo',
                    'uf' => 'SP',
                    'estado' => 'São Paulo',
                    'ibge' => '3550308',
                    'gia' => '1004',
                    'ddd' => '11',
                    'siafi' => '7107'
                ]                             
            ]    
        ];
    }    
}

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/WebService/ViaCepSearchTest.php
