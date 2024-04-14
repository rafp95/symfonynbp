<?php

namespace App\UI\Controller\Nbp;

use Symfony\Component\HttpFoundation\JsonResponse;

class NbpResponse implements NbpResponseInterface
{
    public static function successResponse(array|null $data): JsonResponse
    {
        return new JsonResponse($data, 200);
    }
}