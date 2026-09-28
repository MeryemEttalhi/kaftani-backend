<?php

namespace App\Core\Abstracts;

use App\Core\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*']): Collection
    {
        return $this->model->all($columns);
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(string $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findOrFail(string $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        $record = $this->model->create($data);

        return $record->refresh();
    }

    public function update(string $id, array $data): bool
    {
        $record = $this->findOrFail($id);

        return $record->update($data);
    }

    public function delete(string $id): bool
    {
        $record = $this->findOrFail($id);

        return (bool) $record->delete();
    }

    /**
     * Accès au modèle pour les requêtes personnalisées
     * dans les repositories enfants.
     */
    protected function query()
    {
        return $this->model->newQuery();
    }
}   