<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeTopVideo extends Model
{
    protected $fillable = [
        'video', 'startdate', 'enddate', 'status', 'display',
    ];
}
