<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'isi',
        'tag_id'
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_artikels','artikel_id','tag_id');
    }
}
