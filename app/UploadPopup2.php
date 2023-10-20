<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadPopup2 extends Model
{
    protected $fillable = [
        'category', 'image', 'description', 'fontcolor', 'background', 'preview',
    ];
}
