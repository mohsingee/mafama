<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class VitalSign extends Model
{
    //
    protected $fillable = [
        'uid','login_id','client_id','weight','weight_unit','height','blood_pressure','temperature','heart_rate','raspiratory','spo2','status',
    ];


  public static function get_vital_signs_records($client_id)
  {
      $data=VitalSign::where(['vital_signs.client_id'=>$client_id,'vital_signs.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'vital_signs.login_id')       
         ->select('vital_signs.*','users.email','users.name')
         ->orderBy('vital_signs.id','DESC')
         ->get();
        return $data; 
  }
 






}
