<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ResponseHandler;

    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $books = $this->bookService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $books);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the books.');
        }
    }

    public function getAllCategoriesAuthorsPublishers(): JsonResponse
    {
        try {
            $books = $this->bookService->getAllCategoriesAuthorsPublishers();

            return $this->responseSuccess(Response::HTTP_OK, $books);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the books.');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): JsonResponse
    {
        try {
            $book = $this->bookService->createBook($request->all());

            return $this->responseSuccess(Response::HTTP_CREATED, $book);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the book.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $book = $this->bookService->getBookById($id);

            return $this->responseSuccess(Response::HTTP_OK, $book);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the book.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, int $id): JsonResponse
    {
        try {
            $book = $this->bookService->updateBook($id, $request->all());
            
            return $this->responseSuccess(Response::HTTP_OK, $book);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the book.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->bookService->deleteBook($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the book.');
        }
    }
    
    public function restore(int $id): JsonResponse
    {
        try {
            $this->bookService->restoreBook($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
    
    public function trashed(): JsonResponse
    {
        try {
            $books = $this->bookService->trashed();

            return $this->responseSuccess(Response::HTTP_OK, $books);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
}