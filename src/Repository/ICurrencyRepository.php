<?php

namespace App\Repository;

use App\NBP\DTO\CurrencyDTO;

interface ICurrencyRepository
{
    /**
     * @param array $currency CurrencyDTO[]
     * @return array|null
     */
    public function createCurrency(array $currency): ?array;
    public function flush(): void;
    public function findByCodeAndMid(string $code, string $mid);
}