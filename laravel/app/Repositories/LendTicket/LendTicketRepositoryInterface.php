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
    public function attachDetails(LendTicket $lendTicketed, array $bookDetails): void;
    public function getRelationship(array $relationships): Collection;
    public function getAllRelationship(array $relationships): LengthAwarePaginator;
    public function findAllRelationship($id, array $relationships): ?LendTicket;
    public function search(string $keyword): Collection;
}
