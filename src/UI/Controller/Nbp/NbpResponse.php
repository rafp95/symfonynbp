<?php

namespace App\UI\Controller\Nbp;

use Symfony\Component\HttpFoundation\JsonResponse;

class NbpResponse implements NbpResponseInterface
{
    public function successResponse(array|null $data): JsonResponse
    {
        return new JsonResponse($data, 200);
    }
}