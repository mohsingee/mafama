<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadBusiness extends Model
{
    protected $fillable = [
        'category', 'image', 'description',
    ];
}
