<?php

namespace App\Services;

use App\Enum\TicketDetailStatus;
use App\Models\TicketDetail;
use App\Repositories\TicketDetail\TicketDetailRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TicketDetailService
{
    protected TicketDetailRepository $ticketDetailRepository;

    public function __construct(TicketDetailRepository $ticketDetailRepository)
    {
        
        $this->ticketDetailRepository = $ticketDetailRepository;
    }

    public function getPaginate(?string $keyword = null)
    {

        return $keyword ? $this->ticketDetailRepository->search($keyword) : $this->ticketDetailRepository->getAllRelationship();
    }

    public function createTicketDetail(array $data): TicketDetail
    {
        $borrowedStatus = TicketDetailStatus::BORROWED;

        return $this->ticketDetailRepository->create([
            'book_id' => $data['book_id'],
            'lend_ticket_id' => $data['lend_ticket_id'],
            'return_date' => null,
            'status' => $borrowedStatus->value,
            'quantity' => $data['quantity'],
            'created_at' => Carbon::now(),
        ]);
    }

    public function getTicketDetailById(int $id): TicketDetail
    {
        return $this->ticketDetailRepository->findAllRelationship($id);
    }

    public function getLendTicketById(int $lend_id): ?Collection
    {
        return $this->ticketDetailRepository->getLendTicket($lend_id);
    }

    public function updateTicketDetail(int $id, array $data): TicketDetail
    {
        $returnedStatus = TicketDetailStatus::RETURNED;

        return $this->ticketDetailRepository->update($id, [
            'book_id' => $data['book_id'],
            'lend_ticket_id' => $data['lend_ticket_id'],
            'return_date' => $data['status'] === $returnedStatus->value ? Carbon::now() : null,
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ]);
    }

    public function deleteTicketDetail(int $id): bool
    {

        return $this->ticketDetailRepository->delete($id);
    }
        
    public function restoreTicketDetail(int $id): bool
    {

        return $this->ticketDetailRepository->restore($id);
    }
        
    public function trashed(): Collection
    {

        return $this->ticketDetailRepository->getTrashed();
    }
}
