<?php

namespace App\Application\Command;

use App\Application\Service\CurrencyService;
use App\Domain\Currency\Currency;
use App\Domain\Currency\DTO\CurrencyDTO;
use App\Domain\Currency\Repository\CurrencyRepositoryInterface;

class CreateCurrencyCommandHandler
{
    public function __construct(private CurrencyService $currencyService)
    {
    }

    public function __invoke(CreateCurrencyCommand $command): void
    {
        $this->currencyService->createCurrency($command);
    }

}