<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;
use App\Repositories\Publisher\PublisherRepository;
use App\Traits\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        return $this->responseSuccess(200, $publisher);
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

            return $this->responseSuccess(201, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the publisher.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher): JsonResponse
    {

        return $this->responseSuccess(200, $publisher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, Publisher $publisher): JsonResponse
    {
        try {
            $publisher = $this->publisherRepository->find($publisher->id);
            
            if (!$publisher) {
                return $this->responseError(404, 'NOT_FOUND', 'Publisher not found.');
            }

            $publisher = $this->publisherRepository->update($publisher->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return $this->responseSuccess(200, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the publisher.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher): JsonResponse
    {
        try {
            $publisher = $this->publisherRepository->find($publisher->id);
            
            if (!$publisher) {
                return $this->responseError(404, 'NOT_FOUND', 'Publisher not found.');
            }

            $this->publisherRepository->delete($publisher->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the publisher.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(400, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->publisherRepository->search($keyword);
            return $this->responseSuccess(200, $results);
        } catch (\Exception $e) {
            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while searching for authors.');
        }
    }
}
