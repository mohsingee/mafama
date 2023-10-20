<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendEmail extends Model
{
    protected $fillable = [
        'email', 'campaign_name', 'subject', 'image', 'backhground', 'message', 'date', 'status', 'user_banner', 'time', 'uid', 'time_diff', 'times', 'count',
    ];
}
