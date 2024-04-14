<?php

namespace App\UI\Controller\Nbp;

use Symfony\Component\HttpFoundation\JsonResponse;

interface NbpResponseInterface
{
    public static function successResponse(array|null $data): JsonResponse;
}