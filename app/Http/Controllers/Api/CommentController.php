<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\TravelNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of comments for a specific travel note.
     */
    public function indexByTravelNote(TravelNote $travelNote)
    {
        $comments = $travelNote->comments()->latest()->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, TravelNote $travelNote)
    {
        $validator = Validator::make($request->all(), [
            'author'       => 'required|string|max:255',
            'comment_text' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = $travelNote->comments()->create($validator->validated());

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan!',
            'data' => $comment
        ], 201);
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        // Only the owner of the travel note can edit comments (policy decision)
        if ($comment->travelNote->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'author'       => 'required|string|max:255',
            'comment_text' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment->update($validator->validated());

        return response()->json([
            'message' => 'Komentar berhasil diperbarui!',
            'data' => $comment
        ]);
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Comment $comment)
    {
        // Only the owner of the travel note can delete comments
        if ($comment->travelNote->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Komentar berhasil dihapus!']);
    }
}
