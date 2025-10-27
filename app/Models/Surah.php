<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_in_english',
        'name_in_bengali',
        'name_in_arabic',
        'type',
        'description',
        'surah_no_in_quran',
        'no_of_ayat',
        'created_by',
        'updated_by',
    ];
}