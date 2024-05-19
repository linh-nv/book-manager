<?php
namespace App\Repositories\LendTicket;

use App\Models\lendTicket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface LendTicketRepositoryInterface
{
    public function loadRelationship(LendTicket $lendTicket): Model;
    public function getPaginateAndRelationship(): LengthAwarePaginator;
    public function attach($lendTicketed, $book_ids, $quantities): void;
    public function getRelationship(array $relationships): Collection;
    public function getAllRelationship(array $relationships): Collection;
    public function findAllRelationship($id, array $relationships): Collection;

}
