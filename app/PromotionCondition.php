<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class PromotionCondition extends Model
{
    //
    protected $fillable = [
        'received_lead','closest_contact','lead_category','placed_basket','assign_position','status',
    ];



public static function promote_affiliate_users()
{
    $users=User::where(['role'=>'affiliate'])->orderBy('id','desc')->get();
    if($users->count() > 0)
     {
          foreach ($users as $udata)
          {
           $total_paid_users=AffiliateRegistration::where(['sponsor_id'=>$udata->id,'type'=>'free_affiliate'])->count();
               if($total_paid_users >0)
               {
                   $check=PromotionCondition::promote_affiliates($udata->id,$total_paid_users);
               }
          }
     }
}



public static function promote_affiliates($user_id,$paid_users){

    $conditions=PromotionCondition::where('status',1)->get();
    if($conditions->count()>0){
        foreach($conditions as $cod){
           // echo $cod->assign_position.'-'.$user_id.'-'.'<br/>';
            $paid_needed=$cod->received_lead;
            $closest_needed=$cod->closest_contact;
            $from_lead_cats=$cod->lead_category;
            $to_basket=$cod->placed_basket;

            $closest_leads=PromotionCondition::get_closest_leads($user_id,$from_lead_cats);
            $basket_leads=PromotionCondition::get_basket_one_leads($user_id,$to_basket);
         // echo "$paid_users >= $paid_needed && $closest_leads >=$closest_needed &&  $basket_leads >=$closest_needed <br>";

            if($paid_users >= $paid_needed && $closest_leads >=$closest_needed &&  $basket_leads >=$closest_needed){
              $data['is_promoted']=1;
              $data['rank_id']=$cod->id;
             $update=User::where('id',$user_id)->update($data);
             $rank=$cod->assign_position;
             $reason="Congratulations! You are promoted as $rank ";
             PromotionCondition::send_email_notification($user_id,$reason,$rank);

            }
        }
    }
}


public static function get_closest_leads($user_id,$categories)
{
   $count=0;
   $user=User::get_user_info($user_id);
   $latitute=$user->latitute;
   $longitude=$user->longitude;
   if(!empty($latitute) && !empty($longitude)){
   $sql_distance = " ,(((acos(sin((".$latitute."*pi()/180)) * sin((`p`.`latitute`*pi()/180))+cos((".$latitute."*pi()/180)) * cos((`p`.`latitute`*pi()/180)) * cos(((".$longitude."-`p`.`longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance ";
//WHERE p.category IN ($categories) AND assign_to_uid !=$user_id
   $order_by = ' distance ASC ,count ASC ';
   $sql = "SELECT p.* ".$sql_distance." FROM upload_leads p WHERE p.category IN ($categories) AND p.assign_to_uid ='$user_id'  ORDER BY RAND(), $order_by ";
   $leads=DB::select( DB::raw($sql) );
   $count=count($leads);
  }
  return $count;
}

public static function get_basket_one_leads($user_id,$folder)
{
   $leads1=Contacts::where('uid',$user_id)
             ->where('folder',$folder)
             ->get();
   $count1=$leads1->count();
   return $count1;
}






public static function send_email_notification($user_id,$reason,$rank){



      $admin_email=Setting::get_admin_email();
      $user=User::get_user_info($user_id);
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'lead_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  "Congratulations! You are promoted as $rank ",
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'rank'             =>  $rank,
           'task'             =>  $reason
      );
     // \Mail::to($user->email)->send(new SendMail($data3));
       $full_name=$user->name;
       $email=$user->email;
       $subject="Congratulations! You are promoted as $rank ";
       $web_name="MAFAMA";
       $data1 =array('data'=>$data3);
         \Mail::send('emails.promotion_template', $data1, function($message) use ($email, $subject,$admin_email,$web_name) {
                 $message->to($email)->subject($subject);
                 $message->from($admin_email, $web_name);
            });
}

}