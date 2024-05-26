<?php

namespace App\Services;

use App\Models\TicketDetail;
use App\Repositories\TicketDetail\TicketDetailRepository;
use Carbon\Carbon;

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

        return $this->ticketDetailRepository->create([
            'book_id' => $data['book_id'],
            'lend_ticket_id' => $data['lend_ticket_id'],
            'return_date' => $data['return_date'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
            'created_at' => Carbon::now(),
        ]);
    }

    public function getTicketDetailById(int $id): TicketDetail
    {
        return $this->ticketDetailRepository->find($id);
    }

    public function updateTicketDetail(int $id, array $data): TicketDetail
    {

        return $this->ticketDetailRepository->update($id, [
            'book_id' => $data['book_id'],
            'lend_ticket_id' => $data['lend_ticket_id'],
            'return_date' => $data['return_date'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ]);
    }

    public function deleteTicketDetail(int $id): bool
    {

        return $this->ticketDetailRepository->delete($id);
    }
}
