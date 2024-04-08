<?php

namespace App\UI\Controller;

use App\Application\Command\CreateCurrencyCommand;
use App\Application\Command\CreateCurrencyCommandHandler;
use App\Application\Query\GetAllCurrencyQuery;
use App\Application\Query\GetAllCurrencyQueryHandler;
use App\Infrastructure\Bus\CommandBus;
use App\Infrastructure\Bus\CommandBusInterface;
use App\Infrastructure\NbpSdk\NbpSdkInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route('/api', name: 'api_currency')]
class NbpController extends AbstractController
{

    public function __construct(
        private NbpSdkInterface $nbpSdk,
        private CommandBusInterface $commandBus,
        private GetAllCurrencyQueryHandler $allCurrencyQueryHandler,
        private CreateCurrencyCommandHandler $createCurrencyCommandHandler,
    )
    {
    }

    #[Route('/currency', name: 'currency', methods: ['GET'])]
    public function currency(): JsonResponse
    {
        $command = new CreateCurrencyCommand($this->nbpSdk->getCurrency());
        $this->commandBus->registerHandler(CreateCurrencyCommand::class, $this->createCurrencyCommandHandler);
        $this->commandBus->handle($command);
        $rates = $this->allCurrencyQueryHandler->getRates(new GetAllCurrencyQuery());
        return new JsonResponse($rates, 200);
    }

}