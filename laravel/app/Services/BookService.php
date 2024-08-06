<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\Book\BookRepository;
use Carbon\Carbon;

use function App\Helpers\deleteImage;
use function App\Helpers\updateImage;
use function App\Helpers\uploadImage;

class BookService
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * Get all books or search books by keyword.
     *
     * @param string|null $keyword
     * @return mixed
     */
    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->bookRepository->search($keyword) : $this->bookRepository->getAllRelationship();
    }

    public function getAllCategoriesAuthorsPublishers(): Array
    {
        return $this->bookRepository->getAllCategoriesAuthorsPublishers();
    }
    /**
     * Create a new book.
     *
     * @param array $data
     * @return Book
     */
    public function createBook(array $data): Book
    {
        $bookData = [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'quantity' => $data['quantity'],
            'description' => $data['description'],
            'front_image' => isset($data['front_image']) ? uploadImage($data['front_image']) : '',
            'thumbnail' => isset($data['thumbnail']) ? uploadImage($data['thumbnail']) : '',
            'rear_image' => isset($data['rear_image']) ? uploadImage($data['rear_image']) : '',
            'category_id' => $data['category_id'],
            'author_id' => $data['author_id'],
            'publisher_id' => $data['publisher_id'],
            'price' => $data['price'],
            'created_at' => Carbon::now(),
        ];

        return $this->bookRepository->create($bookData);
    }

    /**
     * Get a book by id with all relationships.
     *
     * @param int $id
     * @return Book
     */
    public function getBookById(int $id): Book
    {
        return $this->bookRepository->findAllRelationship($id);
    }

    /**
     * Update a book.
     *
     * @param int $id
     * @param array $data
     * @return Book
     */
    public function updateBook(int $id, array $data): Book
    {
        $book = $this->bookRepository->find($id);

        $updateData = [
            'name' => $data['name'] ?? $book->name,
            'slug' => $data['slug'] ?? $book->slug,
            'quantity' => $data['quantity'] ?? $book->quantity,
            'description' => $data['description'] ?? $book->description,
            'category_id' => $data['category_id'] ?? $book->category_id,
            'author_id' => $data['author_id'] ?? $book->author_id,
            'publisher_id' => $data['publisher_id'] ?? $book->publisher_id,
            'price' => $data['price'] ?? $book->price,
            'front_image' => isset($data['front_image']) ? updateImage($data['front_image'], $book->front_image) : $book->front_image,
            'thumbnail' => isset($data['thumbnail']) ? updateImage($data['thumbnail'], $book->thumbnail) : $book->thumbnail,
            'rear_image' => isset($data['rear_image']) ? updateImage($data['rear_image'], $book->rear_image) : $book->rear_image,
            'updated_at' => Carbon::now(),
        ];

        $this->bookRepository->update($id, $updateData);

        return $book;
    }

    /**
     * Delete a book and its associated images.
     *
     * @param int $id
     * @return bool
     */
    public function deleteBook(int $id): bool
    {
        $book = $this->bookRepository->find($id);

        deleteImage($book->front_image);
        deleteImage($book->thumbnail);
        deleteImage($book->rear_image);

        return $this->bookRepository->delete($id);
    }

}
