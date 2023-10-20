<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notification extends Model
{
    protected $fillable = [
        'notification', 'uid',
    ];


}
