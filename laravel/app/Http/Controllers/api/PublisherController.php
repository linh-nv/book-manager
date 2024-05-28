<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Services\PublisherService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
{
    use ResponseHandler;

    protected $publisherService;

    public function __construct(PublisherService $publisherService)
    {
        $this->publisherService = $publisherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $publishers = $this->publisherService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $publishers);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the Publishers.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PublisherRequest $request): JsonResponse
    {
        try {
            $publisher = $this->publisherService->createPublisher($request->all());

            return $this->responseSuccess(Response::HTTP_CREATED, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the Publisher.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $publisher = $this->publisherService->getPublisherById($id);

            return $this->responseSuccess(Response::HTTP_OK, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the Publisher.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublisherRequest $request, int $id): JsonResponse
    {
        try {
            $publisher = $this->publisherService->updatePublisher($id, $request->all());

            return $this->responseSuccess(Response::HTTP_OK, $publisher);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the Publisher.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->publisherService->deletePublisher($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the Publisher.');
        }
    }
}
