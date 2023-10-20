<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
     protected $fillable = [
        'level', 'code_name', 'vstart_date', 'vend_date', 'vstart_time', 'vend_time', 'fees', 'fees_frequency',
    ];
}
