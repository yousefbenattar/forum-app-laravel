<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
       // 1. Validate the incoming data for safety
        $validated = $request->validate([
            'content' => 'required|min:3',
            'post_id' => 'required|exists:posts,id'
        ]);

        // 2. Create the comment
        $comment = Comment::create([
            'content' => $validated['content'],
            'post_id' => $validated['post_id'],
            'user_id' => auth()->id() 
        ]);

        // 3. Return JSON instead of a redirect
        return response()->json([
        'comment' => $comment->load('user')
    ], 201);
    }
    public function delete(Request $request)
    {
        Comment::where('id', $request['comment_id'])->delete();
        return back()->with('success', 'Comment deleted successfully!');
    }
}
