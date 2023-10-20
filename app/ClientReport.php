<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientReport extends Model
{
    protected $fillable = [
        'client_id', 'report', 'status',
    ];
}
