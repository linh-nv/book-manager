<?php
namespace App\Repositories\Category;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

class CategoryRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Category::class;
    }

    // /**
    //  * Get 5 posts hot in a month the last
    //  * @return mixed
    //  */
    // public function getPostHost()
    // {
    //     return $this->_model::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('view', 'desc')->take(5)->get();
    // };
    
}
