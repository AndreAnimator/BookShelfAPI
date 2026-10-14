<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Services\GenreService;

class GenreController extends Controller
{
    public function __construct(
        private GenreService $genreService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GenreResource::collection($this->genreService->listAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {
        $genre = $this->genreService->create($request->validated());

        return new GenreResource($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new GenreResource($this->genreService->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, int $id)
    {
        $genre = $this->genreService->update($id, $request->validated());

        return new GenreResource($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->genreService->delete($id);

        return response()->noContent();
    }
}
