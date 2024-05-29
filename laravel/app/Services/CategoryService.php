<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Carbon\Carbon;

class CategoryService
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->categoryRepository->search($keyword) : $this->categoryRepository->getPaginate();
    }

    public function createCategory(array $data): Category
    {
        $categoryData = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'created_at' => Carbon::now(),
        ];

        return $this->categoryRepository->create($categoryData);
    }

    public function getCategoryById(int $id): Category
    {
        return $this->categoryRepository->find($id);
    }

    public function updateCategory(int $id, array $data): Category
    {

        return $this->categoryRepository->update($id, [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
        ]);
    }

    public function deleteCategory(int $id): bool
    {

        return $this->categoryRepository->delete($id);
    }
}
