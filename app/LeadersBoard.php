<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadersBoard extends Model
{
    protected $fillable = [
        'title', 'sub_title', 'description'
    ];

}