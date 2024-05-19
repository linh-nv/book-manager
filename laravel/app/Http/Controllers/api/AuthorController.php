<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Repositories\Author\AuthorRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;

class AuthorController extends Controller
{
    use ResponseHandler;

    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $author = $this->authorRepository->getPaginate();

        return $this->responseSuccess(200, $author);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        try {
            $author = $this->authorRepository->create([
                'name' => $request->name,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);

            return $this->responseSuccess(201, $author);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the author.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author): JsonResponse
    {

        return $this->responseSuccess(200, $author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        try {
            $author = $this->authorRepository->update($author->id, [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return $this->responseSuccess(200, $author);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the author.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author): JsonResponse
    {
        try {
            $this->authorRepository->delete($author->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the author.');
        }
    }
}
