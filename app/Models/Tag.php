<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'bengali_name',
        'english_name',
    ];

    public function ayats()
{
    return $this->belongsToMany(Ayat::class, 'keywords')
                ->withTimestamps();
}
    
}