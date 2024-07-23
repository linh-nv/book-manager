<?php
namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Util\Constains;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->orderBy('id', 'DESC')->get();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->_model->findOrFail($id);
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        $result->update($attributes);
        
        return $result;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        return $result->delete();
    }

    /**
     * Restore soft-deleted record
     *
     * @param $id
     * @return bool
     */
    public function restore($id): bool
    {
        $result = $this->_model->withTrashed()->findOrFail($id);
        return $result->restore();
    }

    /**
     * Get All with Pagination
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return $this->_model->orderBy('id', 'DESC')->paginate(Constains::PER_PAGE);
    }

    /**
     * Get all soft-deleted records
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTrashed(): ?Collection
    {

        return $this->_model->onlyTrashed()->get();
    }
}
