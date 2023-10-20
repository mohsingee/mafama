<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class ActivePlan extends Model
{
    //
    protected $fillable = [
        'user_id','plan_id','validity','status','expiry_date',
    ];


  
 public static function update_user_plan($user_id,$plan_id){

  $q1=ActivePlan::where(['user_id'=>$user_id])->get();
						
  $expiry_date=Date('Y-m-d H:i:s', strtotime('+30 days'));
  $data=array('user_id'=>$user_id,'validity'=>30,'plan_id'=>$plan_id,'expiry_date'=>$expiry_date,'status'=>1);
  if($q1->count() > 0){
    ActivePlan::where(['user_id'=>$user_id])->update($data);
     $plan=Plan::where(['id'=>$plan_id])->first();
     $reason="Your renewal has been done with $plan->name .";
     ActivePlan::reminder_renewal_email($user_id,$reason);
   }else{ 
      ActivePlan::create($data);
  }   
   $data1=array('plan_id'=>$plan_id);
    User::where(['id'=>$user_id])->update($data1) ;
    return true;

 }



 public static function user_expiry_reminder(){
  $plans=ActivePlan::where(['status'=>1])->get();
      if($plans->count() >0 ){
        foreach ($plans as $plan) {
           $setting=Setting::general_setting();
           $grace_period= $setting->grace_period;
           $rem_days=Carbon::parse($plan->updated_at)->diffInDays(); 
           $now = date('Y-m-d H:i:s');
           $expiry_date    = $plan->expiry_date;
           
           if($rem_days <= $grace_period ){
            $reason="Your plan will expire on $expiry_date. Please renew you plan immediately";
             ActivePlan::reminder_email($plan->user_id,$reason);
           }
        }
        return true;
        
      }
 }

public static function is_active_plan(){

 $plan=ActivePlan::where('user_id',Auth::user()->id)->first();
 if(empty($plan)){
  return false;
 }
 elseif ($plan->status==1) {
    return true;
 }else{
  return false;
 }

}

 public static function user_plan_expired_reminder(){
     $setting=Setting::general_setting();
 $grace_period= $setting->grace_period;
  $plans=ActivePlan::where(['status'=>1])->get();
      if($plans->count() >0 ){

        foreach ($plans as $plan) {
           $rem_days=Carbon::parse($plan->updated_at)->diffInDays(); 

           $now = date('Y-m-d H:i:s');
          // $expiry_date    = $plan->expiry_date;
           $expiry_date= Carbon::parse($plan->expiry_date)->addDays($grace_period);
          if( $now >$expiry_date ){
            $data=array('status'=>0);
            ActivePlan::where(['user_id'=>$plan->user_id])->update($data);
             $reason="Your plan has been expired";
             ActivePlan::reminder_email($plan->user_id,$reason);
           }
        }
        return true;
        
      }
 }




public static function reminder_email($user_id,$reason){

      $admin_email=Setting::get_admin_email();  
      $user=User::get_user_info($user_id);      
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'reminder_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  'Plan Expired',
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'task'              =>  $reason 
      );
      \Mail::to($user->email)->send(new SendMail($data3));
}



public static function reminder_renewal_email($user_id,$reason){

      $admin_email=Setting::get_admin_email();  
      $user=User::get_user_info($user_id);      
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'reminder_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  'Plan Renewal Done ',
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'task'             =>  $reason 
      );
      \Mail::to($user->email)->send(new SendMail($data3));
}






}
