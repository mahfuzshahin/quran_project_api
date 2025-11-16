<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;
use App\Http\Resources\KeywordResource;

class KeywordController extends Controller
{
    /**
     * Store a new keyword for an Ayat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ayat_id' => 'required|exists:ayats,id',
            'tag_id'  => 'required|exists:tags,id',
        ]);

        // Create keyword
        $keyword = Keyword::create([
            'ayat_id'    => $validated['ayat_id'],
            'tag_id'     => $validated['tag_id'],
            'created_by' => auth()->id() ?? 1,
            'updated_by' => auth()->id() ?? 1,
        ]);

        // Load the related tag
        $keyword->load('tag');

        return response()->json([
            'status'  => true,
            'message' => 'Keyword added successfully',
            'data'    => new KeywordResource($keyword),
        ], 201);
    }
}
