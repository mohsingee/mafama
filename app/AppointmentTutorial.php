<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentTutorial extends Model
{
    protected $fillable = [
        'video', 'name',
    ];
}
