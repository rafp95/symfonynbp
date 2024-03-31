<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\NbpController;
use App\State\CurrencyProvider;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="currency")
 */
#[ApiResource(operations: [
    new Get(
        uriTemplate: '/currency',
        controller: NbpController::class,
        name: 'api_currencycurrency'
    )
])]
class Currency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true, nullable=false)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private string $currency;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private string $code;

    /**
     * @ORM\Column(type="decimal",precision=10, scale=2)
     */
    private string $mid;

    /**
     * @param string $currency
     * @param string $code
     * @param string $mid
     */
    public function __construct(string $currency, string $code, string $mid)
    {
        $this->id = Uuid::uuid4();
        $this->currency = $currency;
        $this->code = $code;
        $this->mid = $mid;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getMid(): string
    {
        return $this->mid;
    }

    public function setMid(string $mid): void
    {
        $this->mid = $mid;
    }


}