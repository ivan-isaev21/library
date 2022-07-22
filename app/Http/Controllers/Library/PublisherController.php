<?php

namespace App\Http\Controllers\Library;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publisher;

class PublisherController extends Controller
{
    public function index()
    {
        return view('publisher.index');
    }

    public function create()
    {
        return view('publisher.create');
    }

    public function edit(Publisher $publisher)
    {
        return view('publisher.edit', compact('publisher'));
    }
}
