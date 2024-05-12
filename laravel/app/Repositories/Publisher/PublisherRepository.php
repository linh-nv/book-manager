<?php
namespace App\Repositories\Publisher;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

class PublisherRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Publisher::class;
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
