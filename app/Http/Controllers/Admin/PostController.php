<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Event\ViewEvent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'exists:tags,id',
                'image' => 'nullable|image|max:100000'
            ]
        );

        $data = $request->all();

        if (array_key_exists('image', $data)) {
        $img_path = Storage::put('cover', $data['image']);
        $data['cover_image'] = $img_path;
        }
        
        $post = new Post();

        $post->fill($data);

        //create a unique slug from post title
        $slug = $this->generateSlug($post->title);
        $post->slug = $slug;
        //end slug method

        $post->save();


        //checks if the tags array received from the tags checkboxes in admin.create isn't empty and then writes the data in the pivot table
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('status', 'Post created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'exists:tags,id',
                'image' => 'nullable|image|max:100000'
            ]
        );

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            Storage::delete($post->cover_image);
            $img_path = Storage::put('cover', $data['image']);
            $data['cover_image'] = $img_path;
        }

        if($post->title !== $data['title']) {
            $data['slug'] = $this->generateSlug($data['title']);
        }

        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        $post->update($data);

        return redirect()->route('admin.posts.index', compact('post'))->with('status', 'Post updated!');
    }

    protected function generateSlug($title) {
        $slug = Str::slug($title, '-');
        $checkPost = Post::where('slug', $slug)->first();
        $counter = 1;
        while($checkPost) {
            $slug = Str::slug($title . '-' . $counter, '-');
            $counter++;
            $checkPost = Post::where('slug', $slug)->first();
        }

        return $slug;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        };

        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Post deleted!');;
    }

    public function deleteCoverImage(Post $post) {
        if ($post->cover_image) {
            Storage::delete($post->cover_image);
        };

        $post->cover_image = null;
        $post->save();

        return redirect()->route('admin.posts.edit', ['post' => $post->id])->with('status', 'Cover image deleted!');
    }
}
