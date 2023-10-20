<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientRecommendation extends Model
{
    protected $fillable = [
        'client_id', 'report', 'status',
    ];
}
