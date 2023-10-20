<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Bonus_income extends Model
{
    //

     protected $fillable = [
        'user_id','amount','sponsor_id','ref_id','description','status',
    ];




 public static function get_bonus_list(){


   $data=Bonus_income::where(['bonus_incomes.status'=>1])
        
         ->leftJoin('users', 'users.id', '=', 'bonus_incomes.user_id')       
         ->select('bonus_incomes.*','users.name as username')
         ->orderBy('bonus_incomes.id', 'desc')->get();
    return $data;     
 }


    
}
