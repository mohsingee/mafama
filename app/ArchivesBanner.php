<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchivesBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
