<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class LeadQualifierSetting extends Model
{
    protected $fillable = [
        'pro_pic_update_lead','banner_update_lead','direct_sponsor','paid_users','team_network','default_category','team_network_leads','sending_email','invites_leads','no_of_times_training','training_taken_days','training_leads',
    ];

}