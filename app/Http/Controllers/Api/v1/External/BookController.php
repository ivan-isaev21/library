<?php

namespace App\Http\Controllers\Api\v1\External;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;
use Symfony\Component\HttpFoundation\Response;
use App\Services\BookService;

class BookController extends Controller
{
    public $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function store(\App\Http\Requests\CreateBookRequest $request)
    {
        $createdBook = $this->bookService->create($request);
        return response(new BookResource($createdBook), Response::HTTP_CREATED);
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function update(\App\Http\Requests\UpdateBookRequest $request, Book $book)
    {
        $updatedBook = $this->bookService->update($request, $book);
        return response(new BookResource($updatedBook), Response::HTTP_ACCEPTED);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
