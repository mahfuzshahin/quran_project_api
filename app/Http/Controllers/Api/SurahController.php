<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SurahResource;
use Illuminate\Http\Request;
use App\Models\Surah;

class SurahController extends Controller
{
    public function index()
    {
        $surahs = Surah::all();

        return response()->json([
            'status' => true,
            'message' => 'All Surahs fetched successfully',
            'data' => SurahResource::collection($surahs)
        ], 200);
    }

    public function show($id)
    {
        $surah = Surah::find($id);
        if (!$surah) {
            return response()->json([
                'status' => false,
                'message' => 'Surah not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => new SurahResource($surah)
        ]);
    }
}
