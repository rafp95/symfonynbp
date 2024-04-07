<?php

namespace App\Application\Command;

class CreateCurrencyCommand
{
    public function __construct(private ?array $rates)
    {
        $this->rates = $this->rates;
    }

    public function getRates(): ?array
    {
        return $this->rates;
    }

}