<?php

namespace App\Infrastructure\Adapter\Doctrine;

use App\Domain\Currency\Currency;
use App\Domain\Currency\Repository\CurrencyRepositoryInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DoctrineCurrencyRepositoryInterface extends ServiceEntityRepository implements CurrencyRepositoryInterface
{

    public function __construct(private readonly ManagerRegistry $registry)    {
        parent::__construct($this->registry, Currency::class);
    }

    public function createCurrency(array $currency): void
    {
        /**
         * @var $value ?Currency
         */
        foreach ($currency as $value){
            $this->getEntityManager()->persist($value);
        }
        $this->flush();
    }

    public function flush(): void
    {
       $this->getEntityManager()->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByCode(string $code): ?Currency
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

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
        $result = $this->findAll();
        if(empty($result)){
            return [];
        }
        return $result;
    }
}