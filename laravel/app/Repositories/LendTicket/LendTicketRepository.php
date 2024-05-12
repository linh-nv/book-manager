<?php
namespace App\Repositories\LendTicket;

use App\Models\Author;
use App\Models\Category;
use App\Models\LendTicket;
use App\Models\Publisher;
use App\Repositories\BaseRepository;
use App\Repositories\LendTicket\LendTicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LendTicketRepository extends BaseRepository implements LendTicketRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\LendTicket::class;
    }

    public function loadRelationship($lendTicket): Collection
    {
        return $lendTicket->load('user');
    }


    public function getPaginateAndRelationship(): LengthAwarePaginator
    {

        return $this->_model->with('user')->paginate(/*Constants::PER_PAGE*/5);
    }
}
