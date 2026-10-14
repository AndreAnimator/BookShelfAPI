<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Services\BookService;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return BookResource::collection($this->bookService->listAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UpdateBookRequest $request)
    {
        $book = $this->bookService->create($request->validated());

        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return new BookResource($this->bookService->findById($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, int $id)
    {
         $book = $this->bookService->update($id, $request->validated());

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->bookService->delete($id);

        return response()->noContent();
    }
}
