<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->Paginate(3);
        $categories = Category::all();

        foreach ($posts as $post) {
            if (!$post->user) {
                $post->name = 'Anonimus';
            } else {
                $post->name = $post->user->name;
            }
        }

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('user')->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function store(Request $request)
    {
        $post = Post::create($request->only('title', 'content', 'slug', 'user_id'));

        $tags = explode(',', $request->tags);
        $tagIds = [];

        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);

        return redirect()->route('blog.index');
    }

}
