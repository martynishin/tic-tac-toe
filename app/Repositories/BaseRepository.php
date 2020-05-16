<?php

namespace App\Repositories;

use App\Exceptions\RepositoryException;
use App\Interfaces\RepositoryInterface;
use Exception;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
abstract class BaseRepository implements RepositoryInterface
{
    protected Application $app;

    /**
     * @var Model|Builder
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Application $app
     *
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * Defines Model
     *
     * @var [Model]
     */
    abstract protected function model();

    /**
     * @return Model|mixed|object
     * @throws BindingResolutionException
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!($model instanceof Model)) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Retrieve all data of repository
     *
     * @param string[] $columns
     *
     * @return Builder[]|Collection|Model[]|mixed
     */
    public function all($columns = ['*'])
    {
        if ($this->model instanceof Builder) {
            return $this->model->get($columns);
        }

        return $this->model->all($columns);
    }

    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed|object
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return Builder|Model|mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $modelOrId
     *
     * @return Builder|Builder[]|Collection|Model|mixed|null
     */
    public function update(array $attributes, $modelOrId)
    {
        if ($modelOrId instanceof Model) {
            $model = $modelOrId;
        } else {
            $model = $this->model->findOrFail($modelOrId);
        }

        $model->fill($attributes);
        $model->save();

        return $model->fresh();
    }

    /**
     * Delete an entity in repository
     *
     * @param string $id
     *
     * @return bool|null
     * @throws Exception
     */
    public function deleteById(string $id)
    {
        $model = $this->model->findOrFail($id);

        return $this->delete($model);
    }

    /**
     * Delete an entity in repository
     *
     * @param Model $model
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete(Model $model)
    {
        return $model->delete();
    }
}
