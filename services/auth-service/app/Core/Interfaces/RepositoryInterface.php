<?php

namespace App\Core\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    /**
     * Récupérer tous les enregistrements.
     */
    public function all(array $columns = ['*']): Collection;

    /**
     * Récupérer une liste paginée.
     */
    public function paginate(int $perPage = 20): LengthAwarePaginator;

    /**
     * Trouver par identifiant.
     */
    public function findById(string $id): ?Model;

    /**
     * Trouver par identifiant ou lever une exception.
     */
    public function findOrFail(string $id): Model;

    /**
     * Créer un enregistrement.
     */
    public function create(array $data): Model;

    /**
     * Mettre à jour un enregistrement.
     */
    public function update(string $id, array $data): bool;

    /**
     * Supprimer un enregistrement.
     */
    public function delete(string $id): bool;
}