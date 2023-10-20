<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class LabTest extends Model
{
    //
    protected $fillable = [
        'uid','login_id','client_id','test_name','lab_id','comment','completed_by','status','uploaded_file',
    ];


  public static function get_lab_records($client_id='')
  {
    if($client_id!='')
    {
        $data=LabTest::where(['lab_tests.client_id'=>$client_id,'lab_tests.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'lab_tests.login_id')       
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
     }else{
        $data=LabTest::where(['lab_tests.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'lab_tests.login_id')       
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
     }
      
        return $data; 
  }

 
 

 public static function get_lab_list()
 {
   $data=AffiliateRegistration::where(['affiliate_registrations.business_category'=>7]) 
   ->join('affiliate_banner','affiliate_banner.affiliate_email','=','affiliate_registrations.email')
   ->select('affiliate_banner.business_name','affiliate_banner.id as lab_id')
   ->get();

   return $data;
 }

 public static function get_all_lab_tests()
 {
  $data=LabTest::join('users', 'users.id', '=', 'lab_tests.login_id')       
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
     
        return $data; 

 }

 
 






}
