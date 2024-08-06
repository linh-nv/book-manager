<?php

namespace App\Repositories\LendTicket;

use App\Enum\LendTicketStatus;
use App\Models\Book;
use App\Models\LendTicket;
use App\Repositories\BaseRepository;
use App\Repositories\LendTicket\LendTicketRepositoryInterface;
use App\Util\Constains;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TextUI\Configuration\Constant;

class LendTicketRepository extends BaseRepository implements LendTicketRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {

        return \App\Models\LendTicket::class;
    }

    public function loadRelationship($relationship = 'user'): Model
    {

        return $this->_model->load($relationship);
    }

    public function getPaginateAndRelationship(): LengthAwarePaginator
    {

        return $this->_model->with('user')->paginate(Constains::PER_PAGE);
    }

    public function getAllBooks(): Collection
    {
        $books = Book::pluck('name', 'id');

        return $books;
    }

    public function getRelationship(array $relationships): Collection
    {

        return $this->_model->with($relationships)->get();
    }

    public function getAllRelationship(array $relationships = ['user']): LengthAwarePaginator
    {

        return $this->_model->with($relationships)->orderBy('id', 'DESC')->paginate(Constains::PER_PAGE);
    }

    public function findAllRelationship($id, array $relationships = ['user']): ?LendTicket
    {

        return $this->_model->where('id', $id)->with($relationships)->first();
    }

    public function attachDetails(LendTicket $lendTicketed, array $bookDetails): void
    {
        $data = [];
        $pendingStatus = LendTicketStatus::PENDING;

        foreach ($bookDetails as $detail) {
            if (empty($detail['book_id'])) {
                continue;
            }

            $data[] = [
                'book_id' => $detail['book_id'],
                'lend_ticket_id' => $lendTicketed->id,
                'status' => $pendingStatus->value,
                'quantity' => $detail['quantity'] ?? 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        if (!empty($data)) {
            $lendTicketed->ticketDetails()->createMany($data);
        }
    }



    public function search(string $keyword): Collection
    {
        return $this->_model->where('note', 'like', '%' . $keyword . '%')
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })
            ->with(['user'])
            ->get();
    }
}
