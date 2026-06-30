<?php
declare(strict_types=1);

namespace Engfabiodesalvi\BuscaCepPhp\Domain\Enums;

enum Provider: string
{
    /**
     * ViaCep
     * 
     * https://viacep.com.br
     */
    case VIA_CEP = 'viacep';

    /**
     * WebmaniaBR
     * 
     * https://webmaniabr.com
     */
    case WEBMANIA = 'webmania';

    /**
     * Apps WideNet
     * 
     * https://apps.widenet.com.br
     */
    case WIDENET = 'widenet';

    /**
     * BrasilAPI
     * 
     * https://brasilapi.com.br
     */
    case BRASIL_API = 'brasilapi';
    
    /**
     * Open CEP
     * 
     * https://opencep.com
     */
    case OPEN_CEP = 'opencep';
    
    /**
     * Awesome API
     * 
     * https://cep.awesomeapi.com.br
     */
    case AWESOME_API = 'awesomeapi';
    
    /**
     * CEP Aberto
     * 
     * https://www.cepaberto.com  
     */
    case CEP_ABERTO = 'cepaberto';

    // Enums modernos possuem comportamentos
    public function label(): string
    {
        return match ($this) {
            self::VIA_CEP => 'ViaCEP',
            self::WEBMANIA => 'WebmaniaBR',
            self::WIDENET => 'Apps WideNet',
            self::BRASIL_API => 'BrasilAPI',
            self::OPEN_CEP => 'OpenCEP',
            self::AWESOME_API => 'AwesomeAPI',
            self::CEP_ABERTO => 'CEPAberto'
        };
    }

    public function baseUrl(): string
    {
        return match($this) {
            self::VIA_CEP
                => 'https://viacep.com.br',
            self::WEBMANIA
                => 'https://webmaniabr.com',
            self::WIDENET
                => 'https://apps.widenet.com.br',
            self::BRASIL_API
                => 'https://brasilapi.com.br',
            self::OPEN_CEP
                =>'https://opencep.com',
            self::AWESOME_API
                => 'https://cep.awesomeapi.com.br',
            self::CEP_ABERTO
                => 'https://www.cepaberto.com'

        };
    }

    // Disponibilidade
    public function supportsRetry(): bool
    {
        return true;
    }


    // Cada API possui um timeout diferente
    public function timeout(): int
    {
        return match ($this) {
            self::VIA_CEP => 3,     // Padrão de mercado, suscetível a picos de tráfego
            self::WEBMANIA => 5,    // API Corporativa / Validação de credenciais e escopo
            self::WIDENET => 5,     // Legado / ApiCEP (Gateway de fallback mais lento)
            self::BRASIL_API => 3,  // Agregadora moderna (v2 com geolocalização)
            self::OPEN_CEP => 1,    // Arquitetura JAMstack / CDN Cloudflare (Fail-Fast)
            self::AWESOME_API => 2, // Agregadora estável com cache robusto
            self::CEP_ABERTO => 3   // Requer Auth via Token + processamento geoespacial
        };
    }
}