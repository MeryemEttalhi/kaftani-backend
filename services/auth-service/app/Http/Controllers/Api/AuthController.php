<?php

namespace App\Http\Controllers\Api;

use App\Core\Traits\ApiResponse;
use App\DTO\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly AuthService $authService,
    ) {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = RegisterDTO::fromRequest($request);

        $userDTO = $this->authService->register($dto);

        return $this->createdResponse(
            data: $userDTO->toArray(),
            message: 'Compte créé avec succès.',
        );
    }
}
