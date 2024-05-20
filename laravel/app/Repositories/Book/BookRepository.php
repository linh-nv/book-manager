<?php
namespace App\Repositories\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
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

    public function getRelationship(array $relationships): Collection
    {
        return $this->_model->with($relationships)->get();
    }

    public function getAllRelationship(array $relationships = ['category', 'author', 'publisher']): Collection
    {
        return $this->_model->with($relationships)->get();
    }

    public function findAllRelationship($id, array $relationships = ['category', 'author', 'publisher']): Collection
    {
        return $this->_model->where('id', $id)->with($relationships)->get();
    }

    public function search(string $keyword): Collection
    {

        return $this->_model->where('name', 'like', '%' . $keyword . '%')
                           ->orWhere('description', 'like', '%' . $keyword . '%')
                           ->orWhere('slug', 'like', '%' . $keyword . '%')
                           ->orWhere('description', 'like', '%' . $keyword . '%')
                           ->orWhere('price', 'like', '%' . $keyword . '%')
                           ->orWhereHas('author', function ($query) use ($keyword) {
                               $query->where('name', 'like', '%' . $keyword . '%');
                           })
                           ->orWhereHas('category', function ($query) use ($keyword) {
                               $query->where('name', 'like', '%' . $keyword . '%');
                           })
                           ->orWhereHas('publisher', function ($query) use ($keyword) {
                               $query->where('name', 'like', '%' . $keyword . '%');
                           })
                           ->with(['author', 'category', 'publisher'])
                           ->get();
    }
}
