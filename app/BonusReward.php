<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BonusReward extends Model
{
    protected $fillable = [
        'user_id','level','amount','description','sponsor_id','status',
    ];


}
