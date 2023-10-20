<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientMedication extends Model
{
    protected $fillable = [
        'client_id', 'report', 'status',
    ];
}
