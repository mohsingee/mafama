<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Mail\SendMail;
class Loginhour extends Model
{
    //

     protected $fillable = [
        'user_id','hours','logincount',
    ];



    
}
