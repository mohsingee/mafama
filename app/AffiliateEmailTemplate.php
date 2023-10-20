<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AffiliateEmailTemplate extends Model
{
    protected $fillable = [
        'comm_subject','comm_message','bonus_subject_day','bonus_message_day','bonus_subject_quarter','bonus_message_quarter','prize_subject_day','prize_message_day','prize_subject_quarter','prize_message_quarter','status',
    ];


}
