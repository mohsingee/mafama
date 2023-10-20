<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusReport extends Model
{
    protected $fillable = [
        'client_id', 'diagnostic', 'recommendation', 'medication',
    ];
}
