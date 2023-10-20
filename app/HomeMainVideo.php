<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeMainVideo extends Model
{
    protected $fillable = [
        'video', 'startdate', 'enddate', 'status',
    ];
}
