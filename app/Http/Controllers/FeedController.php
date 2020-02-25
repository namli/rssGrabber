<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feeds;

class FeedController extends Controller
{
    public function index()
    {
        return Feeds::all();
    }

    public function show(Feeds $feed)
    {
        return $feed;
    }

    public function store(Request $request)
    {
        $feed = Feeds::create($request->all());

        return response()->json($feed, 201);
    }

    public function update(Request $request, Feeds $feed)
    {
        $feed->update($request->all());

        return response()->json($feed, 200);
    }

    public function delete(Feeds $feed)
    {
        $feed->delete();

        return response()->json(null, 204);
    }
}
