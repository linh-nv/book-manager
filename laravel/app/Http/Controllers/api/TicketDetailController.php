<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketDetailRequest;
use App\Services\TicketDetailService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketDetailController extends Controller
{
    use ResponseHandler;

    protected $ticketDetailService;

    public function __construct(TicketDetailService $ticketDetailService)
    {
        $this->ticketDetailService = $ticketDetailService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $ticketDetails = $this->ticketDetailService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $ticketDetails);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the TicketDetails.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketDetailRequest $request): JsonResponse
    {
        try {
            $ticketDetail = $this->ticketDetailService->createTicketDetail($request->all());

            return $this->responseSuccess(Response::HTTP_CREATED, $ticketDetail);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the TicketDetail.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $ticketDetail = $this->ticketDetailService->getTicketDetailById($id);

            return $this->responseSuccess(Response::HTTP_OK, $ticketDetail);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the TicketDetail.');
        }
    }

    public function showLendTicket(int $lend_id): JsonResponse
    {
        try {
            $ticketDetail = $this->ticketDetailService->getLendTicketById($lend_id);

            return $this->responseSuccess(Response::HTTP_OK, $ticketDetail);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the TicketDetail.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TicketDetailRequest $request, int $id): JsonResponse
    {
        try {
            $ticketDetail = $this->ticketDetailService->updateTicketDetail($id, $request->all());

            return $this->responseSuccess(Response::HTTP_OK, $ticketDetail);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the TicketDetail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->ticketDetailService->deleteTicketDetail($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the TicketDetail.');
        }
    }
            
    public function restore(int $id): JsonResponse
    {
        try {
            $this->ticketDetailService->restoreTicketDetail($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
            
    public function trashed(): JsonResponse
    {
        try {
            $ticketDetails = $this->ticketDetailService->trashed();

            return $this->responseSuccess(Response::HTTP_OK, $ticketDetails);
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
}
