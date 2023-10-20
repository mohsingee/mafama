<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_invite extends Model
{
    protected $fillable = [
        'name', 'email', 'user_id',
    ];
}