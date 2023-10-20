<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientManagementBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
