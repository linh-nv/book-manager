<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LendTicketRequest;
use App\Services\LendTicketService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LendTicketController extends Controller
{
    use ResponseHandler;

    protected $lendTicketService;

    public function __construct(LendTicketService $lendTicketService)
    {
        $this->lendTicketService = $lendTicketService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $lendTickets = $this->lendTicketService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $lendTickets);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the LendTickets.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LendTicketRequest $request): JsonResponse
    {
        try {
            $lendTicket = $this->lendTicketService->createLendTicket($request->all(), $request->ticketDetails);

            return $this->responseSuccess(Response::HTTP_CREATED, $lendTicket);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the LendTicket.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $lendTicket = $this->lendTicketService->getLendTicketById($id);

            return $this->responseSuccess(Response::HTTP_OK, $lendTicket);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the LendTicket.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LendTicketRequest $request, int $id): JsonResponse
    {
        try {
            $lendTicket = $this->lendTicketService->updateLendTicket($id, $request->all());

            return $this->responseSuccess(Response::HTTP_OK, $lendTicket);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the LendTicket.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->lendTicketService->deleteLendTicket($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the LendTicket.');
        }
    }
        
    public function restore(int $id): JsonResponse
    {
        try {
            $this->lendTicketService->restoreLendTicket($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
        
    public function trashed(): JsonResponse
    {
        try {
            $lendTickets = $this->lendTicketService->trashed();

            return $this->responseSuccess(Response::HTTP_OK, $lendTickets);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
}
