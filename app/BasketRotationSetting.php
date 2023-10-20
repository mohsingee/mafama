<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;

class BasketRotationSetting extends Model
{
    //

   protected $fillable = [
    'direct_affiliates','stay_active','active_users','send_emails','earned_points','paid_users','old_lead',
    ];






public static function basket_rotation_jobs(){
	$jobs1=BasketRotationSetting::rotate_basket_for_all_sponsors();
	
}




 
 public static function rotate_basket_for_all_sponsors(){

  $users=User::where(['role'=>'affiliate','status'=>1])
         ->orderBy('id','asc')->get();
  if($users->count() > 0)
  {
       // get all sponsors records
  
  	  foreach ($users as $user) {
  	  	if(!empty($user->sponsor_id)){
  	  		$level_team=User::where(['sponsor_id'=>$user->id,'role'=>'affiliate','status'=>1])->orderBy('id','asc')->get();
  	  		if($level_team->count() >0){

  	  			$check=BasketRotationSetting::check_user_criteria($user->id);
  	  			if($check >0)
  	  			{
  	  			$qualifiers=BasketRotationSetting::GetTopProducers($user->id);
                $leads=BasketRotationSetting::get_total_sponsor_leads($user->id);

                $team_size=count($qualifiers);
              
              //  print_r($qualifiers);
             // echo $leads.' '.$team_size;
             //  die;
  	  			if($leads > 0){ 
                 if($team_size < 1) 
                 {
                  $team_size=1;
                 } 
                 $team_limit=$leads/$team_size;
                 $team_limit=floor($team_limit);
                 if($team_size>0)
                 {
                     
                 foreach ($qualifiers as $uid) {   
                 	  
                  $divide=BasketRotationSetting::distribute_leads_to_qualifier($user->id,$uid,$team_limit);
                  if($divide){
                  	$reason='top qualifiers';
                  	BasketRotationSetting::send_email_notification($uid,$team_limit,$reason);
                  }

                 

                 	}
                 }
                
  	  			
  	  			}

  	  			}
  	  			
  	  			
  	  		}

  	  		
  	  	}
  	    
  	  }
  }    
  return true;

 }


public static function check_user_criteria($user_id){
       $success=0;

		$setting=BasketRotationSetting::find(1);
	  	$direct_users     =$setting->direct_affiliates;
	  	$stay_active1     =$setting->stay_active;
	  	$stay_active      =$setting->stay_active*30;
	  	$active_users     =$setting->active_users;
	  	$send_emails      =$setting->send_emails;
	  	$earned_points    =$setting->earned_points;
	  	$paid_users       =$setting->paid_users;
	  	$email_month      =$setting->email_month;
	  	$point_month      =$setting->point_month;
	  	$old_lead         =$setting->old_lead;
        $earned_points1   =0;
        $spend_days       =0;
        $user=User::get_user_info($user_id);
	  	$direct_users1=User::where(['sponsor_id'=>$user_id,'role'=>'affiliate','status'=>1])->get()->count();
	  	//$active_users1=$user->team_members;

	  	$active_users1=AffiliateRegistration::where(['sponsor_id'=>$user_id,'type'=>'free_affiliate'])->count();
	  	$plan=ActivePlan::where(['user_id'=>$user_id,'status'=>1])->first();
	  	if(!empty($plan)){
	  	    $registered_date1=$user->created_at;
	  	    $date2 = Carbon::parse($registered_date1)->subMonths($stay_active1);
	  	    $spend_days=Carbon::parse($date2)->diffInDays(); 
	  	   
	  	}
	  	
	  	$stay_active1=$spend_days; 
	  	//$send_emails1=$user->total_send_emails;
	  	$send_emails1=BasketRotationSetting::total_send_emails($user_id,$email_month);
	  	$paid_users1=User::where(['sponsor_id'=>$user_id,'status'=>1])->get()->count();
	  	$points =AccessMonitoring::where(['user_id'=>$user_id])->first();

	  	$earned_points1=BasketRotationSetting::get_user_points($user_id,$point_month);


        if($direct_users1 >=$direct_users && $active_users1 >= $active_users && $stay_active1 >=$stay_active && $send_emails1 >= $send_emails && $paid_users1 >= $paid_users && $earned_points1 >=$earned_points){
            $success=1;
        }
      //  echo $success;
 //  echo "$direct_users1 >=$direct_users && $active_users1 >= $active_users && $stay_active1 >=$stay_active &&33 $send_emails1 >= $send_emails && $paid_users1 >= $paid_users && $earned_points1 >=$earned_points ";die;
       return $success;

}


public static function total_send_emails($uid,$month){
    
$contacts = DB::table('contacts')->where('folder', 13)->where('uid', $uid)->get();
 $user=User::get_user_info($uid);
  $registered_date=$user->created_at;
 //$date_till = Carbon::parse($registered_date)->subMonths($month);
 $date_till = date('Y-m-d H:i:s', strtotime("+ $month month", strtotime($registered_date)));;
$cnt = 0;
foreach($contacts as $value)
{
	$email1 = EmailCampaign::where('email', $value->email)->where('created_at','>', $date_till)->where('uid', $uid)->count();
	$email2 = SendEmail::where('email', $value->email)->where('created_at','>', $date_till)->where('uid', $uid)->count();
	$email3 = SendCard::where('email', $value->email)->where('created_at','>', $date_till)->where('uid', $uid)->count();
	$email4 = SendSms::where('email', $value->email)->where('created_at','>', $date_till)->where('uid', $uid)->count();
	$email5 = SendVideo::where('email', $value->email)->where('created_at','>', $date_till)->where('uid', $uid)->count();
	$cnt += ($email1+$email2+$email3+$email4+$email5);
}

return $cnt;
}



public static function get_user_points($uid,$month){
  $user=User::get_user_info($uid);
 $registered_date=$user->created_at;
// $date_till = Carbon::parse($registered_date)->subMonths($month);
 $date_till =  date('Y-m-d H:i:s', strtotime("+ $month month", strtotime($registered_date)));;

 $data = DailyAccessMonitoring::where('user_id', $uid)->where('created_at','>', $date_till)->get();
 
$cnt = 0;
foreach($data as $value)
{

	$cnt += $value->earned_points;
}

return $cnt;
}


public static function get_total_sponsor_leads($uid){ 

	return Contacts::where(['uid'=>$uid,'status'=>1])->get()->count();

}



public static function distribute_leads_to_qualifier($sponsor_id,$uid,$limit){ 
    	$setting=BasketRotationSetting::find(1);
    $old_lead        =$setting->old_lead;
    $date = Carbon::today()->subDays($old_lead);


    $insert_data=array();
	$leads= Contacts::where(['uid'=>$sponsor_id,'status'=>1])->where('created_at', '>=', $date)
	->limit($limit)
	->orderBy('id','asc')->get();
	if($leads->count() >0){
		foreach ($leads as $lead) {		
          $insert_data[] = array(
		           'uid'        =>$uid,
		           'first_name' =>$lead->first_name,
		           'last_name'  =>$lead->last_name,
		           'telephone'  =>$lead->telephone,
		           'email'      =>$lead->email,
		           'folder'     =>13,
		           'from_lead'  =>"yes",
		           'status'     =>1,
		           );
        $data=array('status'=>0);  
       $update=Contacts::where('id',$lead->id)->update($data);
		}

//echo "<pre>";
//print_r($insert_data);

	 if(!empty($insert_data))
              {
                foreach ($insert_data as $data) {                   
                   $insert=Contacts::create($data);                   
                }
                return true;
             }	
	}
	

}


public static function send_email_notification($user_id,$leads,$reason){

      $admin_email=Setting::get_admin_email();  
      $user=User::get_user_info($user_id);      
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'lead_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  'Leads Received',
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'leads'            =>  $leads,
           'task'             =>  $reason 
      );
      \Mail::to($user->email)->send(new SendMail($data3));
}









 public static function GetTopProducers($user_id)
 {

  $uids=array();
  $q1=User::where('sponsor_id',$user_id)     
       ->orderBy('id', 'desc')        
       ->get();     
    if($q1->count() >0){
      foreach ($q1 as $user) {      
        $uid=$user->id; 
      $check=BasketRotationSetting::check_user_criteria($user->id);
      if($check >0) 
      {
      	 if(isset($uid))
            {
                $uids[]=$uid;
            } 
      }  

     
         
       
      }      
    }   


   return $uids ;
 }










}
