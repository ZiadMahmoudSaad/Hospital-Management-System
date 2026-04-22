<?php

namespace App\Interfaces;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
    /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes);

   /**
    * @param $id
    * @return Model
    */
   public function find($id);

    public function findorfail($id);

   /**
    * @return Collection
    */
   public function all();

    /**
     * @param array $attributes
     * @param $id
     * @return Model
     */
    public function update(array $attributes, $id);

    /**
     * @param $id
     * @return bool
     */
    public function delete($id);
}
