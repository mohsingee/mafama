<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'email', 'rating',
    ];
}
