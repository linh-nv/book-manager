<?php
namespace App\Repositories\TicketDetail;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
interface TicketDetailRepositoryInterface
{
    public function getRelationship(array $relationships): Collection;
    public function getAllRelationship(array $relationships): LengthAwarePaginator;
    public function findAllRelationship($id, array $relationships): Collection;
    public function search(string $keyword): Collection;
}

