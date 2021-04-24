<?php

namespace App\Contracts;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Returns all data in the repository
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Returns a given
     *
     * @param int $id
     * @return Model
     */
    public function getById(int $id): ?Model;

    /**
     * Returns a given
     *
     * @param int $id
     * @param array $relationships
     * @return Model
     */
    public function getByIdWithRelationships(int $id, array $relationships): ?Model;

    /**
     *
     * @param array $uniqueFields
     * @param array $attributesToUpdate
     * @return Model
     */
    public function updateOrCreate(array $uniqueFields, array $attributesToUpdate): Model;

    /**
     * Store a newly created resource in storage.
     * @param  array $request
     * @return Model
     */
    public function create(array $request): Model;

    /**
     * Store a newly created resource in storage.
     * @param  array $attributes
     * @return bool
     */
    public function createMany(array $attributes): bool;

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes): Model;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return int
     */
    public function destroy(int $id): int;
}
