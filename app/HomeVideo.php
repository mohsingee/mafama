<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeVideo extends Model
{
    protected $fillable = [
        'video', 'startdate', 'enddate', 'status',
    ];
}
