<?php

namespace App\Repositories\Interfaces;

use App\Core\Interfaces\RepositoryInterface;
use App\Models\OtpCode;

interface OtpRepositoryInterface extends RepositoryInterface
{
    public function create(array $data): OtpCode;

    public function findLatestActive(string $userId, string $type): ?OtpCode;

    public function invalidateActive(string $userId, string $type): void;
}
