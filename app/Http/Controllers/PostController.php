<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $posts = Post::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('dashboard.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $post = new Post();

        return view('dashboard.posts.create', compact('categories', 'post'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|min:3',
            'content'       => 'required|string',
            'category'    => 'array',
            'category.*'  => 'exists:category,id',
            'tags'          => 'nullable|string',
            'featured_img'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $slug = Str::slug(strtolower($validated['title']));
        $count = Post::where('slug', 'like', $slug . '%')->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('featured_img')) {
            $file = $request->file('featured_img');

            $originalName = $file->getClientOriginalName();

            $filename = pathinfo($originalName, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();

            $imagePath = $file->storeAs('media', $filename, 'public');
        }


        $post = Post::create([
            'user_id'       => auth()->id(),
            'title'         => $validated['title'],
            'slug'          => $slug,
            'content'       => $validated['content'],
            'featured_img'  => $imagePath,
        ]);

        if (isset($validated['category'])) {
            $post->categories()->sync($validated['category']);
        } else {
            $post->categories()->sync([]);
        }

        if ($request->tags) {
            $tagNames = explode(',', $request->tags);
            $tagIds = [];

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        }

        return redirect()->route('dashboard.posts.index')->with('success', 'Post was successfully created!!');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'         => 'required|string|min:3',
            'content'       => 'required|string',
            'category'    => 'array',
            'category.*'  => 'exists:category,id',
            'tags'          => 'nullable|string',
            'featured_img'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->input('remove_featured_img')) {
            if ($post->featured_img && Storage::disk('public')->exists($post->featured_img)) {
                Storage::disk('public')->delete($post->featured_img);
            }
            $post->featured_img = null;
        }

        // Завантаження нового зображення
        if ($request->hasFile('featured_img')) {
            $file = $request->file('featured_img');
            $fileHash = md5_file($file->getRealPath());

            // Видаляємо старий файл перед збереженням нового
            if ($post->featured_img && Storage::disk('public')->exists($post->featured_img)) {
                Storage::disk('public')->delete($post->featured_img);
            }

            // Збереження нового файлу у папці media
            $imagePath = 'media/' . $fileHash . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put($imagePath, file_get_contents($file));

            // Збереження шляху до файлу в базі
            $post->featured_img = $imagePath;
        }

        // Оновлення slug, якщо змінилася назва поста
        if ($post->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = Post::where('slug', 'like', $slug . '%')->where('id', '!=', $post->id)->count();
            $post->slug = $count > 0 ? $slug . '-' . ($count + 1) : $slug;
        }

        // Оновлення основних даних поста
        $post->fill([
            'title'   => $validated['title'],
            'content' => $validated['content'],
        ])->save();

        // Оновлення категорій
        $post->categories()->sync($validated['category'] ?? []);

        // Оновлення тегів
        if ($request->tags) {
            $tagNames = explode(',', $request->tags);
            $tagIds = [];

            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }

            $post->tags()->sync($tagIds);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('dashboard.posts.index', $post->id)->with('success', 'Post was successfully updated!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('dashboard.posts.index')->with('success', 'Post was successfully deleted!');
    }
}
