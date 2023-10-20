<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDiagnosticReport extends Model
{
    protected $fillable = [
        'client_id', 'report', 'status',
    ];
}
