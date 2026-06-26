<?php

namespace Engfabiodesalvi\BuscaCepPhp;

class Search{
    // O CEP será buscado nesta URL
    private string $url = "http://viacep.com.br/ws/";

    public function getAdressFromZipcode(string $zipCode): array{
        // Remove caracteres indesejados
        $zipCode = preg_replace('/[^0-9]/im', '', $zipCode);

        // Realiza a requisição do CEP desejado com o retorno dos dados no formato json
        $get = file_get_contents($this->url . $zipCode . "/json");

        // Retorna o resultado
        return (array) json_decode($get);

    }

}