<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoSlides extends Model
{
    protected $fillable = [
        'name', 'comment', 'rating', 'image', 'status', 
    ];
}
