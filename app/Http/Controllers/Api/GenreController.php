<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Genre::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $genre = Genre::create($request->all());

        return response()->json($genre, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Genre::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->update($request->all());

        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Genre::findOrFail($id)->delete();

        return response()->noContent();
    }
}
