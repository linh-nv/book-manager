<?php
namespace App\Repositories\Publisher;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
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
    
    public function search(string $keyword): Collection
    {
        return $this->_model->where('name', 'like', '%' . $keyword . '%')
                           ->orWhere('description', 'like', '%' . $keyword . '%')
                           ->get();
    }
    
}
