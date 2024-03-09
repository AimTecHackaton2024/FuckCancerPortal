<?php

namespace App\Model\Utils;

class Config
{
    private array $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getLegacyBaseUrl()
    {
        if(isset($this->parameters['legacySystemBaseUrl']))
        {
            return $this->parameters['legacySystemBaseUrl'];
        }

        return '';

    }


}