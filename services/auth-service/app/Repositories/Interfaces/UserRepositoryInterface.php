<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\RepositoryInterface;
use App\Models\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findById(string $id): ?User;

    public function findOrFail(string $id): User;

    public function create(array $data): User;

    public function findByEmail(string $email): ?User;

    public function findByGoogleId(string $googleId): ?User;
}
