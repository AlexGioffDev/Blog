<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the comment data
        $validated = $request->validate([
            'form.body' => ['required'],
            'post_id' => ['required', 'exists:posts,id'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        // Create a new comment
        Comment::create([
            'body' => $validated['form']['body'],
            'post_id' => $validated['post_id'],
            'user_id' => $validated['user_id']
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['auth' => 'You are not authorized to delete this comment.']);
        }

        // Find the comment by ID
        $comment = Comment::find($id);

        // Check if the comment exists and if the user is the owner
        if ($comment && $comment->user_id == Auth::id()) {
            // Delete the comment
            $comment->delete();
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        }

        // Redirect back with an error message if the comment is not found or user is unauthorized
        return redirect()->back()->withErrors(['comment' => 'Comment not found or you do not have permission to delete it.']);
    }
}
