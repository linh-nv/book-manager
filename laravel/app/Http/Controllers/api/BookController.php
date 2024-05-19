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
use Illuminate\Http\Request;

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
        $book = $this->bookRepository->getAllRelationship();
    
        return $this->responseSuccess(200, $book);
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

            if (isset($arrPathImages['front_image'])) {
                $bookData['front_image'] = $arrPathImages['front_image'];
            }

            if (isset($arrPathImages['thumbnail'])) {
                $bookData['thumbnail'] = $arrPathImages['thumbnail'];
            }

            if (isset($arrPathImages['rear_image'])) {
                $bookData['rear_image'] = $arrPathImages['rear_image'];
            }

            $book = $this->bookRepository->create($bookData);

            return $this->responseSuccess(201, $book);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the book.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): JsonResponse
    {

        return $this->responseSuccess(200, $this->bookRepository->findAllRelationship($book->id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        try {
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

            return $this->responseSuccess(200, $book);
        } catch (\Exception $e) {
            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the book.');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        try {
            $this->bookRepository->delete($book->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the Book.');
        }
    }
}
