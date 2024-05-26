<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    use ResponseHandler;

    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->query('keyword');

        try {
            $categories = $this->categoryService->getPaginate($keyword);

            return $this->responseSuccess(Response::HTTP_OK, $categories);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the Categorys.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->createCategory($request->all());

            return $this->responseSuccess(Response::HTTP_CREATED, $category);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the Category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->getCategoryById($id);

            return $this->responseSuccess(Response::HTTP_OK, $category);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while retrieving the Category.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->updateCategory($id, $request->all());

            return $this->responseSuccess(Response::HTTP_OK, $category);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the Category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the Category.');
        }
    }
}
