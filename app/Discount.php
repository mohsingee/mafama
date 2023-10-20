<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'per_1','per_2','per_3','per_4','per_5','flat_1','flat_2','flat_3','flat_4','flat_5'
    ];
}
