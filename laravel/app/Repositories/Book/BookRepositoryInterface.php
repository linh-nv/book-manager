<?php
namespace App\Repositories\Book;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookRepositoryInterface
{
    /**
     * Get all categories, authors, and publishers.
     *
     * @return array
     */
    public function getAllCategoriesAuthorsPublishers(): Array;
    public function getRelationship(array $relationships): Collection;
    public function getAllRelationship(array $relationships): LengthAwarePaginator;
    public function search(string $keyword): Collection;
}
