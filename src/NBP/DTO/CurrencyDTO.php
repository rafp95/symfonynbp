<?php

namespace App\NBP\DTO;
use Decimal\Decimal;

class CurrencyDTO
{
    public string $currency;
    public string $code;
    public string $mid;

    /**
     * @param array $rate
     */
    public function __construct(array $rate)
    {
        $this->currency = $rate['currency'];
        $this->code = $rate['code'];
        $this->mid = number_format((float)$rate['mid'],2, '.', '');
    }


}