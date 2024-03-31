<?php

namespace App\NBP\SdkImpl;

use App\NBP\DTO\CurrencyDTO;
use App\NBP\SdkInterface\INbpSdk;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use mysql_xdevapi\Exception;
use Psr\Log\LoggerInterface;

class NbpNbpSdk implements INbpSdk
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