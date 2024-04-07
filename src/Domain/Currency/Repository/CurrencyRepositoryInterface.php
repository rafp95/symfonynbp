<?php

namespace App\Domain\Currency\Repository;

use App\Domain\Currency\Currency;

interface CurrencyRepositoryInterface
{
    public function createCurrency(array $currency): void;
    public function flush(): void;
    public function findByCode(string $code): ?Currency;
    public function getRates(): array;
}