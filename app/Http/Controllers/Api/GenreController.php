<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GenreService;
use Illuminate\Http\Request;

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
        return response()->json($this->genreService->listAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genre = $this->genreService->create($request->all());

        return response()->json($genre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json($this->genreService->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $genre = $this->genreService->update($id, $request->all());

        return response()->json($genre);
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
