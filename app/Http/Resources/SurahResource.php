<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_in_english' => $this->name_in_english,
            'name_in_bengali' => $this->name_in_bengali,
            'name_in_arabic' => $this->name_in_arabic,
            'type' => $this->type,
            'description' => $this->description,
            'surah_no_in_quran' => $this->surah_no_in_quran,
            'no_of_ayat' => $this->no_of_ayat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
