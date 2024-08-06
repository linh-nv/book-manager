<?php
namespace App\Repositories\Publisher;

use Illuminate\Database\Eloquent\Collection;

interface PublisherRepositoryInterface
{
    /**
     * Get 5 Categorys hot in a month the last
     * @return mixed
     */
    public function search(string $keyword): Collection;
}
