<?php

namespace App\Infrastructure\Adapter\Doctrine;

use App\Domain\Currency\Currency;
use App\Domain\Currency\Repository\CurrencyRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;


class DoctrineCurrencyRepositoryInterface implements CurrencyRepositoryInterface
{

    public function __construct(private EntityManagerInterface $entityManager)    {
    }

    public function createCurrency(array $currency): void
    {
        foreach ($currency as $value){
            $this->entityManager->persist($value);
        }
        $this->flush();
    }

    public function flush(): void
    {
       $this->entityManager->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
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

    public function getRates(): array
    {
        $result = $this->entityManager->getRepository(Currency::class)->findAll();
        if(empty($result)){
            return [];
        }
        return $result;
    }
}