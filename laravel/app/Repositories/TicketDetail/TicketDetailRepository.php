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
        
    public function search(string $keyword): Collection
    {
        return $this->_model->whereHas('book', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            })
                            ->orWhereHas('lendTicket', function ($query) use ($keyword) {
                                $query->where('note', 'like', '%' . $keyword . '%');
                            })
                            ->orWhere('status', 'like', '%' . $keyword . '%')
                            ->orWhere('quantity', 'like', '%' . $keyword . '%')
                            ->with(['book', 'lendTicket'])
                            ->get();
    }
}

