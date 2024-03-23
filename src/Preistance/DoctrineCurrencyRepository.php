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
            $exist = $this->findByCodeAndMid($rate->code,$rate->mid);
            $currency = new Currency($rate->currency,$rate->code,$rate->mid);

            if($exist){
               $currency = $exist;
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

    public function findByCodeAndMid(string $code, string $mid)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select('c')
            ->from('App\Entity\Currency', 'c')
            ->andWhere('c.mid = :mid')
            ->setParameter('mid', $mid)
            ->andWhere('c.code = :code')
            ->setParameter('code', $code);

        $result = $queryBuilder->getQuery()->getOneOrNullResult();

        if(empty($result)){
            return null;
        }

        return $result;
    }
}