<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use function Symfony\Component\HttpFoundation\Session\Storage\Proxy\destroy;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        $comments = Comment::with('user')
        ->when($request->has('user_comments') && $request->user_comments, function ($query) {
            return $query->where('user_id', auth()->id());
        })
            ->when($request->has('pending'), function ($query) {
                return $query->where('approved', false);
            })
            ->when($request->has('approved'), function ($query) {
                return $query->where('approved', true);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('content', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.comments.index', compact('comments', 'search'));
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
