<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;

class UploadLeads extends Model
{
    protected $fillable = [
        'first_name','last_name','address','email','phone_no','category','company_name','city','state','zipcode','country','assign_to_uid', 'path', 'description','status','count','latitute','longitude',
    ];


public static function total_leads($id){ 

  return UploadLeads::where('category',$id)->get()->count();
}

public static function distribute_leads_into_basket(){

	 $jobs1=UploadLeads::profile_pic_leads_distribution();
	 $jobs2=UploadLeads::banner_leads_distribution();
  $jobs3=UploadLeads::invitation_leads_distribution();
  $jobs4=UploadLeads::network_leads_distribution();
   $jobs5=UploadLeads::video_training_leads_distribution();
}


 
 public static function profile_pic_leads_distribution(){
  $leads=AffiliateRegistration::where('is_profile_pic_updated',1)
         ->orderBy('id','asc')->get();
  if($leads->count() > 0)
  {
   $check=UploadLeads::check_lead_criteria();
   $limit= $check->pro_pic_update_lead;
   foreach($leads as $lead){
   if(!empty($lead->email))
   {
    $aff_email=$lead->email;
  
   	$user=User::where('email',$aff_email)->first();
   	if(!empty($user))
   	{
   	 $user_id=$user->id;
      $q1=UploadLeads::assign_leads_to_affiliate($user_id,$aff_email,$limit);  
      if($q1){
     	$data1=array('is_profile_pic_updated'=>2);
      	$update1=AffiliateRegistration::where('email',$aff_email)->update($data1);
         $task=" updating profile photo";
        UploadLeads::send_email_notification($user_id,$limit,$task);
    	}
             
     
    }

   }
   	
   }   // close leads
  }    
  return true;

 }


 
 public static function banner_leads_distribution(){
 
 $leads=DB::table('affiliate_banner')->where('is_updated_banner', 1)->get();               
  if($leads->count() > 0)
  {
  foreach($leads as $lead)
  {
   $check=UploadLeads::check_lead_criteria();
   $limit= $check->banner_update_lead;


   if(!empty($lead->affiliate_email))
   {
    $aff_email=$lead->affiliate_email;
    $cdata=AffiliateRegistration::where('email',$aff_email)->first();
  
   	$user=User::where('email',$aff_email)->first();
   	if(!empty($user))
   	{
   	 $user_id=$user->id;
     $q1=UploadLeads::assign_leads_to_affiliate($user_id,$aff_email,$limit);  
      if($q1){
       $data1=array('is_updated_banner'=>2);
      	$update1=DB::table('affiliate_banner')->where('affiliate_email',$aff_email)->update($data1);
         $task=" updating banner";
        UploadLeads::send_email_notification($user_id,$limit,$task);
      }
            
     
    }


   }
   	
  

 } // close leads
  }    
  return true;

 }


 public static function invitation_leads_distribution(){
 
 $users=User::where(['role'=>'affiliate','is_invite_lead_earned'=>0])->orderBy('id','desc')->get();               
  if($users->count() > 0)
  {
  // distribute to all qualifier users
  foreach ($users as $udata) { 
   $total_invitations=User_invite::where('user_id',$udata->id)->count();
   $check=UploadLeads::check_lead_criteria();
    $require_emails= $check->sending_email;
    $limit= $check->invites_leads;    
   if($total_invitations >0)
   {

   if($total_invitations >= $require_emails )
   {
     if(!empty($udata->email))
     {
      $aff_email=$udata->email;
      $cdata=AffiliateRegistration::where('email',$aff_email)->first();
        $user=User::where('email',$aff_email)->first();
          if(!empty($user))
          {
           $user_id=$user->id;
           $q1= UploadLeads::assign_leads_to_affiliate($user_id,$aff_email,$limit);  
            if($q1){
             $data1=array('is_invite_lead_earned'=>2);      
             $update1=User::where('email',$aff_email)->update($data1);
            $task=" sending invitation emails";
            UploadLeads::send_email_notification($user_id,$limit,$task);
            }
                    
          } 
      
     }
   }
    
   }  
 } // close users data
  }    
  return true;

 }




 public static function network_leads_distribution(){
 
 $users=User::where(['role'=>'affiliate','is_network_lead_earned'=>0])->orderBy('id','desc')->get();               
  if($users->count() > 0)
  {
  // distribute to all qualifier users
  foreach ($users as $udata) { 

   $total_sponsor=User::where('sponsor_id',$udata->id)->count();
   $total_team_size=$udata->team_members;
   $total_paid_users1=$udata->team_members;
    $total_paid_users=AffiliateRegistration::where(['sponsor_id'=>$udata->id,'type'=>'free_affiliate'])->count();
    $check=UploadLeads::check_lead_criteria();
    $direct_sponsor= $check->direct_sponsor;
    $paid_users= $check->paid_users;
    $team_network= $check->team_network;
    $limit= $check->team_network_leads;  
    
   if($total_sponsor >0)
   {
  //  echo $total_team_size.',';
   if($total_team_size >= $team_network &&  $total_team_size >=$direct_sponsor && $total_paid_users >= $paid_users)
   {
     if(!empty($udata->email))
     {
      $aff_email=$udata->email;
      $cdata=AffiliateRegistration::where('email',$aff_email)->first();
   
      $user=User::where('email',$aff_email)->first();
          if(!empty($user))
          {

           $user_id=$user->id;
          $q1= UploadLeads::assign_leads_to_affiliate($user_id,$aff_email,$limit);  
            if($q1){
             $data1=array('is_network_lead_earned'=>2);      
             $update1=User::where('email',$aff_email)->update($data1);
              $task=" team network completion";
             UploadLeads::send_email_notification($user_id,$limit,$task);
            }
                 
          } 
     
     }
   }
    
   }  
 } // close users data
  }    
  return true;

 }


 public static function video_training_leads_distribution(){
 
 $users=User::where(['role'=>'affiliate'])->orderBy('id','desc')->get();               
  if($users->count() > 0)
  {
  // distribute to all qualifier users
  foreach ($users as $udata) { 

   $total_times_training=VideoTrainingRecord::where(['user_id'=>$udata->id,'status'=>0])->count();
  

  
   $total_training_btwn=Carbon::parse($udata->created_at)->diffInDays();
   $check=UploadLeads::check_lead_criteria();
   $no_of_times_training= $check->no_of_times_training;   
   $training_taken_days= $check->training_taken_days;   
   $limit= $check->training_leads;  
    $mark_watching=$training_taken_days;
   if($total_times_training >0)
   {
   
   if($total_times_training >= $no_of_times_training &&  $training_taken_days >=$total_training_btwn )
   {

     if(!empty($udata->email))
     {
      $aff_email=$udata->email;
      $cdata=AffiliateRegistration::where('email',$aff_email)->first();
      $user=User::where('email',$aff_email)->first();
      if(!empty($user))
      {

       $user_id=$user->id;
       $q1= UploadLeads::assign_leads_for_training_to_affiliate($user_id,$aff_email,$limit,$mark_watching);  
        if($q1){
        
        }
             
      } 
         
     }
    }
    
   }  
 } // close users data
  }    
  return true;

 }




public static function assign_leads_for_training_to_affiliate($user_id,$email,$limit,$mark_limit){

   $setting=UploadLeads::check_lead_criteria();
    $categories=$setting->default_category;

  //  print_r($categories);
     $user=User::get_user_info($user_id);
   $latitute=$user->latitute;
   $longitude=$user->longitude;
if(!empty($latitute) && !empty($longitude)){
   $sql_distance = " ,(((acos(sin((".$latitute."*pi()/180)) * sin((`p`.`latitute`*pi()/180))+cos((".$latitute."*pi()/180)) * cos((`p`.`latitute`*pi()/180)) * cos(((".$longitude."-`p`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
  //$having = " HAVING (distance <= $radius_km) ";
   $order_by = ' distance ASC ,count ASC ';
   $sql = "SELECT p.* ".$sql_distance." FROM upload_leads p WHERE p.category IN ($categories) AND p.assign_to_uid !=$user_id  ORDER BY RAND(), $order_by limit $limit";
   $leads=DB::select( DB::raw($sql) );
   $count=count($leads);
   }else{
    $categories=explode(',', $categories);
    $leads=UploadLeads::whereIn('category',$categories)
    ->where('assign_to_uid','!=',$user_id)
    ->orderBy('count','asc')
    ->inRandomOrder()
    ->limit($limit)
    ->get();
    $count=$leads->count();
   }

 // echo $category;
  if($count>0)
  {

      foreach ($leads as $lead) {       
        UploadLeads::move_lead_into_basket($user_id,$lead->id);
        $mark_leads=VideoTrainingRecord::where(['user_id'=>$user_id,'status'=>0])
        ->orderBy('id','asc')
        ->limit($mark_limit)
       ->get();
       
       if($mark_leads->count()>0)
       {   
            foreach ($mark_leads as $wid)
            {
             $vid=json_decode($wid)->id;
              $data1=array('status'=>1);
              VideoTrainingRecord::where('id',$vid)->update($data1);
            }
       }
      // return true;
        
      }
      // send half leads to sponsor
   $task="watching video training";
  UploadLeads::send_email_notification($user_id,$limit,$task);   
  
  $sponsor_limit=$limit/2;
  if($sponsor_limit >= 1 )
  {
   $user=User::get_user_info($user_id);
    if(!empty($user))
    {
        $sponsor_id=$user->sponsor_id;
       if(!empty($sponsor_id)){
        $email=$user->email;
        $leads=AffiliateRegistration::where('email',$email)->get(); 
         $setting=UploadLeads::check_lead_criteria();   
            $latitute=$user->latitute;
             $longitude=$user->longitude;
           if(!empty($latitute) && !empty($longitude)){
             $sql_distance = " ,(((acos(sin((".$latitute."*pi()/180)) * sin((`p`.`latitute`*pi()/180))+cos((".$latitute."*pi()/180)) * cos((`p`.`latitute`*pi()/180)) * cos(((".$longitude."-`p`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
            //$having = " HAVING (distance <= $radius_km) ";
             $order_by = ' distance ASC ,count ASC ';
             $sql = "SELECT p.* ".$sql_distance." FROM upload_leads p WHERE p.category IN ($categories) AND p.assign_to_uid !=$sponsor_id  ORDER BY RAND(), $order_by limit $sponsor_limit";
             $leads1=DB::select( DB::raw($sql) );
             $count1=count($leads1);
             }else{
              $leads1=UploadLeads::whereIn('category',$categories)
                       ->where('assign_to_uid','!=',$sponsor_id)
                       ->orderBy('count','asc')
                       ->inRandomOrder()
                       ->limit($sponsor_limit)
                       ->get();
              $count1=$leads1->count();
             }
           if($count1>0)
           {
               foreach ($leads1 as $lead1) {
              $id= $lead1->id;              
               UploadLeads::move_lead_into_basket($sponsor_id,$id);
            }
             $task="your affiliate qualify";
            UploadLeads::send_email_notification($sponsor_id,$sponsor_limit,$task);
            return true;
           }
        }
      }
   }
   
  }
  return true;

}






public static function assign_leads_to_affiliate($user_id,$email,$limit){
    
    $setting=UploadLeads::check_lead_criteria();
    $categories=$setting->default_category;
   $user=User::get_user_info($user_id);
   $latitute=$user->latitute;
   $longitude=$user->longitude;
if(!empty($latitute) && !empty($longitude)){
   $sql_distance = " ,(((acos(sin((".$latitute."*pi()/180)) * sin((`p`.`latitute`*pi()/180))+cos((".$latitute."*pi()/180)) * cos((`p`.`latitute`*pi()/180)) * cos(((".$longitude."-`p`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
  //$having = " HAVING (distance <= $radius_km) ";
   $order_by = ' distance ASC ,count ASC ';
   $sql = "SELECT p.* ".$sql_distance." FROM upload_leads p WHERE p.category IN ($categories) AND assign_to_uid !=$user_id  ORDER BY RAND(), $order_by limit $limit";
   $leads=DB::select( DB::raw($sql) );
   $count=count($leads);
   }else{
    $categories=explode(',', $categories);
    $leads=UploadLeads::whereIn('category',$categories)
    ->where('assign_to_uid','!=',$user_id)
    ->orderBy('count','asc')
    ->inRandomOrder()
    ->limit($limit)
    ->get();
    $count=$leads->count();
   }


  // echo count($leads);
  // echo "<pre>";
  // print_r($leads);die;

	if($count>0)
	{
      foreach ($leads as $lead) {
      	$id= $lead->id;      	
        UploadLeads::move_lead_into_basket($user_id,$id);
       
      }
      // send half leads to sponsor
	$sponsor_limit=$limit/2;
	if($sponsor_limit >= 1 )
	{
	$user=User::get_user_info($user_id);
    if(!empty($user))
    {
    $sponsor_id=$user->sponsor_id;
 	 if(!empty($sponsor_id)){
 	 $email=$user->email;
 	 $leads=AffiliateRegistration::where('email',$email)->get();
   $latitute=$user->latitute;
   $longitude=$user->longitude;
 if(!empty($latitute) && !empty($longitude)){
   $sql_distance = " ,(((acos(sin((".$latitute."*pi()/180)) * sin((`p`.`latitute`*pi()/180))+cos((".$latitute."*pi()/180)) * cos((`p`.`latitute`*pi()/180)) * cos(((".$longitude."-`p`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
  //$having = " HAVING (distance <= $radius_km) ";
   $order_by = ' distance ASC ,count ASC ';
   $sql = "SELECT p.* ".$sql_distance." FROM upload_leads p WHERE p.category IN ($categories) AND assign_to_uid !=$sponsor_id  ORDER BY RAND(), $order_by limit $sponsor_limit";
   $leads1=DB::select( DB::raw($sql) );
   $count1=count($leads1);
   }else{
    $leads1=UploadLeads::whereIn('category',$categories)
             ->where('assign_to_uid','!=',$sponsor_id)
             ->orderBy('count','asc')
             ->inRandomOrder()
             ->limit($sponsor_limit)
             ->get();
     $count1=$leads1->count();
   }

	     if($count1>0)
	     {
          foreach ($leads1 as $lead1) {
	      	$id= $lead1->id;	      
          UploadLeads::move_lead_into_basket($sponsor_id,$id);
	      }
        $task="your affiliate qualified";
        UploadLeads::send_email_notification($sponsor_id,$sponsor_limit,$task);
	     }
	  }
 	}
	}
		return true;
	}
	return true;

}

 public static function move_lead_into_basket($user_id,$lead_id){

  $lead=UploadLeads::find($lead_id);
  $lead->count=$lead->count+1;
  //3 for distributed
  $lead->status=3;
  $lead->save();
  if(!empty($lead)){

    $data=array(
           'uid'        =>$user_id,
           'first_name' =>$lead->first_name,
           'last_name'  =>$lead->last_name,
           'telephone'  =>$lead->phone_no,
           'email'      =>$lead->email,
           'folder'     =>13,
           'from_lead'  =>"yes",
           'status'     =>1,
           );
    Contacts::create($data);
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
           'leads'            =>  $leads ,
           'task'             =>  $reason 
      );
     // \Mail::to($user->email)->send(new SendMail($data3));
       $full_name=$user->name;
       $email=$user->email;
       $subject='Leads Received';
       $web_name="MAFAMA";
       $data1 =array('data'=>$data3);
         \Mail::send('emails.lead_notification', $data1, function($message) use ($email, $subject,$admin_email,$web_name) {
                 $message->to($email)->subject($subject);
                 $message->from($admin_email, $web_name);
            });
}





  public static function check_lead_criteria()
  {
  	 return LeadQualifierSetting::find(1);
  }

}
