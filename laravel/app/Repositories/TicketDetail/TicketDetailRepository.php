<?php
namespace App\Repositories\TicketDetail;

use App\Models\Author;
use App\Models\Category;
use App\Models\TicketDetail;
use App\Models\Publisher;
use App\Repositories\BaseRepository;
use App\Repositories\TicketDetail\TicketDetailRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TicketDetailRepository extends BaseRepository implements TicketDetailRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\TicketDetail::class;
    }

    public function getPaginateAndRelationship(): LengthAwarePaginator
    {

        return $this->_model->with('user')->paginate(Constants::PER_PAGE);
    }
}
