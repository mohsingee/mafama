<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailTutorial extends Model
{
    protected $fillable = [
        'video', 'name',
    ];
}
