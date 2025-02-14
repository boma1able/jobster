<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TaxonomyTagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(9);

        return view('taxonomy.tag', compact('tag', 'posts'));
    }
}
