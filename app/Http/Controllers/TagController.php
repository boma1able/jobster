<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(){

        $tags = Tag::latest()->get();
        $posts = Post::all();

        return view('dashboard.tags.create', compact('tags', 'posts'));
    }

    public function create()
    {
        $tags = Tag::latest()->get();
        return view('dashboard.tags.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:tags,slug',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => $request->slug ? \Str::lower($request->slug) : \Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.tags.create')->with('success', "Tag " . e($tag->name) . " was successfully created!");
    }

    public function show()
    {
        $posts = Post::latest()->get();

        return view('dashboard.tags.show', compact('posts'));
    }

    public function edit(Tag $tag)
    {
        $tags = Tag::with('posts')->latest()->get();
        return view('dashboard.tags.edit', compact('tag', 'tags'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => Rule::unique('tags')->ignore($tag->id),
            'description' => 'nullable|string|max:500',
        ]);

        $slug = $request->slug ? \Str::lower($request->slug) : \Str::slug($request->name);

        if ($slug !== $tag->slug) {
            $tag->slug = $slug;
        }

        $tag->update([
            'name' => $request->name,
            'slug' => $tag->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.tags.create', $tag)->with('success', "Tag " . e($tag->name) . " was successfully updated!");
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('dashboard.tags.create')->with('success', "Tag " . e($tag->name) . " was successfully deleted!");
    }
}
