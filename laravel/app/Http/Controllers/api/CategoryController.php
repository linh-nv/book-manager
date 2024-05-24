<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Traits\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use ResponseHandler;

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $category = $this->categoryRepository->getPaginate();

            return $this->responseSuccess(Response::HTTP_CREATED, $category);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while fetching the categories.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryRepository->create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'created_at' => now(),
            ]);

            return $this->responseSuccess(Response::HTTP_CREATED, $category);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryRepository->find($id);

            return $this->responseSuccess(Response::HTTP_OK, $category);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Category not found.');
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the category.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        try {
            $category = $this->categoryRepository->find($category->id);

            $category = $this->categoryRepository->update($category->id, [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
            ]);

            return $this->responseSuccess(Response::HTTP_OK, $category);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Category not found.');
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the category.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $category = $this->categoryRepository->find($category->id);

            $this->categoryRepository->delete($category->id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'Category not found.');
        } catch (\Exception $e) {
            throw $e;
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the category.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {

            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->categoryRepository->search($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for authors.');
        }
    }
}
