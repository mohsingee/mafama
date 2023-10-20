<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinancialManagementBanner extends Model
{
    protected $fillable = [
        'image', 'startdate', 'enddate', 'status',
    ];
}
