<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

class UserRepository extends BaseRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        
        return \App\Models\User::class;
    }

}
