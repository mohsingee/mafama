<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
