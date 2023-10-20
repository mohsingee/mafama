<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendCard extends Model
{
    protected $fillable = [
        'email', 'subject', 'image', 'message', 'background', 'date', 'greeting', 'forecolorr', 'status', 'user_banner', 'time', 'uid', 'time_diff', 'times', 'count',
    ];
}
