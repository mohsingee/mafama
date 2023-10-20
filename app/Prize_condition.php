<?php

namespace App;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;

use \App\Mail\SendMail;

class Prize_condition extends Model
{
    protected $fillable = [
        'level', 'point_earned', 'active_days', 'downline_affiliate', 'active_users','start_date','end_date', 'status',
    ];




  public static function get_top_qualifiers(){
      
    $userid=array();  
   
     $udata=AccessMonitoring::where(['users.role'=>'affiliate'])       
    ->join('users', 'users.id', '=', 'access_monitorings.user_id')       
    ->select('access_monitorings.*','users.level','users.team_members','users.id as uid','users.direct_members')
    ->get();
    if($udata->count()>0){ 
      $pool_limit_prize=PoolPrizeLimit::where('id',1)->first()->pool_prize;   
      $pool_collect_prize=PoolPrice::where('id',1)->first()->bonus_prize; 
     
      foreach ($udata as  $value) {
        if(!empty($value->level))
        {
         $level        =$value->level;
         $team_members =$value->team_members;
          $user_points =$value->earned_points;
          //$active_users =$value->direct_members;
          $currentYear = date('Y');
          $cmonth=date('m');
          if($cmonth >=1 && $cmonth < 4)
          {
              $Qstart=Carbon::createMidnightDate($currentYear,1,1);
              $Qend=Carbon::createMidnightDate($currentYear,3,31);
          }
          elseif($cmonth >=4 && $cmonth < 7)
          {
              $Qstart=Carbon::createMidnightDate($currentYear,4,1);
              $Qend=Carbon::createMidnightDate($currentYear,6,30);
          }
          elseif($cmonth >=7 && $cmonth < 10)
          {
              $Qstart=Carbon::createMidnightDate($currentYear,7,1);
              $Qend=Carbon::createMidnightDate($currentYear,9,30);
          }
          elseif($cmonth >=10 && $cmonth < 13)
          {
              $Qstart=Carbon::createMidnightDate($currentYear,10,1);
              $Qend=Carbon::createMidnightDate($currentYear,12,31);
          }

          $active_users= User::where(['sponsor_id'=>$value->uid,'status'=>1])->whereBetween('created_at', [$Qstart, $Qend])->count();


          $user_active_days=DailyAccessMonitoring::where('user_id',$value->uid)->count();         
          $bonus= Prize_condition::where('level', $level)->first();
          if(!empty($bonus)){
          
            $required_points=$bonus->point_earned;
            $required_active=$bonus->active_days;
            $required_team=$bonus->downline_affiliate;
            $required_active_users=$bonus->active_users;
             $start_date=$bonus->start_date;
            $end_date=$bonus->end_date;
            $cdate=date('Y-m-d');
           if($cdate >=$start_date  && $cdate<= $end_date){ 
            
            if(($team_members >= $required_team) && ($user_points >= $required_points)  && ($user_active_days >= $required_active) && ($active_users >= $required_active_users)){ 
              
             $userid[]=$value->uid; 
             }
           } // END DATE CONDITION CLOSED

          }

        }
      }
    
    }    
    return $userid;
     
  } 
  
  




     // distibution bonus prizes 
     
     
  public static function distribute_bonus_prize_jobs(){
     $success=false; 
     $pool_limit_prize=PoolPrizeLimit::where('id',1)->first()->pool_prize;   
     $pool_collect_prize=PoolPrice::where('id',1)->first()->bonus_prize; 
     $udata=Prize_condition::get_top_qualifiers();
     $total_qualifier=count($udata);
    
     if($total_qualifier>0){
         $i=0;
      foreach ($udata as  $user_id) {
         $i++;
            if($pool_collect_prize >= $pool_limit_prize)
            {
              //  echo $user_id.'-'; 
              $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='prize';
              $term='day';
              if(!empty($top3qualifier))
              {
                 $total_top3=3; 
                 $total_top_producer=count($top3qualifier); 
                 $qaulifier=$total_qualifier;
                 $share_amount= $pool_limit_prize/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                  $message="Prize received as a top qualifier ";
                Prize_condition::send_bonus_prize_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term,$message); 
                 if(!empty($user_id))
                 {
                    if($user_id !=1){
                     $level=User::get_user_info($user_id)->level;   
                     $bonus= Prize_condition::where('level', $level)->first();
                     $required_points=$bonus->point_earned;
                     $point=AccessMonitoring::where('user_id',$user_id)->first();
                     $total_earn_point= $point->earned_points;
                     
                     $remaining_points=$total_earn_point-$required_points;
                     $points_data=array(
          	        'earned_points'  =>$remaining_points,
                     );
		  
		              AccessMonitoring::where('user_id',$user_id)->update($points_data); 
                    }
		           
                 }
                 
                    if($total_top_producer <3){
                     $rem=$total_top3-$total_top_producer;
                   $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Prize received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                   $uid=1;
                   $producer_amount1=$rem*$producer_amount;
                   
                  Prize_condition::send_bonus_prize_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount1,$type,$term,$message1);
                  //$success=true; 
                 }
                foreach ($top3qualifier as $uid) {  
                   $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Prize received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                Prize_condition::send_bonus_prize_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term,$message1);
                 if($i==$total_qualifier){
                  $success=true;   
                  }
                
                }
              } 
             
            }        
      }

       if($success==true){
          $remaining_balance=$pool_collect_prize-$pool_limit_prize;
            $update1=array('bonus_prize'=>$remaining_balance);
            PoolPrice::where('id',1)->update($update1); 
          return true;
         }   
    
    }else{
      return true;
    }    
     
  }      
   
   
   
 public static function GetTopThreeProducers($user_id)
 {
  $userid=array();
   $data=DB::table('users')->where('users.sponsor_id',$user_id) 
      ->where('users.direct_members', '!=', 0) 
      ->where('t2.total_login', '!=', 0) 
      ->where('t2.spend_time', '!=', 0) 
      ->leftJoin('access_monitorings as t2', 'users.id', '=', 't2.user_id')     
       ->select('users.id','users.direct_members','t2.total_login','t2.spend_time')       
       ->limit(3)
       ->orderBy('users.direct_members', 'desc')
       ->orderBy('t2.total_login', 'desc')
       ->orderBy('t2.spend_time', 'desc')
       ->get();
     
    if($data->count() >0){
      foreach ($data as $u) {
       $userid[]=$u->id;
      }
    }
      return $userid ;
 }

   
   

 public static function GetTopThreeProducers_old($user_id)
 {
  $userid=array();
   $data=DB::table('users')->where('users.sponsor_id',$user_id) 
      ->leftJoin('access_monitorings as t2', 'users.id', '=', 't2.user_id')     
       ->select('users.id','users.direct_members','t2.total_login','t2.spend_time')       
       ->limit(3)
       ->orderBy('users.direct_members', 'desc')
       ->orderBy('t2.total_login', 'desc')
       ->orderBy('t2.spend_time', 'desc')
       ->get();
     
    if($data->count() >0){
      foreach ($data as $u) {
       $userid[]=$u->id;
      }
    }
      return $userid ;
 }


// send_bonus_brize_qualifier_email
 
 public static function send_bonus_prize_qualifier_email($user_id,$producer1,$producer2,$producer3,$amount,$type,$term,$message){

       $user=User::get_user_info($user_id);
       $sponsor_id=$user->sponsor_id;
       $producer_name1='';
       $producer_name2='';
       $producer_name3='';
       $producer_email1='';
       $producer_email2='';
       $producer_email3='';
       $producer_telephone1='';
       $producer_telephone2='';
       $producer_telephone3='';
       $producer_address1='';
       $producer_address2='';
       $producer_address3='';
        
       if(!empty($producer1)) {
        $user1=User::get_user_info($producer1);
        $affiliate1=AffiliateRegistration::where('email',$user1->email)->first();
        $producer_name1=$user1->name;
        $producer_email1=$user1->email;
        $producer_telephone1=$affiliate1->cellphone;
        $producer_address1=$affiliate1->address;
       }

       if(!empty($producer2)) {
        $user2=User::get_user_info($producer2);
        $affiliate2=AffiliateRegistration::where('email',$user2->email)->first();
        $producer_name2=$user2->name;
        $producer_email2=$user2->email;
        $producer_telephone2=$affiliate2->cellphone;
        $producer_address2=$affiliate2->address;
       }
       
       if(!empty($producer3)) {
        $user3=User::get_user_info($producer3);
        $affiliate3=AffiliateRegistration::where('email',$user3->email)->first();
        $producer_name3=$user3->name;
        $producer_email3=$user3->email;
        $producer_telephone3=$affiliate3->cellphone;
        $producer_address3=$affiliate3->address;
       }


      $admin_email=Setting::get_admin_email();
      $template=AffiliateEmailTemplate::where('id',1)->first();
      if($type=='prize' && $term=='day'){
         $email_subject=$template->prize_subject_day; 
         $email_message=$template->prize_message_day;
      }elseif($type=='prize' && $term=='quarter'){
         $email_subject=$template->prize_subject_quarter; 
         $email_message=$template->prize_message_quarter;   
      }
      Balance_info::update_user_wallet_balance($user_id,$amount);
      $bonus_data=array(
                      'user_id'    =>$user_id,
                      'level'      =>$user->level,
                      'amount'     =>$amount,
                       'sponsor_id'  => $sponsor_id,
                      'description' => $message,
                      'status'     => 1 
                      );
         
     $q2= PrizeReward::create($bonus_data);
      $table_name="prize_rewards";
      
     $tid=$q2->id;
       $data1 = array(
                'user_id'            => $user_id,              
                'tid'                => $tid,              
                'amount'             => $amount,
                'table_name'         => $table_name,
                'description'        => $message, 
                'status'             => 1 
                 ); 
      $q0=Mlm_transaction::create($data1);
     
      $link='<a href="'.url('/').'" target="_blank">click</a>';
      $cmonth=date('m');
     if($cmonth <= 3  ){
       $period="January-March";
     }elseif ($cmonth >= 4 && $cmonth <=6) {
          $period="April-June";
     }elseif ($cmonth >= 7 && $cmonth <=9) {
          $period="July-September";
     }
     elseif ($cmonth >= 10 && $cmonth <=12) {
         $period="October-December";
     }
       $period=$period.' , '.date('Y');
      $email_message=str_replace('{affiliate_name}',$user->name,$email_message);
      
      $email_message=str_replace('{producer_name1}',$producer_name1,$email_message);
      $email_message=str_replace('{producer_name2}',$producer_name2,$email_message);
      $email_message=str_replace('{producer_name3}',$producer_name3,$email_message);
      $email_message=str_replace('{producer_email1}',$producer_email1,$email_message);
      $email_message=str_replace('{producer_email2}',$producer_email2,$email_message);
      $email_message=str_replace('{producer_email3}',$producer_email3,$email_message);
      $email_message=str_replace('{producer_address1}',$producer_address1,$email_message);
      $email_message=str_replace('{producer_address2}',$producer_address2,$email_message);
      $email_message=str_replace('{producer_address3}',$producer_address3,$email_message);
      $email_message=str_replace('{producer_telephone1}',$producer_telephone1,$email_message);
      $email_message=str_replace('{producer_telephone2}',$producer_telephone2,$email_message);
      $email_message=str_replace('{producer_telephone3}',$producer_telephone3,$email_message);
      
      $email_message=str_replace('{transaction_history_link}',$link,$email_message);
      $email_message=str_replace('{bonus_time_period}',$period,$email_message);
       
         $data2 = array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'email_template',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  $email_subject,
          'email_message'     =>  $email_message,
          
      );
           
         
      \Mail::to($user->email)->send(new SendMail($data2)); 
 }

 

}