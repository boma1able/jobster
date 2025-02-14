<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('posts')->latest()->get();

        return view('dashboard.categories.create', compact('categories'));
    }

    public function create()
    {
        $categories = Category::latest()->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ? Str::lower($request->name) : Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.categories.create')->with('success', "Category " . e($category->name) . " was successfully created!");
    }

    public function show()
    {
        return view('dashboard.categories.create', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::with('posts')->latest()->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => Rule::unique('categories')->ignore($category->id),
            'description' => 'nullable|string|max:500',
        ]);

        $slug = $request->slug ? Str::lower($request->name) : Str::slug($request->name);

        if ($slug !== $category->slug) {
            $category->slug = $slug;
        }

        $category->update([
            'name' => $request->name,
            'slug' => $category->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard.categories.create', $category)->with('success', "Category " . e($category->name) . " was successfully updated!");
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.categories.create')->with('success', "Category " . e($category->name) . " was successfully deleted!");
    }

}
