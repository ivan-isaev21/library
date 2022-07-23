<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return view('author.index');
    }

    public function create()
    {
        return view('author.create');
    }

    public function edit(Author $author)
    {
        return view('author.edit', compact('author'));
    }
}
