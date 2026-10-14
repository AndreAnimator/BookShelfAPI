<?php

namespace App\Services;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreService
{
    public function listAll(): Collection
    {
        return Genre::all();
    }

    public function create(array $data): Genre
    {
        return Genre::create($data);
    }

    public function findById(int $id): Genre
    {
        return Genre::findOrFail($id);
    }

    public function update(int $id, array $data): Genre
    {
        $genre = Genre::findOrFail($id);
        $genre->update($data);

        return $genre;
    }

    public function delete(int $id): void
    {
        Genre::findOrFail($id)->delete();
    }
}