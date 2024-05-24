<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketDetailRequest;
use App\Models\TicketDetail;
use App\Repositories\TicketDetail\TicketDetailRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketDetailController extends Controller
{
    use ResponseHandler;

    protected $ticketDetailRepository;

    public function __construct(TicketDetailRepository $ticketDetailRepository)
    {
        $this->ticketDetailRepository = $ticketDetailRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $ticketDetail = $this->ticketDetailRepository->getAllRelationship();
    
        return $this->responseSuccess(Response::HTTP_OK, $ticketDetail);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketDetailRequest $request): JsonResponse
    {
        try {

            $ticketDetailed = $this->ticketDetailRepository->create([
                'book_id' => $request->book_id,
                'lend_ticket_id' => $request->lend_ticket_id,
                'return_date' => $request->return_date,
                'status' => $request->status,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);

            return $this->responseSuccess(Response::HTTP_CREATED, $this->ticketDetailRepository->findAllRelationship($ticketDetailed->id));
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the TicketDetail.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketDetail $ticketDetail): JsonResponse
    {

        return $this->responseSuccess(Response::HTTP_OK, $this->ticketDetailRepository->findAllRelationship($ticketDetail->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketDetailRequest $request, TicketDetail $ticketDetail): JsonResponse
    {
        try {
            $ticketDetail = $this->ticketDetailRepository->find($ticketDetail->id);
            
            if (!$ticketDetail) {

                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'ticketDetail not found.');
            }

            $ticketDetailData = [
                'book_id' => $request->book_id,
                'lend_ticket_id' => $request->lend_ticket_id,
                'return_date' => $request->return_date,
                'status' => $request->status,
                'quantity' => $request->quantity,
            ];

            $ticketDetail = $this->ticketDetailRepository->update($ticketDetail->id, $ticketDetailData);

            return $this->responseSuccess(Response::HTTP_OK, $this->ticketDetailRepository->findAllRelationship($ticketDetail->id));
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the TicketDetail.');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketDetail $ticketDetail): JsonResponse
    {
        try {            
            $ticketDetail = $this->ticketDetailRepository->find($ticketDetail->id);
            
            if (!$ticketDetail) {

                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'ticketDetail not found.');
            }

            $this->ticketDetailRepository->delete($ticketDetail->id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the TicketDetail.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->ticketDetailRepository->search($keyword);
            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for ticket details.');
        }
    }
}
