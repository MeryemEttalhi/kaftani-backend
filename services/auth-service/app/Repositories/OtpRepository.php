<?php

namespace App\Repositories;

use App\Core\Abstracts\BaseRepository;
use App\Models\OtpCode;
use App\Repositories\Interfaces\OtpRepositoryInterface;

class OtpRepository extends BaseRepository implements OtpRepositoryInterface
{
    public function __construct(OtpCode $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): OtpCode
    {
        return parent::create($data);
    }

    public function findLatestActive(string $userId, string $type): ?OtpCode
    {
        return $this->query()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->where('used', false)
            ->where('blocked', false)
            ->orderByDesc('created_at')
            ->first();
    }

    public function invalidateActive(string $userId, string $type): void
    {
        $this->query()
            ->where('user_id', $userId)
            ->where('type', $type)
            ->where('used', false)
            ->update(['used' => true]);
    }
}
