<?php

namespace App\Http\Controllers\Api\v1\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AuthorResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        return AuthorResource::collection(Author::all());
    }

    public function store(\App\Http\Requests\CreateAuthorRequest $request)
    {
        $createdAuthor = Author::create($request->only(['first_name', 'last_name']));
        return response(new AuthorResource($createdAuthor), Response::HTTP_CREATED);
    }

    public function show(Author $author)
    {
        return new AuthorResource($author);
    }

    public function update(\App\Http\Requests\UpdateAuthorRequest $request, Author $author)
    {
        $author->update($request->only(['first_name', 'last_name']));
        return response(new AuthorResource($author), Response::HTTP_ACCEPTED);
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
