<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadScript extends Model
{
    protected $fillable = [
        'category', 'image', 'description',
    ];
}
