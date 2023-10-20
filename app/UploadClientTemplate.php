<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadClientTemplate extends Model
{
    protected $fillable = [
        'category', 'image', 'description',
    ];
}
