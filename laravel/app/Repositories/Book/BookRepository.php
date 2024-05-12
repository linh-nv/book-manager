<?php
namespace App\Repositories\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Book::class;
    }

    /**
     * Get all categories, authors, and publishers.
     *
     * @return array
     */
    public function getAllCategoriesAuthorsPublishers(): Array
    {
        $categories = Category::pluck('name', 'id');
        $authors = Author::pluck('name', 'id');
        $publishers = Publisher::pluck('name', 'id');        

        return compact('categories', 'authors', 'publishers');
    }

    public function loadRelationship(Book $book, array $relationships): Book
    {
        return $book->load($relationships);
    }

    public function loadAllRelationship(Book $book, array $relationships = ['category', 'author', 'publisher']): Book
    {
        return $book->load($relationships);
    }
}
