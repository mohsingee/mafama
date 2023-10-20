<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'monthly_fee','management_fee','bonus_one','bonus_two','bonus_three','bonus_four','prize','other','balance','affiliate_share_price','status',
    ];


 


}
