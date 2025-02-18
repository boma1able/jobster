<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use function Symfony\Component\HttpFoundation\Session\Storage\Proxy\destroy;

class CommentController extends Controller
{

    public function index(Request $request)
    {

        $search = $request->get('search');

        $posts = Comment::with('user')
            ->when($search, function ($query) use ($search) {
                return $query->where('content', 'like', '%' . $search . '%');
            })->latest()->paginate(10);

        if ($request->has('user_comments') && $request->user_comments) {
            $comments = Comment::where('user_id', auth()->id())->latest()->get();
        }
        elseif($request->has('pending')) {
            $comments = Comment::where('approved', false)->latest()->get();
        }
        elseif($request->has('approved')) {
            $comments = Comment::where('approved', true)->latest()->get();
        }
        else {
            $comments = Comment::latest()->paginate(9);
        }

        return view('dashboard.comments.index', compact('comments', 'posts'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approved = true;
        $comment->save();

        return redirect()->route('dashboard.comments.index')->with('success', 'Comment approved.');
    }

    public function reject($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->approved = false;
        $comment->save();

        return redirect()->route('dashboard.comments.index')->with('success', 'Comment unapproved.');
    }

    public function store(Request $request, $postSlug)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post = Post::where('slug', $postSlug)->firstOrFail();

        $comment = $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'approved' => auth()->user()->isAdmin() ? true : false,
        ]);

        return redirect()->route('posts.show', $post->slug);
    }

    public function edit(Comment $comment)
    {
        return view('dashboard.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('dashboard.comments.index', $comment)->with('success', "Comment #" . e($comment->id) . " was successfully updated!");
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('dashboard.comments.index')->with('success', "Comment #" . e($comment->id) . " was successfully deleted!");

    }
}
