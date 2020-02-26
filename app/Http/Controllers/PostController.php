<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Model\Posts;
use App\Model\Feeds;

class PostController extends Controller
{
    public function index()
    {
        $post = $this->getPostsFromFeed();
        return Posts::all();
    }

    public function show(PostRequest $request, $id)
    {
        $post = Posts::findOrFail($id);
        return $post;
    }

    // If we add post from request 
    //**************** */
    public function storeRequest(PostRequest $request)
    {
        $post = Posts::create($request->validated());
        return response()->json($post, 201);
    }

    //* If we grab post from feeds
    //*********************** */
    public function storeGrub($item = null, $feed = null)
    {
        if (!empty($item)) {
            $post = Posts::create([
                'title' => $item->get_title(),
                'description' => $item->get_description(),
                'link' => $item->get_permalink(),
                'guid' => $item->get_id(),
                'author' => $item->get_author()->name,
                'pub_time' => $item->get_date('Y-m-d H:i:s'),
                'feeds_id' => $feed->id
            ]);
        }
        return response()->json($post, 201);
    }

    public function update(PostRequest $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post->fill($request->except(['id']));
        $post->save();
        return response()->json($post, 200);
    }

    public function delete(PostRequest $request, $id)
    {
        $feed = Posts::findOrFail($id);
        $feed->delete();
        return response()->json(null, 204);
    }

    public function getPostsFromFeed()
    {
        $feeds = Feeds::all();
        foreach ($feeds as $key => $feed) {
            $feedrss = \Feeds::make($feed->url_rss);
            foreach ($feedrss->get_items() as $key => $item) {
                $post = $this->storeGrub($item, $feed);
            }
        }
    }
}
