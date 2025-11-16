<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    // List all tags
    public function index()
    {
        $tags = Tag::all();
        return response()->json([
            'status'  => true,
            'message' => 'Tags fetched successfully',
            'data'    => TagResource::collection($tags)
        ]);
    }

    // Create new tag
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bengali_name' => 'required|string|max:255',
            'english_name' => 'required|string|max:255',
        ]);

        $tag = Tag::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Tag created successfully',
            'data'    => new TagResource($tag)
        ], 201);
    }

    // Show single tag
    public function show(Tag $tag)
    {
        return response()->json([
            'status'  => true,
            'message' => 'Tag fetched successfully',
            'data'    => new TagResource($tag)
        ]);
    }

    // Update tag
    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'bengali_name' => 'sometimes|required|string|max:255',
            'english_name' => 'sometimes|required|string|max:255',
        ]);

        $tag->update($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Tag updated successfully',
            'data'    => new TagResource($tag)
        ]);
    }

    // Delete tag
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Tag deleted successfully'
        ]);
    }
}
