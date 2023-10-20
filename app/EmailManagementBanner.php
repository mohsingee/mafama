<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailManagementBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
