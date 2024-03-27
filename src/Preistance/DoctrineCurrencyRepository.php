<?php

namespace App\Preistance;

use App\Entity\Currency;
use App\NBP\DTO\CurrencyDTO;
use App\NBP\SdkInterface\INbpSdk;
use App\Repository\ICurrencyRepository;
use Doctrine\ORM\EntityManagerInterface;


class DoctrineCurrencyRepository implements ICurrencyRepository
{

    public function __construct(private EntityManagerInterface $entityManager, private INbpSdk $INbpSdk)    {
    }

    public function createCurrency(array $rates): ?array
    {
        foreach ($rates as $rate){
            $rate = new CurrencyDTO((array)$rate);
            $exist = $this->findByCode($rate->code);

            if(!empty($exist) && $rate->code === $exist->getCode() && $rate->mid === $exist->getMid())continue;

            $currency = null;
            if($exist){
                $exist->setMid($rate->mid);
                $currency = $exist;
            }else{
                $currency = new Currency($rate->currency,$rate->code,$rate->mid);
            }
            $this->entityManager->persist($currency);
        }

        $this->flush();

        return  $rates;
    }

    public function flush(): void
    {
       $this->entityManager->flush();
    }

    public function findByCode(string $code): ?Currency
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select('c')
            ->from(Currency::class, 'c')
            ->andWhere('c.code = :code')
            ->setParameter('code', $code);

        $result = $queryBuilder->getQuery()->getOneOrNullResult();

        if(empty($result)){
            return null;
        }

        return $result;
    }
}