<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    use HasFactory;
    protected $fillable = [
        'ayat_id',
        'tag_id',
        'created_by',
        'updated_by',
    ];
    public function tag(){
        return $this->belongsTo(Tag::class, 'tag_id');
    }

}