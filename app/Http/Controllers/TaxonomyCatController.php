<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class TaxonomyCatController extends Controller
{
    public function show(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(9);

        return view('taxonomy.category', compact('category', 'posts'));
    }
}
