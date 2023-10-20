<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextBanner extends Model
{
    protected $fillable = [
        'image', 'text', 'startdate','link', 'enddate', 'status',
    ];
}
