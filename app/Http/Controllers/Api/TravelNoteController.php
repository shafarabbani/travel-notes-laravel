<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TravelNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TravelNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travelNotes = TravelNote::with('user')->latest()->paginate(10);
        return response()->json($travelNotes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|string|max:255',
            'location'   => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'date'       => 'required|date',
            'experience' => 'required|string',
            'mood'       => 'required|in:happy,relaxed,excited,adventurous,other',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('travel-photos', 'public');
        }

        $travelNote = auth('api')->user()->travelNotes()->create([
            'title'      => $request->title,
            'location'   => $request->location,
            'country'    => $request->country,
            'date'       => $request->date,
            'experience' => $request->experience,
            'mood'       => $request->mood,
            'photo'      => $photoPath,
        ]);

        return response()->json([
            'message' => 'Catatan perjalanan berhasil ditambahkan!',
            'data' => $travelNote->load('user')
        ], 201);
    }

    /**
     * Store a newly created resource using Base64 for the photo.
     */
    public function storeBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|string|max:255',
            'location'   => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'date'       => 'required|date',
            'experience' => 'required|string',
            'mood'       => 'required|in:happy,relaxed,excited,adventurous,other',
            'photo'      => 'nullable|string', // Berharap string Base64
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $photoPath = null;
        if ($request->filled('photo')) {
            $base64Image = $request->photo;
            
            // Ekstrak data base64 (menghapus prefix data:image/png;base64,)
            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, etc

                if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png', 'webp'])) {
                    return response()->json(['photo' => ['Tipe gambar tidak didukung.']], 422);
                }

                $base64Image = str_replace(' ', '+', $base64Image);
                $imageData = base64_decode($base64Image);
                
                if ($imageData === false) {
                    return response()->json(['photo' => ['Format Base64 tidak valid.']], 422);
                }

                $fileName = 'travel-photos/' . uniqid() . '.' . $type;
                Storage::disk('public')->put($fileName, $imageData);
                $photoPath = $fileName;
            }
        }

        $travelNote = auth('api')->user()->travelNotes()->create([
            'title'      => $request->title,
            'location'   => $request->location,
            'country'    => $request->country,
            'date'       => $request->date,
            'experience' => $request->experience,
            'mood'       => $request->mood,
            'photo'      => $photoPath,
        ]);

        return response()->json([
            'message' => 'Catatan perjalanan (Base64) berhasil ditambahkan!',
            'data' => $travelNote->load('user')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TravelNote $travelNote)
    {
        $travelNote->load(['user', 'comments' => function ($q) {
            $q->latest('created_at');
        }]);

        return response()->json($travelNote);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TravelNote $travelNote)
    {
        // Ownership check
        if ($travelNote->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'title'      => 'required|string|max:255',
            'location'   => 'required|string|max:255',
            'country'    => 'required|string|max:255',
            'date'       => 'required|date',
            'experience' => 'required|string',
            'mood'       => 'required|in:happy,relaxed,excited,adventurous,other',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $photoPath = $travelNote->photo;
        if ($request->hasFile('photo')) {
            if ($travelNote->photo) {
                Storage::disk('public')->delete($travelNote->photo);
            }
            $photoPath = $request->file('photo')->store('travel-photos', 'public');
        }

        $travelNote->update([
            'title'      => $request->title,
            'location'   => $request->location,
            'country'    => $request->country,
            'date'       => $request->date,
            'experience' => $request->experience,
            'mood'       => $request->mood,
            'photo'      => $photoPath,
        ]);

        return response()->json([
            'message' => 'Catatan perjalanan berhasil diperbarui!',
            'data' => $travelNote->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelNote $travelNote)
    {
        // Ownership check
        if ($travelNote->user_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($travelNote->photo) {
            Storage::disk('public')->delete($travelNote->photo);
        }

        $travelNote->delete();

        return response()->json(['message' => 'Catatan perjalanan berhasil dihapus!']);
    }
}
