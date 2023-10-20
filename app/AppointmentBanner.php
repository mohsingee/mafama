<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
