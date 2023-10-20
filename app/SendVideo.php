<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendVideo extends Model
{
    protected $fillable = [
        'email', 'subject', 'image', 'backhground', 'message', 'date', 'greeting', 'forecolorr', 'status', 'user_banner', 'time', 'uid', 'time_diff', 'times', 'count', 
    ];
}
