<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

use App\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
     protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Returns all data in the repository
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Returns a given
     *
     * @param int $id
     * @return Model
     */
    public function getById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Returns a given
     *
     * @param int $id
     * @param array $relationships
     * @return Model
     */
    public function getByIdWithRelationships(int $id, array $relationships): ?Model
    {
        return $this->model->with($relationships)->find($id);
    }

    /**
     * Returns a given
     *
     * @param array $uniqueFields
     * @param array $attributesToUpdate
     * @return Model
     */
    public function updateOrCreate(array $uniqueFields, array $attributesToUpdate): Model
    {
        return $this->model->updateOrCreate($uniqueFields, $attributesToUpdate);
    }

    /**
     * Store a newly created resource in storage.
     * @param  array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Store a newly created resource in storage.
     * @param  array $attributes
     * @return bool
     */
    public function createMany(array $attributes): bool
    {
        return $this->model->insert($attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes): Model
    {
        $model = $this->getById($id);

        $model->fill($attributes);

        $model->save();

        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }
}
