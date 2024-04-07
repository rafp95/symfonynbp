<?php

namespace App\Application\Query;

use App\Domain\Currency\Currency;
use App\Domain\Currency\DTO\CurrencyDTO;
use App\Domain\Currency\Repository\CurrencyRepositoryInterface;

class GetAllCurrencyQueryHandler
{
    public function __construct(private CurrencyRepositoryInterface $currencyRepository)
    {
    }

    public function getRates(GetAllCurrencyQuery $query): ?array
    {
        $rates = $this->currencyRepository->getRates();


        return array_map(function ($value) {
            /**
             * @var $value Currency
             */
            return new CurrencyDTO($value->getId(),$value->getCurrency(),$value->getCode(),$value->getMid());
        }, $rates);

    }
}