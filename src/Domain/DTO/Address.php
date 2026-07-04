<?php
// Data Transfer Object - DTO responsável por
// padrnizar os dados recebidos pelas diversas APIs (Providers)
// de constulta de CEP.

declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\DTO;

use Engfabiodesalvi\BuscaCepPhp\Domain\Enums\Provider;

final readonly class Address
{
    public function __construct(
        private string $cep,
        private string $street,
        private string $complement,
        private string $district,
        private string $city,
        private string $state,
        private string $ibge,
        private string $gia,
        private string $ddd,
        private string $siafi,
        private Provider $provider
    )
    {        
    }

    public function cep(): string
    {
        return $this->cep;
    }

    public function street(): string
    {
        return $this->street;
    }

    public function complement(): string
    {
        return $this->complement;
    }

    public function district(): string
    {
        return $this->district;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function ibge(): string
    {
        return $this->ibge;
    }

    public function gia(): string
    {
        return $this->gia;
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function siafi() : string 
    {
        return $this->siafi;    
    }

    public function provider(): Provider
    {
        return $this->provider;
    }

    public function toArray(): array
    {
        return [
            'cep' => $this->cep,
            'street' => $this->street,
            'complement' => $this->complement,
            'district' => $this->district,
            'city' => $this->city,
            'state' => $this->state,
            'ibge' => $this->ibge,
            'gia' => $this->gia,
            'ddd' => $this->ddd,
            'siafi' => $this->siafi,
            'provier' => $this->provider()->value,
            'provierLabel' => $this->provider()->label()
        ];
    }

    public function toJson(): string
    {
        return json_encode(
            $this->toArray(),
            JSON_THROW_ON_ERROR
        );
    }

    public function __toString(): string
    {
        return $this->street
            . ', '
            . $this->district
            . ' - '
            . $this->city
            . '/'
            . $this->state;
    }

    public function isComplete(): bool
    {
        return  
            $this->street !== ''
            && $this->district !== ''
            && $this->city !== ''
            && $this->state !== '';
    }
}