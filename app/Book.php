<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'title', 'author', 'category_id', 'pdf_path', 'cover_path'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
