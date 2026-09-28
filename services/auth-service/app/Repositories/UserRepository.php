<?php

namespace App\Repositories;

use App\Core\Abstracts\BaseRepository;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findById(string $id): ?User
    {
        return parent::findById($id);
    }

    public function findOrFail(string $id): User
    {
        return parent::findOrFail($id);
    }

    public function create(array $data): User
    {
        return parent::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->query()->where('email', $email)->first();
    }

    public function findByGoogleId(string $googleId): ?User
    {
        return $this->query()->where('google_id', $googleId)->first();
    }
}
