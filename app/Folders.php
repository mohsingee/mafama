<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folders extends Model
{
    protected $fillable = [
        'folder_name', 'uid',
    ];
}
