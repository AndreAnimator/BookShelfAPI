<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    public function listAll(): Collection
    {
        return Book::with('genre')->get();
    }

    public function create(array $data): Book
    {
        return Book::create($data);
    }

    public function findById(int $id): Book
    {
        return Book::with('genre')->findOrFail($id);
    }

    public function update(int $id, array $data): Book
    {
        $book = Book::findOrFail($id);
        $book->update($data);

        return $book;
    }

    public function delete(int $id): void
    {
        Book::findOrFail($id)->delete();
    }
}