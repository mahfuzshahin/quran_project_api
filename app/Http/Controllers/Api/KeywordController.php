<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Keyword;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\KeywordResource;

class KeywordController extends Controller
{
    /**
     * Store a new keyword for an Ayat
     */
    public function storeTest(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'ayat_id' => 'required|exists:ayats,id',
            'tag_id'  => [
                'required',
                'exists:tags,id',
                Rule::unique('keywords')->where(function ($query) use ($request) {
                    return $query->where('ayat_id', $request->ayat_id);
                }),
            ],
        ]);

        // Create keyword
        $keyword = Keyword::create([
            'ayat_id'    => $validated['ayat_id'],
            'tag_id'     => $validated['tag_id'],
            'created_by' => auth()->id() ?? 1,
            'updated_by' => auth()->id() ?? 1,
        ]);

        // Load related tag
        $keyword->load('tag');

        return response()->json([
            'status'  => true,
            'message' => 'Keyword added successfully',
            'data'    => new KeywordResource($keyword),
        ], 201);
    }

    public function store(Request $request)
    {
        // Validate base fields
        $validated = $request->validate([
            'ayat_id' => 'required|exists:ayats,id',
            'tag_id'  => 'nullable|exists:tags,id',
            'english_name' => 'nullable|string|max:255',
            'bengali_name' => 'nullable|string|max:255',
        ]);

        // CASE 1: Existing tag selected
        if ($request->tag_id) {
            // Check duplicate keyword
            $exists = Keyword::where('ayat_id', $request->ayat_id)
                            ->where('tag_id', $request->tag_id)
                            ->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'This tag is already added for this Ayat.',
                ], 422);
            }

            $tag_id = $request->tag_id;
        } 
        // CASE 2: Create new tag
        else {
            if (!$request->english_name) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please provide english_name for the new tag.',
                ], 422);
            }

            // Check if tag already exists (by english_name + bengali_name)
            $existingTag = Tag::where('english_name', $request->english_name)
                            ->where('bengali_name', $request->bengali_name)
                            ->first();

            if ($existingTag) {
                $tag_id = $existingTag->id;
            } else {
                // Create new tag
                $tag = Tag::create([
                    'english_name' => $request->english_name,
                    'bengali_name' => $request->bengali_name,
                ]);
                $tag_id = $tag->id;
            }

            // Check duplicate keyword for this new tag
            $exists = Keyword::where('ayat_id', $request->ayat_id)
                            ->where('tag_id', $tag_id)
                            ->exists();

            if ($exists) {
                return response()->json([
                    'status' => false,
                    'message' => 'This tag is already added for this Ayat.',
                ], 422);
            }
        }

        // Create keyword
        $keyword = Keyword::create([
            'ayat_id'    => $request->ayat_id,
            'tag_id'     => $tag_id,
            'created_by' => auth()->id() ?? 1,
            'updated_by' => auth()->id() ?? 1,
        ]);

        // Load tag relationship
        $keyword->load('tag');

        return response()->json([
            'status' => true,
            'message' => 'Keyword added successfully',
            'data' => new KeywordResource($keyword),
        ], 201);
    }

    public function destroy($id)
{
    $keyword = Keyword::find($id);

    if (!$keyword) {
        return response()->json([
            'status' => false,
            'message' => 'Keyword not found',
        ], 404);
    }

    $keyword->delete();

    return response()->json([
        'status' => true,
        'message' => 'Keyword deleted successfully',
    ], 200);
}

}
