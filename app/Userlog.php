<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Mail\SendMail;
class Userlog extends Model
{
    //

     protected $fillable = [
        'user_id','loged_in_at','loged_out_at',
    ];



    
}
