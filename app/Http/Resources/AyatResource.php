<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\KeywordResource;

class AyatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'surah_id' => $this->surah_id,
            'arabic' => $this->arabic,
            'arabic_pronunciation' => $this->arabic_pronunciation,
            'bengali_translate' => $this->bengali_translate,
            'bengali_modified' => $this->bengali_modified,
            'english_modified' => $this->english_modified,
            'ayat_no_english' => $this->ayat_no_english,
            'ayat_no_bengali' => $this->ayat_no_bengali,
            'prev_ayat_relation' => $this->prev_ayat_relation,
            'next_ayat_relation' => $this->next_ayat_relation,
            'shane_nujul' => $this->shane_nujul,
            'keywords' => KeywordResource::collection($this->whenLoaded('keywords')),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
