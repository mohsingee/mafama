<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VideoTrainingRecord extends Model
{
    protected $fillable = [
        'user_id','video_id','status',
    ];

}