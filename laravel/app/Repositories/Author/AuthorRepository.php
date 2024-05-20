<?php
namespace App\Repositories\Author;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Author::class;
    }
    
    public function search(string $keyword): Collection
    {
        return $this->_model->where('name', 'like', '%' . $keyword . '%')
                           ->orWhere('description', 'like', '%' . $keyword . '%')
                           ->get();
    }
}
