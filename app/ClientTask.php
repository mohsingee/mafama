<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientTask extends Model
{
    protected $fillable = [
        'client_id', 'task', 'outcome', 'message', 'client_submit', 'status',
    ];
}
