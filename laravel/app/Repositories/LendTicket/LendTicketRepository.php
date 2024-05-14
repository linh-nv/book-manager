<?php
namespace App\Repositories\LendTicket;

use App\Models\Book;
use App\Repositories\BaseRepository;
use App\Repositories\LendTicket\LendTicketRepositoryInterface;
use App\Util\Constains;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
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

    public function loadRelationship($lendTicket): Collection
    {

        return $lendTicket->load('user');
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

    public function attach($lendTicketed, $book_ids, $quantities, $type = null): void
    {
        $data = [];
    
        foreach ($book_ids as $book_id) {
            $data[$book_id] = [
                'lend_ticket_id' => $lendTicketed->id,
                'status' => 1,
                'quantity' => $quantities[$book_id],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
    
        $this->_model->ticketDetails()->attach($data);
    }
}
