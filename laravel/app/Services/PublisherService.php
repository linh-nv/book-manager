<?php

namespace App\Services;

use App\Models\Publisher;
use App\Repositories\Publisher\PublisherRepository;
use Carbon\Carbon;

class PublisherService
{
    protected PublisherRepository $publisherRepository;

    public function __construct(PublisherRepository $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->publisherRepository->search($keyword) : $this->publisherRepository->getPaginate();
    }

    public function createPublisher(array $data): Publisher
    {
        $publisherData = [
            'name' => $data['name'],
            'description' => $data['description'],
            'created_at' => Carbon::now(),
        ];

        return $this->publisherRepository->create($publisherData);
    }

    public function getPublisherById(int $id): Publisher
    {
        return $this->publisherRepository->find($id);
    }

    public function updatePublisher(int $id, array $data): Publisher
    {

        return $this->publisherRepository->update($id, [
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
    }

    public function deletePublisher(int $id): bool
    {

        return $this->publisherRepository->delete($id);
    }
}
