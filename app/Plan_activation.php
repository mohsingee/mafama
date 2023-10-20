<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_activation extends Model
{
    protected $fillable = [
        'user_id', 'plan_id','amount','status',
    ];


 


}
