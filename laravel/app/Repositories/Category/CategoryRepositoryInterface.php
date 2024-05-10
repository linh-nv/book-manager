<?php
namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    /**
     * Get 5 Categorys hot in a month the last
     * @return mixed
     */
    public function getCategoryHost();
}
