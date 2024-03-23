<?php

namespace App\utils;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseHandler
{
    public static function getJsonData($data): JsonResponse
    {
        $response = new JsonResponse($data);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        return $response;
    }
}