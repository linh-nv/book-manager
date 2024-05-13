<?php
namespace App\Repositories\TicketDetail;

use App\Models\TicketDetail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TicketDetailRepositoryInterface
{
    public function getPaginateAndRelationship(): LengthAwarePaginator;

}
