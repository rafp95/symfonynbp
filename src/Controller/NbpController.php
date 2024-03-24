<?php

namespace App\Controller;

use App\NBP\SdkInterface\INbpSdk;
use App\Repository\ICurrencyRepository;
use App\utils\ResponseHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/api', name: 'api_currency')]
class NbpController extends AbstractController
{

    public function __construct(private INbpSdk $ISdk,private ICurrencyRepository $currencyRepository)
    {
    }

    #[Route('/currency', name: 'currency', methods: ['GET'])]
    public function currency(): JsonResponse
    {
       return ResponseHandler::getJsonData($this->currencyRepository->createCurrency($this->ISdk->getCurrency()));
    }

}