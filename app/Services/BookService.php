<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\Request;

class BookService
{
    public function create(Request $request)
    {
        $book = Book::create($request->only('title'));

        if ($request->authors) {
            $book->authors()->attach($request->authors);
        }

        if ($request->publishers) {
            $book->publishers()->attach($request->publishers);
        }

        return $book;
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->only('title'));
        
        $book->authors()->sync($request->authors);
        $book->publishers()->sync($request->publishers);

        return $book;
    }
}
