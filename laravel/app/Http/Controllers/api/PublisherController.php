<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;
use App\Repositories\Publisher\PublisherRepository;
use App\Traits\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    use ResponseHandler;

    protected $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $publisher = $this->publisherRepository->getPaginate();

        return $this->responseSuccess(Response::HTTP_OK, $publisher);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherRequest $request): JsonResponse
    {
        try {
            $publisher = $this->publisherRepository->create([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => now(),
            ]);

            return $this->responseSuccess(Response::HTTP_CREATED, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the publisher.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher): JsonResponse
    {

        return $this->responseSuccess(Response::HTTP_OK, $publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, Publisher $publisher): JsonResponse
    {
        try {
            $publisher = $this->publisherRepository->find($publisher->id);

            $publisher = $this->publisherRepository->update($publisher->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return $this->responseSuccess(Response::HTTP_OK, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the publisher.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher): JsonResponse
    {
        try {
            $publisher = $this->publisherRepository->find($publisher->id);

            $this->publisherRepository->delete($publisher->id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the publisher.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->publisherRepository->search($keyword);
            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for authors.');
        }
    }
}
