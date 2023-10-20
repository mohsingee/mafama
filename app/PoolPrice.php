<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class PoolPrice extends Model
{
    protected $fillable = [
        'bonus_one_price','bonus_two_price','bonus_three_price','bonus_four_price','bonus_pize','other',
    ];


}
