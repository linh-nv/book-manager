<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\Book\BookRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ResponseHandler;

    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $books = $this->bookRepository->getAllRelationship();
            return $this->responseSuccess(Response::HTTP_OK, $books);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while fetching the books.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request): JsonResponse
    {
        try {
            $uploadImages = new ImageController();
            $arrPathImages = $uploadImages->uploadBookImage($request);

            $bookData = [
                'name' => $request->name,
                'slug' => $request->slug,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'front_image' => $arrPathImages['front_image'] ?? '',
                'thumbnail' => $arrPathImages['thumbnail'] ?? '',
                'rear_image' => $arrPathImages['rear_image'] ?? '',
                'category_id' => $request->category_id,
                'author_id' => $request->author_id,
                'publisher_id' => $request->publisher_id,
                'price' => $request->price,
                'created_at' => Carbon::now(),
            ];

            $book = $this->bookRepository->create($bookData);

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
            $book = $this->bookRepository->findAllRelationship($id);

            if (!$book) {
                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
            }

            return $this->responseSuccess(Response::HTTP_OK, $book);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
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
            $book = $this->bookRepository->find($id);

            if (!$book) {
                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
            }

            $uploadImages = new ImageController();
            $arrPathImages = $uploadImages->uploadBookImage($request);

            $bookData = [
                'name' => $request->name,
                'slug' => $request->slug,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'author_id' => $request->author_id,
                'publisher_id' => $request->publisher_id,
                'price' => $request->price ?? $book->price,
            ];

            if (isset($arrPathImages['front_image'])) {
                $bookData['front_image'] = $arrPathImages['front_image'];
            }

            if (isset($arrPathImages['thumbnail'])) {
                $bookData['thumbnail'] = $arrPathImages['thumbnail'];
            }

            if (isset($arrPathImages['rear_image'])) {
                $bookData['rear_image'] = $arrPathImages['rear_image'];
            }

            $book = $this->bookRepository->update($book->id, $bookData);

            return $this->responseSuccess(Response::HTTP_OK, $book);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
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
            $book = $this->bookRepository->find($id);

            if (!$book) {
                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
            }

            $this->bookRepository->delete($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Book not found.');
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the book.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->bookRepository->search($keyword);
            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for books.');
        }
    }
}
