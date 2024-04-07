<?php

namespace App\Domain\Currency\DTO;

class CurrencyDTO
{
    public function __construct(public ?string $id,public string $currency,public string $code,public string $mid)
    {
    }


}