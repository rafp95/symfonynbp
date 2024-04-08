<?php

namespace App\Application\Command;

use App\Application\Service\CurrencyServiceInterface;

class CreateCurrencyCommandHandler
{
    public function __construct(private CurrencyServiceInterface $currencyService)
    {
    }

    public function __invoke(CreateCurrencyCommand $command): void
    {
        $this->currencyService->createCurrency($command);
    }

}