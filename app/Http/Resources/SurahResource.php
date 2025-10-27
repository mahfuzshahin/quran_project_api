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
            'id'                  => $this->id,
            'surah_id'            => $this->surah_id,
            'ayat_no_in_surah'    => $this->ayat_no_in_surah,
            'arabic_text'         => $this->arabic_text,
            'bangla_translation'  => $this->bangla_translation,
            'english_translation' => $this->english_translation,
            'created_by'          => $this->created_by,
            'updated_by'          => $this->updated_by,
            'created_at'          => $this->created_at,
            'updated_at'          => $this->updated_at,
        ];
    }
}
