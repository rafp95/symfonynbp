<?php

namespace App\Application\NbpSdk;

use App\Application\NbpSdk\DTO\CurrencyDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\LoggerInterface;

class NbpNbpSdk implements NbpSdkInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function getCurrency(): array
    {
       try{
           $client = new Client();
           $response = $client->get($_ENV['NBP_API'] . 'tables/A?format=json');
           if(empty($response->getBody()))[];

           $rates = json_decode($response->getBody(),true)[0]['rates'];

           return array_map(function ($rate) {
               return new CurrencyDTO($rate);
           },$rates);
       }catch (GuzzleException $e) {
           $this->logger->log($e->getMessage());
       }

        return [];
    }
}