<?php
namespace App\Repositories\Book;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;

interface BookRepositoryInterface
{
    /**
     * Get all categories, authors, and publishers.
     *
     * @return array
     */
    public function getAllCategoriesAuthorsPublishers(): Array;
    public function loadRelationship(Book $book, array $relationships): Book;
    public function loadAllRelationship(Book $book, array $relationships): Book;
}
