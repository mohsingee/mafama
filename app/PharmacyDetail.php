<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class PharmacyDetail extends Model
{
    //
    protected $fillable = [
        'uid','login_id','client_id','completed_by','complaint1','complaint2','complaint3','medication1','medication2','medication3','recomm1','recomm2','recomm3','result1','result2','result3','dosage_day1','dosage_day2','dosage_day3','dosage_times1','dosage_times1','dosage_times2','dosage_times3','dosage_hours1','dosage_hours2','dosage_hours3','generic1','generic2','generic3','fill_medication1','fill_medication2','fill_medication3','pharma_note1','pharma_note2','pharma_note3','special_note1','special_note2','special_note3','status'

    ];




 public static function get_pharmacy_today_records()
  {
   
        $data=PharmacyDetail::where(['pharmacy_details.login_id'=>Auth::id()])
        ->whereDate('pharmacy_details.created_at', Carbon::today())
        ->whereYear('pharmacy_details.created_at', date('Y'))
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')       
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
     
      
        return $data; 
  }
 public static function get_pharmacy_records($client_id="")
  {
    if($client_id !='')
    {
      $data=PharmacyDetail::where(['pharmacy_details.client_id'=>$client_id,'pharmacy_details.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')       
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();  
     }else{
        $data=PharmacyDetail::where(['pharmacy_details.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')       
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
     }
      
        return $data; 
  }
 

  public static function all_pharmacy_lab_records()
  {
      $data=PharmacyDetail::join('users', 'users.id', '=', 'pharmacy_details.login_id')       
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
        return $data; 
  }

}    