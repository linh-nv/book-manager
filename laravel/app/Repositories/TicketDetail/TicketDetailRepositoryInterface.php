<?php
namespace App\Repositories\TicketDetail;

use Illuminate\Database\Eloquent\Collection;

interface TicketDetailRepositoryInterface
{
    public function getRelationship(array $relationships): Collection;
    public function getAllRelationship(array $relationships): Collection;
    public function findAllRelationship($id, array $relationships): Collection;
}

