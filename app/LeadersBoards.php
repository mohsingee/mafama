<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadersBoards extends Model
{
    protected $fillable = [
        'title', 'sub_title', 'description'
    ];

}