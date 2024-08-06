<?php

namespace App\Http\Controllers;

use App\Models\LendTicket;
use App\Models\Book;
use App\Repositories\LendTicket\LendTicketRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class LendTicketController extends Controller
{
    protected $lendTicketRepository;

    public function __construct(LendTicketRepository $lendTicketRepository)
    {
        $this->lendTicketRepository = $lendTicketRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $lendTickets = $this->lendTicketRepository->getPaginateAndRelationship();  

        return view('pages.lend_ticket.index', compact('lendTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lendTickets = $this->lendTicketRepository->getAll();   
        $this->lendTicketRepository->loadRelationship($lendTickets);

        $books = $this->lendTicketRepository->getAllBooks();

        return view('pages.lend_ticket.form', compact('lendTickets', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request);
        if ($request->has([
            'user_id',
            'start_date',
            'end_date',
            'status',
            'note',
        ])) {

            $lendTicketed = $this->lendTicketRepository->create([
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'note' => $request->note,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $this->lendTicketRepository->attach($lendTicketed, $request->book_id, $request->quantities);
            
            return redirect()->route('lend_ticket.index');
        }
        return redirect()->back()->with(['error' => 'Creat lend ticket false!!']); 
    }

    /**
     * Display the specified resource.
     */
    public function show(LendTicket $lendTicketed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $lendTicketed = $this->lendTicketRepository->find($id);
        $lendTickets = $this->lendTicketRepository->getAll();   
        $this->lendTicketRepository->loadRelationship($lendTickets);

        $books = $this->lendTicketRepository->getAllBooks();

        return view('pages.lend_ticket.form', compact('lendTicketed', 'lendTickets', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->has([
            'user_id',
            'start_date',
            'end_date',
            'status',
            'note',
        ])) {

            $lendTicketed = $this->lendTicketRepository->update( $id, [
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'note' => $request->note,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            
            return redirect()->route('lend_ticket.index');
        }
        return redirect()->back()->with(['error' => 'Update lend ticket false!!']); 
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->lendTicketRepository->delete($id);
        
        return redirect()->route('lend_ticket.index');
    }
}
