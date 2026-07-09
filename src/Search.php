<?php

namespace Engfabiodesalvi\BuscaCepPhp;

use Engfabiodesalvi\BuscaCepPhp\WebService\ViaCep;

class Search
{
    public function getAdressFromZipcode(string $zipCode): array
    {
        $webService = new ViaCep();

        return $webService->search($zipCode);
    }
}
