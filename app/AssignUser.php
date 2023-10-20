<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignUser extends Model
{
    protected $fillable = [
        'affiliate', 'enterprises', 'gold', 'silver', 'status',
    ];
}
