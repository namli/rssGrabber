<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedRequest;
use App\Model\Feeds;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Feeds::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeedRequest $request)
    {
        $feed = Feeds::create($request->validated());
        return response()->json($feed, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FeedRequest $request, $id)
    {
        $feed = Feeds::findOrFail($id);
        return $feed;
    }
    /**
     * Display post of same Feed
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showFeedPosts(Feeds $feed)
    {
        // $post = Posts::where('feeds_id', '=', $feed->id)->get();
        // return $post;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeedRequest $request, $id)
    {
        $feed = Feeds::findOrFail($id);
        $feed->fill($request->except(['id']));
        $feed->save();
        return response()->json($feed, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(FeedRequest $request, $id)
    {
        $feed = Feeds::findOrFail($id);
        $feed->delete();
        return response()->json(null, 204);
    }
}
