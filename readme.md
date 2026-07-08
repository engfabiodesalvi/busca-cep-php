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

<!-- # Buscador de CEP

Biblioteca PHP para consulta de CEP utilizando múltiplos provedores brasileiros.

## Recursos

- Via CEP
- Open Cep
- Brasil API
- Cep Aberto
- Awesome API
- WebmaniaBR
- WideNet

## Instalação

composer require engfabiodesalvi/busca-cep-php

## Requisitos

- PHP 8.2+

## Licença

MIT -->

# Busca CEP PHP

Uma biblioteca PHP moderna para consulta de CEP utilizando múltiplos provedores, implementando mecanismos de **Retry**, **Failover**, **Circuit Breaker** e **Logging**, com arquitetura baseada em boas práticas de desenvolvimento e componentes desacoplados.

A biblioteca centraliza consultas a diversos serviços de CEP em uma única API, permitindo que aplicações utilizem diferentes provedores de forma transparente e resiliente.

---

## Principais características

* Compatível com PHP 8.3+
* Instalação via Composer
* Arquitetura em camadas
* PSR-4 Autoload
* Value Objects
* DTOs
* HTTP Client próprio utilizando funções nativas do PHP
* Múltiplos provedores
* Retry automático
* Failover automático
* Circuit Breaker
* Sistema de Logging
* Configuração centralizada
* Tratamento de exceções
* Testes unitários
* Testes de integração
* Código compatível com PSR-12

---

# Arquitetura

```
Application
│
├── Services
│
Domain
│
├── DTO
├── Exceptions
├── Interfaces
└── ValueObject
│
Infrastructure
│
├── Config
├── Http
├── Logging
├── Normalizers
└── Providers
│
Collections
│
Tests
│
Examples
```

---

# Instalação

```bash
composer require engfabiodesalvi/busca-cep-php
```

---

# Requisitos

* PHP 8.3 ou superior
* Composer

---

# Provedores suportados

| Provider     | Suporte |
| ------------ | ------- |
| AwesomeApi   | ✅     |
| BrasilAPI    | ✅     |
| CepAberto    | ✅     |
| OpenCep      | ✅     |
| ViaCep       | ✅     |

A arquitetura permite adicionar novos provedores facilmente sem modificar o restante da biblioteca.

---

# Primeiro exemplo

```php
use Engfabiodesalvi\BuscaCepPhp\CepSearch;

$cep = new CepSearch();

$address = $cep->search('01001000');

echo $address->street();
```

---

# Exemplo completo

```php
use Engfabiodesalvi\BuscaCepPhp\CepSearch;

$search = new CepSearch();

$address = $search->search('01001000');

echo "CEP........: ".$address->cep().PHP_EOL;
echo "Logradouro.: ".$address->street().PHP_EOL;
echo "Bairro.....: ".$address->district().PHP_EOL;
echo "Cidade.....: ".$address->city().PHP_EOL;
echo "Estado.....: ".$address->state().PHP_EOL;
echo "IBGE.......: ".$address->ibge().PHP_EOL;
echo "Provider...: ".$address->provider().PHP_EOL;
```

---

# Configuração

Alguns provedores necessitam de autenticação.

A biblioteca possui uma classe de configuração para armazenar parâmetros globais.

Exemplo:

```php
use Engfabiodesalvi\BuscaCepPhp\Infrastructure\Config\Config;

Config::set(
    'cepaberto_token',
    getenv('CEPABERTO_TOKEN')
);
```

---

# Utilizando arquivo .env

```
CEPABERTO_TOKEN=seu_token_aqui
```

Leitura da variável:

```php
Config::set(
    'cepaberto_token',
    getenv('CEPABERTO_TOKEN')
);
```

Dessa forma cada usuário utiliza seu próprio token sem alterar o código da biblioteca.

---

# Retry

Caso um provedor apresente falha temporária, a biblioteca realiza novas tentativas automaticamente.

```
Provider

↓

Falha

↓

Retry

↓

Retry

↓

Sucesso
```

---

# Failover

Se um provedor permanecer indisponível, a biblioteca tenta automaticamente o próximo provedor disponível.

```
ViaCEP

↓

Erro

↓

BrasilAPI

↓

Erro

↓

OpenCEP

↓

Sucesso
```

---

# Circuit Breaker

Providers que apresentam falhas consecutivas podem ser temporariamente ignorados, evitando chamadas repetidas para serviços indisponíveis.

```
Provider

↓

Falha

↓

Circuit OPEN

↓

Provider ignorado

↓

Próximo Provider
```

---

# Logging

A biblioteca suporta diferentes implementações de log.

Implementações disponíveis:

* NullLogger
* ConsoleLogger

Exemplo:

```php
$logger = new ConsoleLogger();

$search = new CepSearch(logger: $logger);
```

---

# Tratamento de exceções

A biblioteca possui exceções específicas para facilitar o tratamento de erros.

* CepException
* HttpException
* InvalidCepException
* NormalizerException
* ProviderException

Exemplo:

```php
try {

    $address = $search->search('01001000');

} catch (ProviderException $e) {

    echo $e->getMessage();

}
```

---

# Adicionando um novo Provider

Cada novo provedor deve implementar sua própria classe.

```
AbstractProvider
        ▲
        │
NovoProvider
```

Também deverá possuir seu respectivo Normalizer.

```
NormalizerInterface
        ▲
        │
NovoProviderNormalizer
```

Nenhuma modificação nas demais classes será necessária.

---

# Estrutura dos testes

```
tests/

Application/

Domain/

Infrastructure/

Integration/
```

Os testes contemplam:

* Value Objects
* DTOs
* Normalizers
* Providers
* Integração

---

# Qualidade de código

Ferramentas recomendadas:

* PHPUnit
* PHPStan
* PHP_CodeSniffer

Executar testes:

```bash
./vendor/bin/phpunit
```

Executar análise estática:

```bash
./vendor/bin/phpstan analyse
```

Executar PHPCS:

```bash
./vendor/bin/phpcs
```

---

# Organização do projeto

```
src/

Application/

Collections/

Domain/

Infrastructure/

tests/

examples/
```

---

# Exemplos

A pasta `examples/` contém exemplos completos de utilização da biblioteca.

* Consulta simples
* Retry
* Failover
* Logging
* CEP Aberto
* Utilização de múltiplos provedores

---

# Roadmap

Funcionalidades planejadas:

* Cache PSR-16
* Consulta em lote
* Busca por endereço
* Consulta assíncrona
* Suporte a Guzzle
* Suporte a PSR-18
* Métricas dos provedores
* Eventos
* Plugins de provedores

---

# Contribuindo

Contribuições são bem-vindas.

1. Faça um Fork.
2. Crie uma branch.
3. Implemente sua melhoria.
4. Execute todos os testes.
5. Envie um Pull Request.

---

# Licença

Este projeto está licenciado sob a licença MIT.

---

# Autor

**Fabio Toledo Bonemer De Salvi**

Engenheiro Eletricista, estudante de Análise e Desenvolvimento de Sistemas e desenvolvedor de software.

GitHub:

https://github.com/engfabiodesalvi

---

# Agradecimentos

Agradecimentos à comunidade PHP e aos mantenedores dos serviços públicos de consulta de CEP utilizados por esta biblioteca.
