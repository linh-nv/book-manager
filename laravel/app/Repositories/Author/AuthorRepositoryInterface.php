<?php
namespace App\Repositories\Author;

use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    /**
     * Get 5 Categorys hot in a month the last
     * @return mixed
     */
    public function search(string $keyword): Collection;
}
