<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendSms extends Model
{
    protected $fillable = [
        'email', 'subject', 'image', 'backhground', 'message', 'date', 'greeting', 'forecolorr', 'status', 'user_banner', 'time', 'uid', 'time_diff', 'times', 'count','phone_no',
    ];
}
