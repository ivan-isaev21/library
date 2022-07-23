<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Resources\BookResource;

class LibraryController extends Controller
{
    public function home(){
        return view("library.home");
    }
    public function index()
    {
        return view("library.index");
    }

    public function edit(Book $book)
    {
        return view("library.edit", compact('book'));
    }

    public function create()
    {
        return view("library.create");
    }
}
