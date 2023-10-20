<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'free_lead', 'free_lead_status', 'other_amount', 'other_amount_status'
    ];
}
