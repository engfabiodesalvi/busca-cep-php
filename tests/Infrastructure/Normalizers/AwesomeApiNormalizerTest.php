<?php

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Tests\Infrastructure\Normalizers;

use Engfabiodesalvi\BuscaCepPhp\Domain\DTO\Address;
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Normalizers\AwesomeApiNormalizer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AwesomeApiNormalizerTest extends TestCase
{
    public function testShouldNormalizeAwesomeApiResponse(): void
    {
        $data = [
            'cep' => '01001000',
            'address' => 'Praça da Sé',
            //'complement' => '',
            'district' => 'Sé',
            'city' => 'São Paulo',
            'state' => 'SP',
            'city_ibge' => '3550308',
            //'gia' => '',
            'ddd' => '11',
            //'siafi' => '',
            'provider' => 'AwesomeAPI',
        ];

        $normalizer = new AwesomeApiNormalizer();

        $address = $normalizer->normalize($data);

        $this->assertInstanceOf(
            Address::class,
            $address
        );

        $this->assertSame(
            '01001000',
            $address->cep()
        );

        $this->assertSame(
            'Praça da Sé',
            $address->street()
        );

        $this->assertSame(
            '',
            $address->complement()
        );

        $this->assertSame(
            'Sé',
            $address->district()
        );

        $this->assertSame(
            'São Paulo',
            $address->city()
        );

        $this->assertSame(
            'SP',
            $address->state()
        );

        $this->assertSame(
            '3550308',
            $address->ibge()
        );

        $this->assertSame(
            '',
            $address->gia()
        );

        $this->assertSame(
            '11',
            $address->ddd()
        );

        $this->assertSame(
            '',
            $address->siafi()
        );

        $this->assertSame(
            'AwesomeAPI',
            $address->provider()->label()
        );
    }

    // Teste utilizando dataprovider 
    // Anotação abaixo foi descontinuada a partir de versão 10 do PHP!!!
    /**
     *  @dataProvider cepTestData
     */
    // Utilize esta anotação:
    #[DataProvider('cepTestData')]
    public function testShouldNormalizeAwesomeApiDataProviderResponse(array $data): void
    {
        $normalizer = new AwesomeApiNormalizer();

        $address = $normalizer->normalize($data);

        $this->assertInstanceOf(
            Address::class,
            $address
        );

        $this->assertSame(
            $data['cep'], // '01001000',
            $address->cep()
        );

        $this->assertSame(
            $data['address'], // 'Praça da Sé',
            $address->street()
        );

        $this->assertSame(
            '',
            $address->complement()
        );

        $this->assertSame(
            $data['district'], // 'Sé',
            $address->district()
        );

        $this->assertSame(
            $data['city'], // 'São Paulo',
            $address->city()
        );

        $this->assertSame(
            $data['state'], // 'SP',
            $address->state()
        );

        $this->assertSame(
            $data['city_ibge'], // '3550308',
            $address->ibge()
        );

        $this->assertSame(
            '',
            $address->gia()
        );

        $this->assertSame(
            $data['ddd'], // '11',
            $address->ddd()
        );

        $this->assertSame(
            '',
            $address->siafi()
        );

        $this->assertSame(
            $data['provider'], // 'AwesomeAPI',
            $address->provider()->label()
        );
    }
    
    public static function cepTestData(): array {
        return [
            "Address Praça da Sé" => [  
                "data" => [
                    'cep' => '01001000',
                    'address' => 'Praça da Sé',
                    //'complement' => '',
                    'district' => 'Sé',
                    'city' => 'São Paulo',
                    'state' => 'SP',
                    'city_ibge' => '3550308',
                    //'gia' => '',
                    'ddd' => '11',
                    //'siafi' => '',
                    'provider' => 'AwesomeAPI', 
                ]                             
            ]    
        ];
    }

}

// Awesome API    : Praça da Sé, Sé - São Paulo/SP
// CEP: 01001000
// Logradouro: Praça da Sé
// Complemento:
// Bairro: Sé
// Cidade: São Paulo
// UF: SP
// IBGE: 3550308
// GIA:
// DDD: 11
// SIAFI:
// Provider: AwesomeAPI

// Na raiz do projeto, execute:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/AwesomeApiNormalizerTest.php


// Teste com log
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/AwesomeApiNormalizerTest.php --testdox-text report-tests.txt

// Teste com XDebug
// (instalar o driver)

// Adicionar variável ao arquivo .ini:
// Via prompt: $ sudo nano /etc/php/8.3/mods-available/xdebug.ini
// Via vscode: $ sudo code --user-data-dir=/root /etc/php/8.3/mods-available/xdebug.ini
//          ou $ code /etc/php/8.3/mods-available/xdebug.ini (se o usuário já tiver as permissões configuradas)

// Teste:
// $ ./vendor/bin/phpunit tests/Infrastructure/Normalizers/AwesomeApiNormalizerTest.php --colors=always --coverage-html report-tests.html

// Configurar o diretório para analisar a cobertura:
// Arquivo phpunit.xml localizado na raiz do diretório do projeto
// Incluir:
    // <!-- ADICIONE ESTE BLOCO ABAIXO -->
    // <source restrictNotices="true" restrictWarnings="true">
    //     <include>
    //         <directory suffix=".php">src</directory> <!-- Troque 'src' pela pasta do seu código se for diferente -->
    //     </include>
    // </source>

// Visualizar o relatório:
//      no windows: $ wslview report-tests.html/index.html
//      no wsl linux: $ xdg-open report-tests.html/index.html