<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AyatResource;
use App\Models\Ayat;
use App\Models\Tag;
use Illuminate\Http\Request;

class AyatController extends Controller
{
    public function index()
    {
        $ayats = Ayat::all();

        return response()->json([
            'status' => true,
            'message' => 'All Ayats fetched successfully',
            'data' => AyatResource::collection($ayats),
        ]);
    }

    // Search by Surah ID
    public function getBySurah($surah_id)
    {
        $ayats = Ayat::where('surah_id', $surah_id)->get();

        if ($ayats->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No Ayats found for this Surah',
                'data' => [],
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Ayats fetched successfully for this Surah',
            'data' => AyatResource::collection($ayats),
        ]);
    }


    public function addKeywords(Request $request, $ayat_id)
    {
        $request->validate([
            'tags' => 'required|array',
            'tags.*.bengali_name' => 'required|string',
            'tags.*.english_name' => 'required|string',
        ]);

        $ayat = Ayat::findOrFail($ayat_id);

        $tagIds = [];

        foreach ($request->tags as $tagData) {
            // Check if tag exists by english_name (or bengali_name)
            $tag = Tag::firstOrCreate(
                ['english_name' => $tagData['english_name']],
                ['bengali_name' => $tagData['bengali_name']]
            );

            $tagIds[] = $tag->id;
        }

        // Attach tags to Ayat without duplicates
        $ayat->tags()->syncWithoutDetaching($tagIds);

        return response()->json([
            'status' => true,
            'message' => 'Tags added successfully',
            'data' => $ayat->tags()->get(),
        ]);
    }
}
