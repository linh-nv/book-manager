<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LendTicketRequest;
use App\Models\LendTicket;
use App\Repositories\LendTicket\LendTicketRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        try {
            $lendTicket = $this->lendTicketRepository->getAllRelationship();

            return $this->responseSuccess(Response::HTTP_OK, $lendTicket);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while fetching the lend tickets.');
        }
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

            return $this->responseSuccess(Response::HTTP_CREATED, $this->lendTicketRepository->findAllRelationship($lendTicketed->id));
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
            $lendTicket = $this->lendTicketRepository->findAllRelationship($id);

            return $this->responseSuccess(Response::HTTP_OK, $lendTicket);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'LendTicket not found.');
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
            $lendTicket = $this->lendTicketRepository->find($id);

            $lendTicketData = [
                'user_id' => $request->user_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'note' => $request->note,
            ];

            $lendTicket = $this->lendTicketRepository->update($lendTicket->id, $lendTicketData);

            return $this->responseSuccess(Response::HTTP_OK, $this->lendTicketRepository->findAllRelationship($lendTicket->id));
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'LendTicket not found.');
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
            $lendTicket = $this->lendTicketRepository->find($id);

            $this->lendTicketRepository->delete($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'LendTicket not found.');
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the LendTicket.');
        }
    }

    /**
     * Search for lend tickets by a keyword.
     */
    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->lendTicketRepository->search($keyword);
            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for lend tickets.');
        }
    }
}
