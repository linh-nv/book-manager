<?php
namespace App\Repositories\TicketDetail;

use Illuminate\Database\Eloquent\Collection;
use App\Models\TicketDetail;
use App\Repositories\BaseRepository;

class TicketDetailRepository extends BaseRepository implements TicketDetailRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {

        return TicketDetail::class;
    }

    public function getRelationship(array $relationships): Collection
    {

        return $this->_model->with($relationships)->get();
    }

    public function getAllRelationship(array $relationships = ['book', 'lendTicket']): Collection
    {

        return $this->_model->with($relationships)->get();
    }

    public function findAllRelationship($id, array $relationships = ['book', 'lendTicket']): Collection
    {
        
        return $this->_model->where('id', $id)->with($relationships)->get();
    }
}

