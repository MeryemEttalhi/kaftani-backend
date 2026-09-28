<?php

namespace App\Core\Abstracts;

use App\Core\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseService
{
    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function getPaginated(int $perPage = 20): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function getById(string $id): ?Model
    {
        return $this->repository->findById($id);
    }

    public function getOrFail(string $id): Model
    {
        return $this->repository->findOrFail($id);
    }

    public function store(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function modify(string $id, array $data): bool
    {
        return $this->repository->update($id, $data);
    }

    public function remove(string $id): bool
    {
        return $this->repository->delete($id);
    }
}