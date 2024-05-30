<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ResponseHandler;

    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $authors = $this->authorService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $authors);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the authors.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        try {
            $author = $this->authorService->createAuthor($request->all());

            return $this->responseSuccess(Response::HTTP_CREATED, $author);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the author.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $author = $this->authorService->getAuthorById($id);

            return $this->responseSuccess(Response::HTTP_OK, $author);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the author.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, int $id): JsonResponse
    {
        try {
            $author = $this->authorService->updateAuthor($id, $request->all());

            return $this->responseSuccess(Response::HTTP_OK, $author);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the author.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->authorService->deleteAuthor($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }

    public function restore(int $id): JsonResponse
    {
        try {
            $this->authorService->restoreAuthor($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }

    public function trashed(): JsonResponse
    {
        try {
            $authors = $this->authorService->trashed();

            return $this->responseSuccess(Response::HTTP_OK, $authors);
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
}
