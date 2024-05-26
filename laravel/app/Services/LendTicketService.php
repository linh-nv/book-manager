<?php

namespace App\Services;

use App\Models\LendTicket;
use App\Repositories\LendTicket\LendTicketRepository;
use Carbon\Carbon;

class LendTicketService
{
    protected LendTicketRepository $lendTicketRepository;

    public function __construct(LendTicketRepository $lendTicketRepository)
    {
        $this->lendTicketRepository = $lendTicketRepository;
    }

    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->lendTicketRepository->search($keyword) : $this->lendTicketRepository->getAllRelationship();
    }

    public function createLendTicket(array $data): LendTicket
    {
        return $this->lendTicketRepository->create([
            'user_id' => $data['user_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
            'note' => $data['note'],
            'created_at' => Carbon::now(),
        ]);
    }

    public function getLendTicketById(int $id): LendTicket
    {
        return $this->lendTicketRepository->find($id);
    }

    public function updateLendTicket(int $id, array $data): LendTicket
    {
        return $this->lendTicketRepository->update( $id, [
            'user_id' => $data['user_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
            'note' => $data['note'],
        ]);
    }

    public function deleteLendTicket(int $id): bool
    {

        return $this->lendTicketRepository->delete($id);
    }
}
