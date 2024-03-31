<?php

namespace App\Entity\DTO;

class CurrencyDTO
{
    public ?string $id;
    public string $currency;
    public string $code;
    public string $mid;

    /**
     * @param string|null $id
     * @param string $currency
     * @param string $code
     * @param string $mid
     */
    public function __construct(?string $id, string $currency, string $code, string $mid)
    {
        $this->id = $id;
        $this->currency = $currency;
        $this->code = $code;
        $this->mid = $mid;
    }


}