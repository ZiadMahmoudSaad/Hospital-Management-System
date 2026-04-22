<?php

namespace App\Repository\Eloquent;

use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
class BaseRepository implements EloquentRepositoryInterface
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
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function findorfail($id): ?Model
    {
        return $this->model->findorfail($id);
    }
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param array $attributes
     * @param $id
     * @return Model
     */
    public function update(array $attributes, $id): Model
    {
        $model = $this->model->find($id);
        foreach ($attributes as $key => $value) {
            // dd($value);
            $model->{$key} = $value;
        }
        $model->save();
        return $model;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        // dd($id,$this->model);
        return $this->model->destroy($id);
    }
}
