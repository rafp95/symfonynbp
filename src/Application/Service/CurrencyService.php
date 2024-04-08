<?php

namespace App\Application\Service;

use App\Application\Command\CreateCurrencyCommand;
use App\Domain\Currency\Currency;
use App\Domain\Currency\DTO\CurrencyDTO;
use App\Domain\Currency\Repository\CurrencyRepositoryInterface;

class CurrencyService implements CurrencyServiceInterface
{
    public function __construct(private CurrencyRepositoryInterface $currencyRepository)
    {
    }

    public function createCurrency(CreateCurrencyCommand $command): void
    {
        $currency = [];
        /**
         * @var $value CurrencyDTO
         */
        foreach ($command->getRates() as $value) {
            /**
             * @var $exist Currency
             */
            $existCurrency = $this->currencyRepository->findByCode($value->code);

            if ($value->code == $existCurrency?->getCode() && $value->mid == $existCurrency?->getMid()) continue;

            if (empty($existCurrency)) {
                $currency[] = new Currency($value->currency, $value->code, $value->mid);
            } else {
                $existCurrency->setMid($value->mid);
                $currency[] = $existCurrency;
            }

        }

        $this->currencyRepository->createCurrency($currency);

    }
}