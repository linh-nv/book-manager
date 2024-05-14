<?php
namespace App\Repositories\LendTicket;

use App\Models\lendTicket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface LendTicketRepositoryInterface
{
    public function loadRelationship(LendTicket $lendTicket): Collection;
    public function getPaginateAndRelationship(): LengthAwarePaginator;
    public function attach($lendTicketed, $book_ids, $quantities): void;

}
