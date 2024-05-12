<?php
namespace App\Repositories\LendTicket;

use App\Models\lendTicket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface LendTicketRepositoryInterface
{
    public function loadRelationship(LendTicket $lendTicket): Collection;
    public function getPaginateAndRelationship(): LengthAwarePaginator;

}
