<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LendTicketRequest;
use App\Models\LendTicket;
use App\Repositories\LendTicket\LendTicketRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;

class LendTicketController extends Controller
{
    use ResponseHandler;

    protected $lendTicketRepository;

    public function __construct(LendTicketRepository $lendTicketRepository)
    {
        $this->lendTicketRepository = $lendTicketRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $lendTicket = $this->lendTicketRepository->getAllRelationship();
    
        return $this->responseSuccess(200, $lendTicket);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LendTicketRequest $request): JsonResponse
    {
        try {

            $lendTicketed = $this->lendTicketRepository->create([
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'note' => $request->note,
                'created_at' => Carbon::now(),
            ]);
            // $this->lendTicketRepository->attach($lendTicketed, $request->book_id, $request->quantities);

            return $this->responseSuccess(200, $this->lendTicketRepository->findAllRelationship($lendTicketed->id));
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the LendTicket.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LendTicket $lendTicket): JsonResponse
    {

        return $this->responseSuccess(200, $this->lendTicketRepository->findAllRelationship($lendTicket->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LendTicketRequest $request, LendTicket $lendTicket): JsonResponse
    {
        try {

            $lendTicketData = [
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'note' => $request->note,
            ];

            $lendTicket = $this->lendTicketRepository->update($lendTicket->id, $lendTicketData);

            return $this->responseSuccess(200, $this->lendTicketRepository->findAllRelationship($lendTicket->id));
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the LendTicket.');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LendTicket $lendTicket): JsonResponse
    {
        try {
            $this->lendTicketRepository->delete($lendTicket->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {
throw $e;
            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the LendTicket.');
        }
    }
}
