<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadCard extends Model
{
    protected $fillable = [
        'category', 'image', 'description',
    ];
}
