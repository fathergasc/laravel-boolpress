<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::with('category', 'tags')->get();

        $posts = Post::with('category', 'tags')->paginate(3);

        foreach ($posts as $post) {
            if ($post->cover_image) {
                $post->cover_image = asset('storage/' .$post->cover_image);
            } else {
                $post->cover_image = asset('img/no_cover_default.jpg');
            }
        }

        return response()->json(
            [
                'success' => true,
                'results' => $posts,
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'tags')->first();

        if ($post->cover_image) {
            $post->cover_image = asset('storage/' .$post->cover_image);
        } else {
            $post->cover_image = asset('img/no_cover_default.jpg');
        }


        if ($post) {
            return response()->json(
                [
                    'success' => true,
                    'results' => $post,
                ]
                );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => "Post not found",
                ]
                );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
