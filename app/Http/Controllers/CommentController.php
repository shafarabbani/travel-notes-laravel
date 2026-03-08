<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\TravelNote;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Simpan komentar baru.
     */
    public function store(Request $request, TravelNote $travelNote)
    {
        $validated = $request->validate([
            'author'       => ['required', 'string', 'max:255'],
            'comment_text' => ['required', 'string', 'max:2000'],
        ]);

        $travelNote->comments()->create($validated);

        return redirect()->route('travel-notes.show', $travelNote)
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Hapus komentar yang ditentukan.
     * Hanya pemilik catatan perjalanan yang dapat menghapus komentar.
     */
    public function destroy(TravelNote $travelNote, Comment $comment)
    {
        if (auth()->id() !== $travelNote->user_id) {
            abort(403, 'Kamu tidak memiliki izin untuk melakukan tindakan ini.');
        }

        $comment->delete();

        return redirect()->route('travel-notes.show', $travelNote)
            ->with('success', 'Komentar berhasil dihapus!');
    }
}
