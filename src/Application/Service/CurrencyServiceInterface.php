<?php

namespace App\Application\Service;

use App\Application\Command\CreateCurrencyCommand;

interface CurrencyServiceInterface
{
    public function createCurrency(CreateCurrencyCommand $command): void;
}