<?php
namespace App\Repositories\TicketDetail;

use App\Models\TicketDetail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
interface TicketDetailRepositoryInterface
{
    public function getRelationship(string $relationships): Collection;
    public function getAllRelationship(array $relationships): LengthAwarePaginator;
    public function findAllRelationship($id, array $relationships): ?TicketDetail;
    public function search(string $keyword): Collection;
    public function getLendTicket($lend_id): ?Collection;
}

