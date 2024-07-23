<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\Author\AuthorRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    protected AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->authorRepository->search($keyword) : $this->authorRepository->getPaginate();
    }

    public function createAuthor(array $data): Author
    {
        $authorData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'created_at' => Carbon::now(),
        ];

        return $this->authorRepository->create($authorData);
    }

    public function getAuthorById(int $id): Author
    {
        return $this->authorRepository->find($id);
    }

    public function updateAuthor(int $id, array $data): Author
    {

        return $this->authorRepository->update($id, [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function deleteAuthor(int $id): bool
    {

        return $this->authorRepository->delete($id);
    }

    public function restoreAuthor(int $id): bool
    {

        return $this->authorRepository->restore($id);
    }

    public function trashed(): Collection
    {

        return $this->authorRepository->getTrashed();
    }
}
