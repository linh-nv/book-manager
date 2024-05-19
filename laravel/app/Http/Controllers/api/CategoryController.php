<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Traits\ResponseHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $category = $this->categoryRepository->getPaginate();

        return $this->responseSuccess(200, $category);
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

            return $this->responseSuccess(201, $category);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): JsonResponse
    {

        return $this->responseSuccess(200, $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        try {
            $category = $this->categoryRepository->update($category->id, [
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
            ]);

            return $this->responseSuccess(200, $category);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the category.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        try {
            $this->categoryRepository->delete($category->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the category.');
        }
    }
}
