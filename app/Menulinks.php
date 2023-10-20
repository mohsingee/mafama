<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menulinks extends Model
{
    protected $fillable = [
        'main_menu', 'menu', 'status','gold_access','affiliate_access','silver_access','enterprise_access',
    ];
}
