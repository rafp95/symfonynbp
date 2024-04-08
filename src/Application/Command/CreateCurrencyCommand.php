<?php

namespace App\Application\Command;

class CreateCurrencyCommand implements CommandInterface
{
    public function __construct(private ?array $rates)
    {
    }

    public function getRates(): ?array
    {
        return $this->rates;
    }

}