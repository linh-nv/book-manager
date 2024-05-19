<?php
namespace App\Repositories\Author;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

class AuthorRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Author::class;
    }
    
}
