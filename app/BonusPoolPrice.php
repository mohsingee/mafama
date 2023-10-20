<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class BonusPoolPrice extends Model
{
    protected $fillable = [
        'level','price','prize','status',
    ];


}
