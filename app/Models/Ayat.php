<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{
    use HasFactory;
    protected $fillable = [
        'surah_id',
        'arabic',
        'arabic_pronunciation',
        'bengali_translate',
        'bengali_modified',
        'english_modified',
        'ayat_no_english',
        'ayat_no_bengali',
        'prev_ayat_relation',
        'next_ayat_relation',
        'shane_nujul',
        'created_by',
        'updated_by',
    ];

    public function surah(){
        return $this->belongsTo(Surah::class, 'surah_id');
    }

    public function keywords()
    {
        return $this->hasMany(Keyword::class, 'ayat_id');
    }
}