<?php

namespace App\UI\Controller;

use App\Application\Command\CreateCurrencyCommand;
use App\Application\Command\CreateCurrencyCommandHandler;
use App\Application\NbpSdk\NbpSdkInterface;
use App\Application\Query\GetAllCurrencyQuery;
use App\Application\Query\GetAllCurrencyQueryHandler;
use App\Application\Service\CurrencyService;
use App\Controller\AsController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/api', name: 'api_currency')]
class NbpController extends AbstractController
{

    public function __construct(
        private NbpSdkInterface $nbpSdk,
        private CreateCurrencyCommandHandler $createCurrencyCommandHandler,
        private GetAllCurrencyQueryHandler $allCurrencyQueryHandler,
    )
    {
    }

    #[Route('/currency', name: 'currency', methods: ['GET'])]
    public function currency(): JsonResponse
    {
        $query = new CreateCurrencyCommand($this->nbpSdk->getCurrency());
        $this->createCurrencyCommandHandler->createCurrency($query);
        $rates = $this->allCurrencyQueryHandler->getRates(new GetAllCurrencyQuery());
        return new JsonResponse($rates, 200);
    }

}