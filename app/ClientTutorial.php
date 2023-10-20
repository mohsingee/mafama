<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientTutorial extends Model
{
    protected $fillable = [
        'video', 'name',
    ];
}
