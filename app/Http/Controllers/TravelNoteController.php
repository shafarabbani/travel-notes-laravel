<?php

namespace App\Http\Controllers;

use App\Models\TravelNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Tampilkan daftar semua catatan perjalanan.
     */
    public function index()
    {
        $travelNotes = TravelNote::with('user')
            ->latest()
            ->paginate(9);

        return view('travel-notes.index', compact('travelNotes'));
    }

    /**
     * Tampilkan formulir untuk membuat catatan baru.
     */
    public function create()
    {
        return view('travel-notes.create');
    }

    /**
     * Simpan catatan perjalanan baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'location'   => ['required', 'string', 'max:255'],
            'country'    => ['required', 'string', 'max:255'],
            'date'       => ['required', 'date'],
            'experience' => ['required', 'string'],
            'mood'       => ['required', 'in:happy,relaxed,excited,adventurous,other'],
            'photo'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('travel-photos', 'public');
        }

        Auth::user()->travelNotes()->create([
            'title'      => $validated['title'],
            'location'   => $validated['location'],
            'country'    => $validated['country'],
            'date'       => $validated['date'],
            'experience' => $validated['experience'],
            'mood'       => $validated['mood'],
            'photo'      => $photoPath,
        ]);

        return redirect()->route('travel-notes.index')
            ->with('success', 'Catatan perjalanan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail catatan perjalanan.
     */
    public function show(TravelNote $travelNote)
    {
        $travelNote->load(['user', 'comments' => function ($q) {
            $q->latest('created_at');
        }]);

        return view('travel-notes.show', compact('travelNote'));
    }

    /**
     * Tampilkan formulir untuk mengubah catatan.
     */
    public function edit(TravelNote $travelNote)
    {
        $this->authorize('update', $travelNote);

        return view('travel-notes.edit', compact('travelNote'));
    }

    /**
     * Perbarui catatan perjalanan di database.
     */
    public function update(Request $request, TravelNote $travelNote)
    {
        $this->authorize('update', $travelNote);

        $validated = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'location'   => ['required', 'string', 'max:255'],
            'country'    => ['required', 'string', 'max:255'],
            'date'       => ['required', 'date'],
            'experience' => ['required', 'string'],
            'mood'       => ['required', 'in:happy,relaxed,excited,adventurous,other'],
            'photo'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $photoPath = $travelNote->photo;
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($travelNote->photo) {
                Storage::disk('public')->delete($travelNote->photo);
            }
            $photoPath = $request->file('photo')->store('travel-photos', 'public');
        }

        $travelNote->update([
            'title'      => $validated['title'],
            'location'   => $validated['location'],
            'country'    => $validated['country'],
            'date'       => $validated['date'],
            'experience' => $validated['experience'],
            'mood'       => $validated['mood'],
            'photo'      => $photoPath,
        ]);

        return redirect()->route('travel-notes.show', $travelNote)
            ->with('success', 'Catatan perjalanan berhasil diperbarui!');
    }

    /**
     * Hapus catatan perjalanan dari database.
     */
    public function destroy(TravelNote $travelNote)
    {
        $this->authorize('delete', $travelNote);

        if ($travelNote->photo) {
            Storage::disk('public')->delete($travelNote->photo);
        }

        $travelNote->delete();

        return redirect()->route('travel-notes.index')
            ->with('success', 'Catatan perjalanan berhasil dihapus!');
    }
}
