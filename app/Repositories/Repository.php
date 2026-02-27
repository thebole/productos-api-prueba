<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
     /**
     * @var \Illuminate\Database\Eloquent\Model model.
     */
    protected $model;

    /**
     * @var array relations.
     */
    private $relations;

    /**
     * This function takes a model and an array of relations and sets them to the model and relations
     * properties.
     *
     * @param Model model The model you want to use.
     * @param array relations This is an array of the relations you want to eager load.
     */
    public function __construct(Model $model, array $relations = [])
    {
        // Set Data
        $this->model = $model;
        $this->relations = $relations;
    }

    /**
     * Get All.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * If the relations array is not empty, return the model with the relations, otherwise return the
     * model without the relations.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] The model with the relations.
     */
    public function all()
    {
        return (! empty($this->relations))
        ? $this->model::with($this->relations)->get()
        : $this->model::get();
    }

    /**
     * If the  property is not empty, then return the model with the relations, otherwise
     * return the model without the relations.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[] The model with the relations or the model without the relations.
     */
    public function index()
    {
        return (! empty($this->relations))
        ? $this->model::with($this->relations)->get()
        : $this->model::get();
    }

    /**
     * If the relations array is not empty, return the model with the relations, otherwise return the
     * model without the relations.
     *
     * @param int id The id of the model you want to get
     * @return \Illuminate\Database\Eloquent\Collection|static[] The model with the relations.
     */
    public function get(int $id)
    {
        return (! empty($this->relations))
        ? $this->model::with($this->relations)->whereId($id)->get()
        : $this->model::get();
    }

    /**
     * It returns the model with the relations
     *
     * @param  mixed  $data  The data to be passed to the model.
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null The model with the relations.
     */
    public function find($data)
    {
        return $this->model::with($this->relations)->find($data);
    }

    /**
     * It returns the first record that matches the data passed in, or creates a new record with the
     * data passed in
     *
     *
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function firstOrNew(array $data)
    {
        return $this->model::firstOrNew($data);
    }

    /**
     * It returns the model with the relations and where the attribute is equal to the data.
     *
     * @param  \Closure|string|array|\Illuminate\Database\Query\Expression  $attribute  The name of the column you want to search for.
     * @param  mixed  $data  The data you want to pass to the model
     * @return $this A collection of all the models that match the criteria.
     */
    public function where($attribute, $data)
    {
        return $this->model::with($this->relations)->where($attribute, $data);
    }

    /**
     * It returns the model with the relations and where the attribute is in the data.
     *
     * @param  string  $attribute  The name of the column you want to search for.
     * @param  mixed  $data  The data you want to pass to the view.
     * @return $this A collection of models
     */
    public function whereIn($attribute, $data)
    {
        return $this->model::with($this->relations)->whereIn($attribute, $data);
    }

    /**
     * It returns the model with the relations and where the attribute is not in the data.
     *
     * @param string attribute The name of the column you want to search for.
     * @param  mixed  $data  The data you want to search for.
     * @return $this A query builder object.
     */
    public function whereNotIn($attribute, $data)
    {
        return $this->model::with($this->relations)->whereNotIn($attribute, $data);
    }

    /**
     * Where Raw.
     *
     * @param  mixed  $query
     * @param  mixed  $variables
     * @return \Illuminate\Http\Response
     */
    public function whereRaw($query, $variables)
    {
        return $this->model::with($this->relations)->whereRaw($query, $variables);
    }

    /**
     * Create.
     *
     * @param  mixed  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($data)
    {
        return $this->model::create($data);
    }

    /**
     * > Update a model in the database
     *
     * @param Model model The model to be updated.
     * @return bool The return value of the save() method.
     */
    public function update(Model $model)
    {
        return $model->save();
    }

    /**
     * > Save the model or fail
     *
     * @param Model model The model to be saved.
     * @return bool The model is being saved and if it fails, it will throw an exception.
     *
     * @throws \Throwable
     */
    public function save(Model $model)
    {
        return $model->saveOrFail();
    }

    /**
     * Delete.
     *
     * @param  mixed  $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function delete($data)
    {
        return $this->model::findOrFail($data)->delete();
    }
}
