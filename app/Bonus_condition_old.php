<?php

namespace App;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;


use \App\Mail\SendMail;

class Bonus_condition extends Model
{
    protected $fillable = [
        'level', 'point_earned', 'active_days', 'downline_affiliate','start_date','end_date', 'status',
        ];
        
        
   
// bonus level 1 distribution 

  
 public static function all_sponsor_amount($user_id1,$i){
    $success=false;   
    $success1=false;   
    $success2=false;   
    $success3=false;   
    $success4=false;   
    $userData=User::where(['id'=>$user_id1])->first();
    $user_id=$userData->sponsor_id;  
    $i++;
   if($i <= 4 )
   { 
     
    if(!empty($user_id)) 
    {
    $value=AccessMonitoring::where(['users.role'=>'affiliate','users.id'=>$user_id])       
    ->join('users', 'users.id', '=', 'access_monitorings.user_id')       
    ->select('access_monitorings.*','users.level','users.direct_members as team_members')
    ->first();
   // if($udata->count()>0){ 
    if(!empty($value)){ 
      if($i==1)  {
          $pool_limit_price=BonusPoolPrice::where('level',1)->first()->price;   
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_one_price; 
          $success1=true; 
      }elseif($i==2){
           $pool_limit_price=BonusPoolPrice::where('level',2)->first()->price;   
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_two_price;
          $success2=true; 
      }elseif($i==3){
           $pool_limit_price=BonusPoolPrice::where('level',3)->first()->price;   
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_three_price;
           $success3=true; 
      }elseif($i==4){
           $pool_limit_price=BonusPoolPrice::where('level',4)->first()->price;   
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_four_price;
           $success4=true; 
      }
      
     // foreach ($udata as  $value) {
        
        if(!empty($value->level))
        {
         $level        =$value->level;
         $team_members =$value->team_members;
          $user_points =$value->earned_points;
          $user_active_days=DailyAccessMonitoring::where('user_id',$value->user_id)->count();         
          $bonus= Bonus_condition::where('level', $level)->first();
          if(!empty($bonus)){
            $required_points=$bonus->point_earned;
            $required_active=$bonus->active_days;
            $required_team=$bonus->downline_affiliate;
            $start_date=$bonus->start_date;
            $end_date=$bonus->end_date;
            $cdate=date('Y-m-d');
        if($cdate >=$start_date  && $cdate<= $end_date){ 
            if(($team_members >= $required_team) && ($user_points >= $required_points)  && ($user_active_days >= $required_active) ){            
          // echo $pool_collect_price.' >='. $pool_limit_price;   
            if($pool_collect_price >= $pool_limit_price){

            // $user_id=$value->user_id;   
             $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='bonus';
              $term='day';
             if(!empty($top3qualifier)){
                $total_top3=count($top3qualifier);
                 $pool_collect_price1=$pool_limit_price;
                 $qaulifier=$total_top3+1;
                 $share_amount= $pool_collect_price1/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                 Bonus_condition::send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term); 
                foreach ($top3qualifier as $uid) {                  
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term);
                }
                $success=true;   
                
                Bonus_condition::all_sponsor_amount($value->user_id,$i);
              } 

             }
             
            }
            
            }//END DATE CONDITION CLOSED

          }
          
        }
        
       // echo $i;
    //  }
    if($success==true){
        $remaining_balance=$pool_collect_price-$pool_limit_price;
        if($success1==true){
          $update1=array('bonus_one_price'=>$remaining_balance); 
           PoolPrice::where('id',1)->update($update1); 
          }elseif($success2==true){
              $update1=array('bonus_two_price'=>$remaining_balance);
               PoolPrice::where('id',1)->update($update1); 
          }elseif($success3==true){
               $update1=array('bonus_three_price'=>$remaining_balance);
                PoolPrice::where('id',1)->update($update1); 
          }elseif($success4==true){
               $update1=array('bonus_four_price'=>$remaining_balance);
                PoolPrice::where('id',1)->update($update1); 
          }
         
    }  
          return true;

        
    
    }else{ // no user available
      return true;
    }  
      
   }else{ // sponsor empty
       return true; 
   }   
      
   }else{ // 4 level completed
      return true; 
   }   
      
  }
     
     
     
  public static function distribute_bonus_level_one_income_jobs_stop(){
      
    $success=false;   
    $udata=AccessMonitoring::where(['users.role'=>'affiliate'])       
    ->join('users', 'users.id', '=', 'access_monitorings.user_id')       
    ->select('access_monitorings.*','users.level','users.direct_members as team_members')
    ->get();
    if($udata->count()>0){
        
      foreach ($udata as  $value) {
        if(!empty($value->level))
        {
         // $check= LevelIncomeRecord::where(['user_id'=>$value->user_id])->whereDate('created_at', Carbon::today())->first();
         // echo "<pre/>";
         // print_r($check);
         // if(empty($check)){
            //   $jobs=Bonus_condition::all_sponsor_amount($value->user_id,$i=0); 
        //  }
         
       
        }
      }
        $jobs=Bonus_condition::all_sponsor_amount($value->user_id,$i=0); 
    }else{
      return true;
    }    
    
    if($jobs){
             echo "success"; 
          }else{
             echo "incomplete";  
          }
     
  } 
  
  
  public static function get_level_qualifiers($level){
      
    $userid=array();  
    $udata=AccessMonitoring::where(['users.role'=>'affiliate','users.level'=>$level])       
    ->Join('users', 'users.id', '=', 'access_monitorings.user_id')       
    ->select('access_monitorings.*','users.level','users.direct_members as team_members','users.id as uid')
    ->get();
    if($udata->count()>0){ 
      $pool_limit_price=BonusPoolPrice::where('level',$level)->first()->price;   
      if($level==1){
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_one_price;  
      }elseif($level==2){
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_two_price;  
      }elseif($level==3){
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_three_price;  
      }elseif($level==4){
          $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_four_price;  
      }
     
      foreach ($udata as  $value) {
        if(!empty($value->level))
        {
         $level        =$value->level;
         $team_members =$value->team_members;
         $user_points =$value->earned_points;
         // echo $value->uid.',';
          $user_active_days=DailyAccessMonitoring::where('user_id',$value->uid)->count();         
          $bonus= Bonus_condition::where('level', $level)->first();
          if(!empty($bonus)){
          
            $required_points=$bonus->point_earned;
            $required_active=$bonus->active_days;
            $required_team=$bonus->downline_affiliate;
            $start_date=$bonus->start_date;
            $end_date=$bonus->end_date;
            $cdate=date('Y-m-d');
           if($cdate >=$start_date  && $cdate<= $end_date){ 
            if(($team_members >= $required_team) && ($user_points >= $required_points)  && ($user_active_days >= $required_active) ){            
          // echo $pool_collect_price.' >='. $pool_limit_price;   
           // if($pool_collect_price >= $pool_limit_price){
             $userid[]=$value->uid; 
          //   }
             }
           }// END DATE CONDITION CLOSED

          }

        }
      }
    
    }    
    return $userid;
     
  } 
  
  
  
     
// bonus level 2 distribution

  public static function distribute_bonus_level_one_income_jobs(){
      $success=false;   
      $pool_limit_price=BonusPoolPrice::where('level',1)->first()->price;   
      $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_one_price;
      $udata=Bonus_condition::get_level_qualifiers(1);
      $total_qualifier=count($udata);
      if($total_qualifier>0){ 
        foreach ($udata as  $user_id) 
        {
       // echo $user_id.',';
        //Distribute
          if($pool_collect_price >= $pool_limit_price){
              
             $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='bonus';
              $term='day';
             if(!empty($top3qualifier)){
                $total_top3=3;
                $total_top_producer=count($top3qualifier);
                
                 $qaulifier=$total_qualifier;
                 $share_amount= $pool_limit_price/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                 $message="Bonus received as a top qualifier for level 1";
                 Bonus_condition::send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term,$message); 
                  if(!empty($user_id))
                 {
                     $bonus= Bonus_condition::where('level', 1)->first();
                     $required_points=$bonus->point_earned;
                     
                     $point=AccessMonitoring::where('user_id',$user_id)->first();
                     $total_earn_point= $point->earned_points;
                     
                     $remaining_points=$total_earn_point-$required_points;
                     $points_data=array(
          	        'earned_points'  =>$remaining_points,
                     );
		  
		           AccessMonitoring::where('user_id',$user_id)->update($points_data); 
                 }
                 
                 if($total_top_producer <3){
                     $rem=$total_top3-$total_top_producer;
                   $sponsor_name=User::get_user_info($user_id)->name;
                   $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>.";
                   $uid=1;
                   $producer_amount1=$rem*$producer_amount;
                   
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount1,$type,$term,$message1);
                 }
                 foreach ($top3qualifier as $uid) {  
                     $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term,$message1);
                 }
                 $success=true;
             } 

            }
      }
      
      if($success==true){
          $remaining_balance=$pool_collect_price-$pool_limit_price;
            $update1=array('bonus_one_price'=>$remaining_balance);
           PoolPrice::where('id',1)->update($update1); 
           return true;

         } 
    
    }else{
      return true;
    }    
     
  }
  
  
      
// bonus level 2 distribution

  public static function distribute_bonus_level_two_income_jobs(){
      $success=false;   
      $pool_limit_price=BonusPoolPrice::where('level',2)->first()->price;   
      $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_two_price;
      $udata=Bonus_condition::get_level_qualifiers(2);
      $total_qualifier=count($udata);
      if($total_qualifier>0){ 
        foreach ($udata as  $user_id) 
        {
       // echo $user_id.',';
        //Distribute
          if($pool_collect_price >= $pool_limit_price){
              
             $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='bonus';
              $term='day';
             if(!empty($top3qualifier)){
                $total_top3=3;
                $total_top_producer=count($top3qualifier);
                
                 $qaulifier=$total_qualifier;
                 $share_amount= $pool_limit_price/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                $message="Bonus received as a top qualifier for level 2";
                 Bonus_condition::send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term,$message);
                  if(!empty($user_id))
                 {
                     $bonus= Bonus_condition::where('level', 2)->first();
                     $required_points=$bonus->point_earned;
                     
                     $point=AccessMonitoring::where('user_id',$user_id)->first();
                     $total_earn_point= $point->earned_points;
                     
                     $remaining_points=$total_earn_point-$required_points;
                     $points_data=array(
          	        'earned_points'  =>$remaining_points,
                     );
		  
		           AccessMonitoring::where('user_id',$user_id)->update($points_data); 
                 }
                  if($total_top_producer <3){
                     $rem=$total_top3-$total_top_producer;
                   $sponsor_name=User::get_user_info($user_id)->name;
                   $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>.";
                   $uid=1;
                   $producer_amount1=$rem*$producer_amount;
                   
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount1,$type,$term,$message1);
                 }
                 foreach ($top3qualifier as $uid) {  
                     $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term,$message1);
                 }
                 $success=true;
             } 

            }
      }
      
      if($success==true){
          $remaining_balance=$pool_collect_price-$pool_limit_price;
            $update1=array('bonus_two_price'=>$remaining_balance);
           PoolPrice::where('id',1)->update($update1); 
           return true;

         } 
    
    }else{
      return true;
    }    
     
  }
  
  
      
// bonus level 3 distribution

  public static function distribute_bonus_level_three_income_jobs(){
      $success=false;   
      $pool_limit_price=BonusPoolPrice::where('level',3)->first()->price;   
      $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_three_price;
      $udata=Bonus_condition::get_level_qualifiers(3);
      $total_qualifier=count($udata);
      if($total_qualifier>0){ 
        foreach ($udata as  $user_id) 
        {
       // echo $user_id.',';
        //Distribute
          if($pool_collect_price >= $pool_limit_price){
              
             $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='bonus';
              $term='day';
             if(!empty($top3qualifier)){
                $total_top3=3;
                $total_top_producer=count($top3qualifier);
                
                 $qaulifier=$total_qualifier;
                 $share_amount= $pool_limit_price/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                 $message="Bonus received as a top qualifier for level 3";
                 Bonus_condition::send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term,$message); 
                  if(!empty($user_id))
                 {
                     $bonus= Bonus_condition::where('level', 3)->first();
                     $required_points=$bonus->point_earned;
                     
                     $point=AccessMonitoring::where('user_id',$user_id)->first();
                     $total_earn_point= $point->earned_points;
                     
                     $remaining_points=$total_earn_point-$required_points;
                     $points_data=array(
          	        'earned_points'  =>$remaining_points,
                     );
		  
		           AccessMonitoring::where('user_id',$user_id)->update($points_data); 
                 }
                 
                   if($total_top_producer <3){
                     $rem=$total_top3-$total_top_producer;
                   $sponsor_name=User::get_user_info($user_id)->name;
                   $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>.";
                   $uid=1;
                   $producer_amount1=$rem*$producer_amount;
                   
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount1,$type,$term,$message1);
                 }
                 foreach ($top3qualifier as $uid) {  
                     $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term,$message1);
                 }
                 $success=true;
             } 

            }
      }
      
      if($success==true){
          $remaining_balance=$pool_collect_price-$pool_limit_price;
            $update1=array('bonus_three_price'=>$remaining_balance);
           PoolPrice::where('id',1)->update($update1); 
           return true;

         } 
    
    }else{
      return true;
    }    
     
  }
  
  
      
// bonus level 4 distribution

  public static function distribute_bonus_level_four_income_jobs(){
      $success=false;   
      $pool_limit_price=BonusPoolPrice::where('level',4)->first()->price;   
      $pool_collect_price=PoolPrice::where('id',1)->first()->bonus_four_price;
      $udata=Bonus_condition::get_level_qualifiers(4);
      $total_qualifier=count($udata);
      if($total_qualifier>0){ 
        foreach ($udata as  $user_id) 
        {
       // echo $user_id.',';
        //Distribute
          if($pool_collect_price >= $pool_limit_price){
              
             $top3qualifier= Bonus_condition::GetTopThreeProducers($user_id); 
              $producer2='';
              $producer3='';
              $type='bonus';
              $term='day';
             if(!empty($top3qualifier)){
                $total_top3=3;
                $total_top_producer=count($top3qualifier);
                
                 $qaulifier=$total_qualifier;
                 $share_amount= $pool_limit_price/$qaulifier;
                 $affiliate_amount=$share_amount/2;
                 $producer_amount=$affiliate_amount/$total_top3;
                 $producer1=$top3qualifier[0];                
                 if(!empty($top3qualifier[1])){
                  $producer2=$top3qualifier[1];
                 }
                 if(!empty($top3qualifier[2])){
                  $producer3=$top3qualifier[2];
                 }
                 $message="Bonus received as a top qualifier for level 4";
                 Bonus_condition::send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$affiliate_amount,$type,$term,$message); 
                 
                 // deduct affiliate points
                 if(!empty($user_id))
                 {
                     $bonus= Bonus_condition::where('level', 4)->first();
                     $required_points=$bonus->point_earned;
                     
                     $point=AccessMonitoring::where('user_id',$user_id)->first();
                     $total_earn_point= $point->earned_points;
                     
                     $remaining_points=$total_earn_point-$required_points;
                     $points_data=array(
          	        'earned_points'  =>$remaining_points,
                     );
		  
		           AccessMonitoring::where('user_id',$user_id)->update($points_data); 
                 }
                 
                   if($total_top_producer <3){
                     $rem=$total_top3-$total_top_producer;
                   $sponsor_name=User::get_user_info($user_id)->name;
                   $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>.";
                   $uid=1;
                   $producer_amount1=$rem*$producer_amount;
                   
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount1,$type,$term,$message1);
                 }
                 foreach ($top3qualifier as $uid) {  
                     $sponsor_name=User::get_user_info($user_id)->name;
                    $message1="Bonus received for top 3 qualified producers under affiliate <b>$sponsor_name </b>."; 
                  Bonus_condition::send_bonus_qualifier_email($uid,$producer1,$producer2,$producer3,$producer_amount,$type,$term,$message1);
                 }
                 $success=true;
             } 

            }
      }
      
      if($success==true){
          $remaining_balance=$pool_collect_price-$pool_limit_price;
            $update1=array('bonus_four_price'=>$remaining_balance);
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




    
 public static function send_bonus_qualifier_email($user_id,$producer1,$producer2,$producer3,$amount,$type,$term,$message){

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
      if($type=='bonus' && $term=='day'){
         $email_subject=$template->bonus_subject_day; 
         $email_message=$template->bonus_message_day;
      }elseif($type=='bonus' && $term=='quarter'){
         $email_subject=$template->bonus_subject_quarter; 
         $email_message=$template->bonus_message_quarter;   
      }
     Balance_info::update_user_wallet_balance($user_id,$amount);
      $bonus_data=array(
                      'user_id'     =>$user_id,
                      'level'       =>$user->level,
                      'amount'      =>$amount,
                      'sponsor_id'  => $sponsor_id,
                      'description' => $message,
                      'status'      => 1 
                      );
         
     $q2= BonusReward::create($bonus_data);
      $table_name="bonus_rewards";
      $desc=$message;
    
     $tid=$q2->id;
       $data1 = array(
                'user_id'            => $user_id,              
                'tid'                => $tid,              
                'amount'             => $amount,
                'table_name'         => $table_name,
                'description'        => $desc, 
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

     
  public static function update_user_point_jobs()
  {
     $q12=DailyAccessMonitoring::whereDate('created_at', Carbon::today())->get();
     if($q12->count() > 0)
     { 
         
      foreach($q12  as $q1 )
      {
          // point_qualifications
          $user_id=$q1->user_id;
          $no_of_total_login=$q1->total_login;
          $no_of_total_spend_time=$q1->stroke_time;
          $point=EarnedPoint::where('id',1)->first();
          $qualify_logins=$point->no_of_login;
          $points_by_login=$point->login_points;
          $qualify_hours=$point->no_of_hours;
          $points_by_hours=$point->hour_points;
          $start_date=$point->start_date;
          $end_date=$point->end_date;
          $cdate=date('Y-m-d');
        if($cdate >=$start_date  && $cdate<= $end_date){ 
          // for login
    
          $logins=$no_of_total_login/$qualify_logins;
          $logins=floor($logins);
          if($logins >=1)
          {
            $login_points=$logins*$points_by_login;
            $data =array('login_points'=>$login_points);
           DailyAccessMonitoring::where(['user_id'=>$user_id])
           ->whereDate('created_at', Carbon::today())->update($data);
    
          $q2=DailyAccessMonitoring::where(['user_id'=>$user_id])->whereDate('created_at', Carbon::today())->get();
          $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
          $data1 =array('earned_points'=>$earned_point);
          DailyAccessMonitoring::where(['user_id'=>$user_id])
          ->whereDate('created_at', Carbon::today())->update($data1);
        }

         // for tolal login hours spend time
     
          $total_hours=$no_of_total_spend_time/$qualify_hours;
          $total_hours=floor($total_hours);
          if($total_hours >=1)
          {
              
            $hour_points=$total_hours*$points_by_hours;
            $data =array('hour_points'=>$hour_points);
            DailyAccessMonitoring::where(['user_id'=>$user_id])
           ->whereDate('created_at', Carbon::today())->update($data);
           $q2=DailyAccessMonitoring::where(['user_id'=>$user_id])->whereDate('created_at', Carbon::today())->get();
           $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
           $data1 =array('earned_points'=>$earned_point);
           DailyAccessMonitoring::where(['user_id'=>$user_id])
           ->whereDate('created_at', Carbon::today())->update($data1);  
           
          }
       }  

      }
    // loop end

    }
         return true;
  }      
         
      
        

}