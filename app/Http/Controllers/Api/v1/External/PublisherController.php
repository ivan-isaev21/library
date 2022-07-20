<?php

namespace App\Http\Controllers\Api\v1\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publisher;
use App\Http\Resources\PublisherResource;
use Symfony\Component\HttpFoundation\Response;

class PublisherController extends Controller
{    
    public function index()
    {
        return PublisherResource::collection(Publisher::paginate(10));
    }
    
    public function store(\App\Http\Requests\CreatePublisherRequest $request)
    {
        $createdPublisher = Publisher::create($request->only(['name']));
        return response(new PublisherResource($createdPublisher), Response::HTTP_CREATED);
    }
    
    public function show(Publisher $publisher)
    {
        return new PublisherResource($publisher);
    }

    public function update(\App\Http\Requests\UpdatePublisherRequest $request, Publisher $publisher)
    {
        $publisher->update($request->only(['name']));
        return response(new PublisherResource($publisher), Response::HTTP_ACCEPTED);
    }
    
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
