<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Model\Posts;
use App\Model\Feeds;

class PostController extends Controller
{
    public function index()
    {
        $post = $this->getPostsFromFeed();
        return Posts::all();
    }

    public function show(Posts $post)
    {
        return $post;
    }

    public function showFeedPosts(Feeds $feed)
    {
        $post = Posts::where('feeds_id', '=', $feed->id)->get();
        return $post;
    }
    // If we add post from request 
    //**************** */
    public function storeRequest(Request $request, $item = null, $feed = null)
    {
        if (!empty($request)) {
            $validator = Validator::make(
                $request->all(),
                [
                    'guid' => 'unique:posts,guid',
                ]
            );
            if (!$validator->fails()) {
                $post = Posts::create($request->all());
            } else {
                $post = "Post exists";
            }
        }
        return response()->json($post, 201);
    }
    public function storeGrub($item = null, $feed = null)
    {
        //* If we grab post from feeds
        //*********************** */
        if (!empty($item)) {
            $validator = Validator::make(
                [
                    'guid' => $item->get_id()
                ],
                [
                    'guid' => 'unique:posts,guid',
                ]
            );
            if (!$validator->fails()) {
                $post = Posts::create([
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'link' => $item->get_permalink(),
                    'guid' => $item->get_id(),
                    'author' => $item->get_author()->name,
                    'pub_time' => $item->get_date('Y-m-d H:i:s'),
                    'feeds_id' => $feed->id
                ]);
            } else {
                $post = "Post exists";
            }
        }
        return response()->json($post, 201);
    }

    public function update(Request $request, Posts $post)
    {
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete(Posts $post)
    {
        $post->delete();

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
