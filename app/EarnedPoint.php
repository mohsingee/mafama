<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class EarnedPoint extends Model
{
    protected $fillable = [
        'no_of_login','login_points','no_of_hours','hour_points','start_date','end_date','status',
    ];





}
