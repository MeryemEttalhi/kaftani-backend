<?php

namespace App\Services;

use App\DTO\RegisterDTO;
use App\DTO\UserDTO;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function register(RegisterDTO $dto): UserDTO
    {
        if ($this->userRepository->findByEmail($dto->email) !== null) {
            throw ValidationException::withMessages([
                'email' => 'Cette adresse email est déjà utilisée.',
            ]);
        }

        $user = $this->userRepository->create([
            'full_name'     => $dto->fullName,
            'email'         => $dto->email,
            'password'      => $dto->password,
            'phone'         => $dto->phone,
            'auth_provider' => 'EMAIL',
        ]);

        return UserDTO::fromModel($user);
    }
}
