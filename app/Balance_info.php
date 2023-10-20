<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use \App\Mail\SendMail;
use DB;
class Balance_info extends Model
{
    //

     protected $fillable = [
        'user_id','amount','status',
    ];



    public static function get_wallet_balance($user_id){

     $da=Balance_info::where(['user_id'=>$user_id])->get();
     if($da->count() >0){
        return number_format($da[0]->amount,2);
     }else{
     	return '0.00';
     }

    }


 public static function update_user_wallet_balance($user_id,$amount){

  $q1=Balance_info::where(['user_id'=>$user_id])->get();
  if($q1->count() > 0){

        $old_amount=$q1[0]->amount;
    $tamount=$amount+$old_amount;
    // $data =array('amount'=>$tamount);
    // dd($tamount);
    // 3284.02
    $balance_info = Balance_info::where(['user_id'=>$user_id])->update(['amount' => $tamount]);
    // dd($balance_info);

  }else{

      $data=array('user_id'=>$user_id,'amount'=>$amount,'status'=>1);
      Balance_info::create($data);
  }

   $current_amount=Balance_info::get_wallet_balance($user_id);
   $setting=Setting::general_setting();

   $commission_value=$setting->commission_amount;
   $deduct_amount_value=$setting->deduction_amount;

//   if($current_amount >= $commission_value)
//   {
//      $new_amount=$current_amount-$deduct_amount_value;
//      $data1 =array('amount'=>$new_amount);
//      Balance_info::where(['user_id'=>$user_id])->update($data1);

//      $table_name="balance_infos";
//      $desc="Commission value reached over <b>$commission_value</b> commission fees <b>$deduct_amount_value</b> deducted  ";
//      $tid=Balance_info::where('user_id',$user_id)->first()->id;
//       $data1 = array(
//                 'user_id'            => $user_id,
//                 'tid'                => $tid,
//                 'amount'             => $deduct_amount_value,
//                 'table_name'         => $table_name,
//                 'description'        => $desc,
//                 'status'             => 1
//                  );
//       $q0=Mlm_transaction::create($data1);
//   }

    return true;

 }

 public static function get_affiliate_profile_pic($email){
         $user=AffiliateRegistration::where('email',$email)->first();
         if(!empty($user->image)){
                $img=asset('public/images/affiliates/'.$user->image);
             }
             else
             {
               $img= asset('public/images/affiliates/1603958653625_1612262104.jpg');
             }

         return '<img src="'.$img.'" style="width:100px;height:100px"  >';
     }

 public static function get_last_sponser_id($user_id, $upline_user_id){

     $userData=User::where(['id'=>$user_id])->first();
      if(!empty($userData))
      {
            $user_id1=$userData->sponsor_id;
            if($user_id1==1 || $user_id==1){
               
            }else{
             $upline_user_id[] = $user_id; 
             $upline_user_id = Balance_info::get_last_sponser_id($user_id1, $upline_user_id);
          }
     }
     
     return $upline_user_id;
   
 }
  public static function update_affiliate_bonus_income($user_id,$plan_id){

    $user=User::get_user_info($user_id);
    $sponsor_id=$user->sponsor_id;
    $plan=Plan::where('id',$plan_id)->first();
   // $amount=$plan->affiliate_share_price;
      $total_days_of_plan_subscribe =  Balance_info::get_total_plan_day($sponsor_id);
       if($total_days_of_plan_subscribe  <= 35 ){
     
    $amount=$plan->balance/2;
       }else{
           $amount=$plan->balance/2;
       }
    
    $user1=User::get_user_info($sponsor_id);
     $sponsor_direct_members=User::where('sponsor_id',$sponsor_id)->count();
    $wallet_data=array(
                    'user_id' =>$user_id,
                    'amount'  =>0,
                    'status'  =>1,
                   );
    $add_wallet_amount=Balance_info::create($wallet_data);
    $total_direct=$sponsor_direct_members;
    //update team members
    User::where('id',$sponsor_id)->update(array('direct_members'=>$total_direct));
    $update_sponsor_wallet=Balance_info::update_user_wallet_balance($sponsor_id,$amount);
    if($update_sponsor_wallet){
          $total_days_of_plan_subscribe =  Balance_info::get_total_plan_day($sponsor_id);
       if($total_days_of_plan_subscribe  <= 35 ){
     $table_name="level_earnings";
     $desc="Direct Earning";
     $tid=Balance_info::where('user_id',$sponsor_id)->first()->id;
       
                  $data12 = array(
                'user_id'            => $sponsor_id,
                'amount'             => $amount,
                'ref_id'              => $user_id,
                'description'        => $desc,
                'status'             => 1
                 );
        $q01=LevelEarning::create($data12);
        
        $LevelEarning_id=$q01->id;
        
         $data1 = array(
                'user_id'            => $sponsor_id,
                'tid'                => $tid,
                'lid'                => $LevelEarning_id,
                'amount'             => $amount,
                'table_name'         => $table_name,
                'description'        => $desc,
                'status'             => 1
                 );
       
      $q0=Mlm_transaction::create($data1);
}

      $admin_email=Setting::get_admin_email();
      $template=AffiliateEmailTemplate::where('id',1)->first();
      $email_subject=$template->comm_subject;
      $affiliate=AffiliateRegistration::where('email',$user->email)->first();
      $level='Level '.$user->level;
      $country=$affiliate->country;
      $state=$affiliate->state.' '.$affiliate->city.' '.$affiliate->zip_code;
      $link='<a href="'.url('/').'" target="_blank">click</a>';
      $profile_image=Balance_info::get_affiliate_profile_pic($user->email);
      $email_message=str_replace('{sponsor_name}',$user1->name,$template->comm_message);
      $email_message=str_replace('{affiliate_profile_photo}',$profile_image,$email_message);
      $email_message=str_replace('{affiliate_name}',$user->name,$email_message);
      $email_message=str_replace('{level}',$level,$email_message);
      $email_message=str_replace('{country}',$country,$email_message);
      $email_message=str_replace('{state}',$state,$email_message);
      $email_message=str_replace('{transaction_history_link}',$link,$email_message);

         $data2 = array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'email_template',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  $email_subject,
          'email_message'     =>  $email_message,

      );
      \Mail::to($user1->email)->send(new SendMail($data2));
      if($user->level >4)
      {
      $bonus_one=0;
      $bonus_two=0;
      $bonus_three=0;
      $bonus_four=0;
      }else{
      $bonus_one=$plan->bonus_one;
      $bonus_two=$plan->bonus_two;
      $bonus_three=$plan->bonus_three;
      $bonus_four=$plan->bonus_four;
      }
      $prize=$plan->prize;
      $other=$plan->other;
     $old_pool=PoolPrice::where('id',1)->first();
     $pool_data=array(

               'bonus_one_price'   =>$bonus_one+$old_pool->bonus_one_price,
               'bonus_two_price'   =>$bonus_two+$old_pool->bonus_two_price,
               'bonus_three_price' =>$bonus_three+$old_pool->bonus_three_price,
               'bonus_four_price'  =>$bonus_four+$old_pool->bonus_four_price,
               'bonus_prize'       =>$prize+$old_pool->bonus_prize,
               'other'             =>$other+$old_pool->other,

                );

     $update_pool_table=PoolPrice::where('id',1)->update($pool_data);
     $total_uplines=Balance_info::all_upline_users_hwe($sponsor_id,$sponsor_id);
     $damount=$amount/$total_uplines;
    //  echo '$total_uplines'.$total_uplines.'damount'.$damount;
//     $main_sid ='';
//     $upline_user_id=[];
//   $upline_user_id = Balance_info::get_last_sponser_id($user_id,$upline_user_id);
//     $first_sponser_id = $upline_user_id[count($upline_user_id)-1]?:0;
     return Balance_info::sponsor_bonus_for_level($user_id,$user_id,$damount);

    }

  }
  
  public static function update_affiliate_bonus_income_on_plan_renew($user_id,$plan_id){

    $user=User::get_user_info($user_id);
    $sponsor_id=$user->sponsor_id;
    $plan=Plan::where('id',$plan_id)->first();
      $amount=$plan->balance/2;
     
   // $amount=$plan->affiliate_share_price;
      $total_days_of_plan_subscribe =  Balance_info::get_total_plan_day($sponsor_id);
    //   if($total_days_of_plan_subscribe  <= 35 ){
     
   
    //   }else{
    //       $amount=0;
    //   }
    $user1=User::get_user_info($sponsor_id);
     $sponsor_direct_members=User::where('sponsor_id',$sponsor_id)->count();
    // $wallet_data=array(
    //                 'user_id' =>$user_id,
    //                 'amount'  =>0,
    //                 'status'  =>1,
    //               );
    // $add_wallet_amount=Balance_info::create($wallet_data);
    $total_direct=$sponsor_direct_members;
    //update team members
    User::where('id',$sponsor_id)->update(array('direct_members'=>$total_direct));
    $update_sponsor_wallet=Balance_info::update_user_wallet_balance($sponsor_id,$amount);
    if($update_sponsor_wallet){
          $total_days_of_plan_subscribe =  Balance_info::get_total_plan_day($sponsor_id);
       if($total_days_of_plan_subscribe  <= 35 ){
     $table_name="level_earnings";
     $desc="Direct Earning";
     $tid=Balance_info::where('user_id',$sponsor_id)->first()->id;
       
                  $data12 = array(
                'user_id'            => $sponsor_id,
                'amount'             => $amount,
                'ref_id'              => $user_id,
                'description'        => $desc,
                'status'             => 1
                 );
        $q01=LevelEarning::create($data12);
        
        $LevelEarning_id=$q01->id;
        
         $data1 = array(
                'user_id'            => $sponsor_id,
                'tid'                => $tid,
                'lid'                => $LevelEarning_id,
                'amount'             => $amount,
                'table_name'         => $table_name,
                'description'        => $desc,
                'status'             => 1
                 );
       
      $q0=Mlm_transaction::create($data1);
}

    //   $admin_email=Setting::get_admin_email();
    //   $template=AffiliateEmailTemplate::where('id',1)->first();
    //   $email_subject=$template->comm_subject;
    //   $affiliate=AffiliateRegistration::where('email',$user->email)->first();
    //   $level='Level '.$user->level;
    //   $country=$affiliate->country;
    //   $state=$affiliate->state.' '.$affiliate->city.' '.$affiliate->zip_code;
    //   $link='<a href="'.url('/').'" target="_blank">click</a>';
    //   $profile_image=Balance_info::get_affiliate_profile_pic($user->email);
    //   $email_message=str_replace('{sponsor_name}',$user1->name,$template->comm_message);
    //   $email_message=str_replace('{affiliate_profile_photo}',$profile_image,$email_message);
    //   $email_message=str_replace('{affiliate_name}',$user->name,$email_message);
    //   $email_message=str_replace('{level}',$level,$email_message);
    //   $email_message=str_replace('{country}',$country,$email_message);
    //   $email_message=str_replace('{state}',$state,$email_message);
    //   $email_message=str_replace('{transaction_history_link}',$link,$email_message);

    //      $data2 = array(
    //       'admin_email'       =>   $admin_email,
    //       'template'          =>  'email_template',
    //       'webtitle'          =>  'MAFAMA',
    //       'subject'           =>  $email_subject,
    //       'email_message'     =>  $email_message,

    //   );
    //   \Mail::to($user1->email)->send(new SendMail($data2));
    //   if($user->level >4)
    //   {
    //   $bonus_one=0;
    //   $bonus_two=0;
    //   $bonus_three=0;
    //   $bonus_four=0;
    //   }else{
    //   $bonus_one=$plan->bonus_one;
    //   $bonus_two=$plan->bonus_two;
    //   $bonus_three=$plan->bonus_three;
    //   $bonus_four=$plan->bonus_four;
    //   }
    //   $prize=$plan->prize;
    //   $other=$plan->other;
    //  $old_pool=PoolPrice::where('id',1)->first();
    //  $pool_data=array(

    //           'bonus_one_price'   =>$bonus_one+$old_pool->bonus_one_price,
    //           'bonus_two_price'   =>$bonus_two+$old_pool->bonus_two_price,
    //           'bonus_three_price' =>$bonus_three+$old_pool->bonus_three_price,
    //           'bonus_four_price'  =>$bonus_four+$old_pool->bonus_four_price,
    //           'bonus_prize'       =>$prize+$old_pool->bonus_prize,
    //           'other'             =>$other+$old_pool->other,

    //             );

    //  $update_pool_table=PoolPrice::where('id',1)->update($pool_data);
     $total_uplines=Balance_info::all_upline_users_hwe($sponsor_id,$sponsor_id);
    
         $damount=$amount/$total_uplines;
    //  echo '$total_uplines'.$total_uplines.'damount'.$damount;
//     $main_sid ='';
//     $upline_user_id=[];
//   $upline_user_id = Balance_info::get_last_sponser_id($user_id,$upline_user_id);
//     $first_sponser_id = $upline_user_id[count($upline_user_id)-1]?:0;
     return Balance_info::sponsor_bonus_for_level($user_id,$user_id,$damount);

    }

  }

public static  function add_user_subscription($user_id,$plan_id)
{
   $plan=Plan::where('id',$plan_id)->first();
    $amount=$plan->monthly_fee;
     $table_name="plan_activations";
     $desc="Plan subscribed";
      $user=User::get_user_info($user_id);
    // add user subscription plan
      $data= array(
                'user_id'            => $user_id,
                'amount'             => $amount,
                'plan_id'            => $plan_id
                 );
     $q0=Plan_activation::create($data);

    // create transaction statement
      $data1 = array(
                'user_id'            => $user_id,
                'tid'                => $q0->id,
                'amount'             => $amount,
                'table_name'         => $table_name,
                'description'        => $desc,
                'status'             => 1
                 );
     $q0=Mlm_transaction::create($data1);
       $admin_email=Setting::get_admin_email();
         $data2 = array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'user_subscription_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  'Your subscription has been completed',
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'plan'             =>  $plan->name,
           'amount'           =>  number_format($amount,2).' USD'
      );
      \Mail::to($user->email)->send(new SendMail($data2));

   return true;

}

public static function all_upline_users_hwe($user_id,$current_u_id){
    
    global $all_user;
    // echo $user_id;
    // $team_members =User::get_user_info($user_id)->team_members;
    // $sponsor_id_hwe=User::get_user_info($user_id)->sponsor_id;
    $total_upline_hwe = array();
   Balance_info::get_total_upline($user_id,$user_id,$total_upline_hwe,$current_u_id);
//  die('ravio');
//  ;
    $total_upline = count($total_upline_hwe)-1;
 
    if($total_upline < 6){
        //  echo $total_upline.'user_id'.$user_id.'c<br>';
        $all_user[]=$user_id.'_'.$total_upline;
    }
     $user=Network::where(['user_id'=>$user_id])->first();
   
  if(!empty($user)){
      $user_id1=$user->sponsor_id;
      Balance_info::all_upline_users_hwe($user_id1,$current_u_id);
  }
  // ravi change 1 to 2  $total=count($all_user)-1;

if(in_array(1,$all_user)){
    $total=count($all_user)-2;
}else{
     $total=count($all_user)-1;
}
  
  if($total<=0){
      $total=1;
  }
  return $total;
}

public static function all_upline_users($user_id){
    global $all_user;
        $all_user[]=$user_id;
     $user=Network::where(['user_id'=>$user_id])->first();
    
  if(!empty($user)){
      $user_id1=$user->sponsor_id;
      Balance_info::all_upline_users($user_id1);
  }
  // ravi change 1 to 2  $total=count($all_user)-1;
  
 $total=count($all_user)-1;
  
  if($total<=0){
      $total=1;
  }
  return $total;
}

public static function sponsor_bonus_for_level($user_id,$ref_id,$amount){
   $userData=User::where(['id'=>$user_id])->first();
  if(!empty($userData)){

    $user_id1=$userData->sponsor_id;
    if($user_id1==1 || $user_id==1){
          $sponsor_id= '';
     Balance_info::distribute_level_bonus_income($user_id1,$sponsor_id,$ref_id,$amount);

        return true;
    }else{
        // bonus level income distributed
    $sponsor_id=User::get_user_info($user_id1)->sponsor_id;
    $team_members =User::get_user_info($user_id1)->team_members;
    $sponsor_id_hwe=User::get_user_info($ref_id)->sponsor_id;
    $total_upline_hwe = array();
    Balance_info::get_total_upline($user_id1,$user_id1,$total_upline_hwe,$ref_id);
    $total_upline = count($total_upline_hwe)-1;
    if($sponsor_id_hwe != $user_id1 && $total_upline < 6){
        $total_days_of_plan_subscribe =  Balance_info::get_total_plan_day($user_id1);
       if($total_days_of_plan_subscribe  <= 35 ){
     Balance_info::distribute_level_bonus_income($user_id1,$sponsor_id,$ref_id,$amount);
       }
    // Balance_info::distribute_level_bonus_income($user_id1,$sponsor_id,$ref_id,$amount);
    }
     Balance_info::sponsor_bonus_for_level($user_id1,$ref_id,$amount);
  }

}else{
  return true;
}

}

public static function get_total_upline($user_id,$user_id_fix,&$is_array,$current_user_id){
//   global $all_user;
//  echo $user_id.'-'.$user_id_fix.'-'.$current_user_id;
    //$team_members =User::get_user_info($user_id)->team_members;
    //$sponsor_id_hwe=User::get_user_info($user_id)->sponsor_id;
    
    //  echo $current_user_id.'<br>';
     $user=Network::where(['user_id'=>$current_user_id])->first();
     
  if(!empty($user)){
       $user_id1=$user->sponsor_id;
       $user_current = $user->user_id;
     if((!in_array($user_current,$is_array)) &&  ($user_id1 >= $user_id_fix)){
          $is_array[]=$user_current; 
          Balance_info::get_total_upline($user_current,$user_id_fix,$is_array,$user_id1);
      } else{
        if(!in_array($current_user_id,$is_array)){
            $is_array[]=$current_user_id; 
        }
  return $is_array;
    }
  }else{
      if(!in_array($user_id_fix,$is_array)){
            $is_array[]=$user_id; 
        }
return $is_array; 
  }
  
}
public static function get_total_plan_day($user_id){
 $get_payments_date = DB::table('payments')->where('user_id',$user_id)->orderBy('id','desc')->first();  
  $get_plan_activations_date = DB::table('plan_activations')->where('user_id',$user_id)->orderBy('id','desc')->first();  
 if(!empty($get_plan_activations_date)){
     $plan_date = strtotime($get_plan_activations_date->created_at);
     $now = time();
    $datediff = $now - $plan_date;
    
    $total_days_diff =  round($datediff / (60 * 60 * 24));
     
 }else{
     $total_days_diff = 1000;
 }
 if($total_days_diff > 35){
     if(!empty($get_payments_date)){
    $plan_date = strtotime($get_payments_date->created_at);
    $now = time();
    $datediff = $now - $plan_date;
    
    $total_days_diff =  round($datediff / (60 * 60 * 24));
     }
 }

 return $total_days_diff; 
  
}
  public static function distribute_level_bonus_income($user_id,$sponsor_id,$ref_id,$amount){
     $table_name="bonus_incomes";
     $desc="Downline Earning";
     $user_id=isset($user_id)?$user_id:1;
      $user=User::get_user_info($user_id);
      $sponsor_id_count =User::where('sponsor_id',$user_id)->count();
     
    // if($user->level>4)
    // {
    //   $user_id=1;
    // }
// if($sponsor_id_count > 1){
       $data2 = array(
                'user_id'            => $user_id,
                'sponsor_id'         => $sponsor_id,
                'ref_id'             => $ref_id,
                'amount'             => $amount,
                'description'        => $desc,
                'status'             => 1
                 );
     $q2=Bonus_income::create($data2);
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
     $update_sponsor_wallet=Balance_info::update_user_wallet_balance($user_id,$amount);


      $admin_email=Setting::get_admin_email();
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'user_bonus_level_income_alert',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  'You have received level commission income for your network',
          'full_name'         =>  $user->name,
           'email'            =>  $user->email,
           'amount'           =>  number_format($amount,2).' USD'
      );
      \Mail::to($user->email)->send(new SendMail($data3));
     return true;
  }
//   }






   public static function get_sponsor_name($user_id=''){

     $da=User::where(['id'=>$user_id])->get();
     if($da->count() >0){
        return $da[0]->first_name.' '.$da[0]->last_name;
     }else{
     	return 'itself';
     }

    }


   public static function deduct_user_wallet_balance($user_id,$amount){

       $data=Balance_info::where('user_id',$user_id)->first();
       $avl_bal=$data->amount;
       $remaining_balance=$avl_bal-$amount;
       $da=array('amount'=>$remaining_balance);
       $deduct=Balance_info::where('user_id',$user_id)->update($da);
       return true;
   }



    public static function get_user_plan_name($tid=''){

       $plan_name="" ;
       $da=$plan=level::where(['id'=>$tid])->get();
         if($da->count() >0){
           $plan_name=$plan[0]->name;
         }
         else
         {
           $plan_name ='';
         }
       return $plan_name;


    }


    public static function get_user_tier_name_profile($tid=''){

       $tier_name="" ;
       $da=$tier=Tier_level::where(['id'=>$tid])->get();
         if($da->count() >0){
           $tier_name=$tier[0]->tier;
         }
         else
         {
           $tier_name ='Investor';
         }
       return $tier_name;


    }

    public static function update_user_tier_plan($user_id){

      $tier_id='';
      $user=User::get_user_info($user_id);
     // echo "<pre>";
     // print_r($user);die;
      $team_size=$user->team_members;
      $personal_deposit=$user->personal_deposit;
      $team_deposit=$user->team_deposit;
      $tier_id=$user->tier_id;

      if(empty($tier_id) && $personal_deposit >=20 )
      {
        $tier_id=1 ;
      }
      elseif($team_size >= 2 && $team_size <= 9 && $personal_deposit >=500 && $team_deposit >=2500) {
          $tier_id=2;
          $bonus_tier='tier_two_bonus';
       }
      elseif($team_size >= 10 && $team_size <= 99 && $personal_deposit >=1000 && $team_deposit >=10000) {
          $tier_id=3;
          $bonus_tier='tier_three_bonus';
       }
       elseif($team_size >= 100 && $team_size <= 499 && $personal_deposit >=5000 && $team_deposit >=50000) {
          $tier_id=4;
          $bonus_tier='tier_four_bonus';
       }
       elseif($team_size >= 500 && $personal_deposit >=10000 && $team_deposit >=100000) {
          $tier_id=5;
          $bonus_tier='tier_five_bonus';
       }
    if(!empty($tier_id))
    {
      $data=array('tier_id'=>$tier_id);
      $update_tier=User::where('id',$user_id)->update($data);
     // echo $tier_id;die;
      if($tier_id !=1)
      {
        $check_bonus=User::where(['id'=>$user_id,$bonus_tier=>'No'])->count() ;
        if($check_bonus > 0)
        {
          $q11=Tier_level::find($tier_id);
          $bonus_amount=$q11->one_time_bonus;
          $old_tier_id=$user->tier_id;
          $sponsor_id=$user->sponsor_id;
          $email=$user->email;
          $full_name=$user->first_name.' '.$user->last_name;

          $new_tier_id=$tier_id;
          $new_tier_name=Balance_info::get_user_tier_name($new_tier_id);
           $data1 = array(
                'user_id'            => $user_id,
                'sponsor_id'         => $sponsor_id,
                'bonus_amount'       => $bonus_amount,
                'old_tier_id'        => $old_tier_id,
                'new_tier_id'        => $new_tier_id,
                'status'             => 0
                 );

            $q0=Bonus_list::create($data1);
            $da=array($bonus_tier=>'Yes');
            $update_plan_bonus=User::where('id',$user_id)->update($da);


            $admin_email=Setting::get_admin_email();
             $data = array(
            'admin_email'       =>  $admin_email,
            'template'          =>  'user_tier_upgrade_notification',
            'subject'           =>  'Congratulations  your are promotion to '.$new_tier_name,
            'webtitle'          =>  'Aktos Invest',
            'full_name'         =>  $full_name,
             'email'            =>  $email,
              'new_tier'        => $new_tier_name,
             'bonus_amount'     => number_format($bonus_amount,2).' EUR'

           );
           \Mail::to($email)->send(new SendMail($data));

           //send to admin email
             $data = array(
            'admin_email'       =>  $admin_email,
            'template'          =>  'admin_tier_upgrade_notification',
            'subject'           =>  'User upgrade into '.$new_tier_name.' '.$full_name.' '.$email,
            'webtitle'          =>  'Aktos Invest',
             'full_name'         =>  $full_name,
             'email'            =>  $email,
             'new_tier'            => $new_tier_name,
             'bonus_amount'       => number_format($bonus_amount,2).' EUR'

           );
           \Mail::to($admin_email)->send(new SendMail($data));




        }

      }
    }
     else{
         return true;
     }
    }

   public static function update_user_wallet_transaction_history($user_id,$amount,$status,$action,$table_name,$transaction_id){

           $q3=Deposit::update_user_wallet_balance($user_id,$amount);

           $tier_name=Balance_info::get_user_tier_name(User::get_user_info($user_id)->tier_id);

           if($action=='bonus')
           {
               $cmt='One-time commission for first Tier upgrade to '.$tier_name;
           }else{
               $cmt='Commission for a deposit in your network';
           }

              $data1 = array(
                'user_id'            => $user_id,
                'transaction_id'     => $transaction_id,
                'amount'             => $amount,
                'currency'           => 'EUR',
                'action'             => $action,
                'table_name'         => $table_name,
                'comment'            => $cmt,
                'status'             => $status
                 );
            $q0=Transaction::create($data1);

   }



  public static function update_level_income($user_id,$sponsor_id,$tier_id,$amount,$i){

      if($tier_id !=1)
      {
           $tier=Tier_level::where('id',$tier_id)->first();
           $rate1=$tier->first_level_comm;
           $rate2=$tier->second_level_comm;
           $rate3=$tier->third_level_comm;

           $userData=User::where(['id'=>$user_id,'sponsor_id'=>$sponsor_id])->first();
           $user_id1=$userData->sponsor_id;
           $sponsor_id1=User::get_user_info($user_id1)->sponsor_id;
          // return $user_id1.'<br>-';
           //return $i++;
           Balance_info::update_level_income($user_id1,$sponsor_id1,$tier_id,$amount,$i);
           if($parent_id == 1)
           {
               return true;
           }
      }



    }


    public static function update_total_personal_deposit($user_id,$amount){

        $user=User::get_user_info($user_id);
        $amount1=$user->personal_deposit+$amount;
        $data=array('personal_deposit'=>$amount1);
        return User::where(['id'=>$user_id])->update($data);

    }
    public static function update_total_team_deposit($sponsor_id,$user_id,$amount){

       $user=User::get_user_info($sponsor_id);
       if(!empty($user))
       {
        $amount1=$user->team_deposit+$amount;
        $data=array('team_deposit'=>$amount1);
        if($sponsor_id != $user_id)
        {
        $q=User::where(['id'=>$sponsor_id])->update($data);
        }
            $parent_id=$user->sponsor_id;
            $q2=Balance_info::update_total_team_deposit($parent_id,$user_id,$amount);
        	if($parent_id  == 1){
        		return 1;
        	}
       }

    }



public static function get_total_assest_amount($uid,$i,$asset_id,$year){
     $total=0;
     $uid=Auth::id();
     $data=DB::table('current_asset_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
        if(array_key_exists($i,$raw_data)){
             $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         }


      }
     }
     return $total;
   }



public static function get_total_nonassest_amount($uid,$i,$asset_id,$year){
     $total=0;
     $data=DB::table('noncurrent_asset_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       // $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         if(array_key_exists($i,$raw_data)){
             $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         }

      }
     }
     return $total;
   }


public static function get_total_liability_amount($uid,$i,$asset_id,$year){
     $total=0;
     $data=DB::table('current_liability_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       // $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         if(array_key_exists($i,$raw_data)){
             $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         }
      }

     }
     return $total;
   }



public static function get_total_nonliability_amount($uid,$i,$asset_id,$year){
     $total=0;
     $data=DB::table('noncurrent_liability_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
        //$total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         if(array_key_exists($i,$raw_data)){
             $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         }
      }

     }
     return $total;
   }


public static function get_total_equity_amount($uid,$i,$asset_id,$year){
     $total=0;
     $data=DB::table('equity_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       // $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         if(array_key_exists($i,$raw_data)){
             $total +=isset($raw_data)?$raw_data[$i][$asset_id]:0;
         }
      }

     }
     return $total;
   }


public static function get_sum_of_assetsheet($uid,$year){
     $total=0;
     $data=DB::table('current_asset_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       foreach ($raw_data as $value) {
        foreach ($value as  $value1) {
          $total +=$value1;
        }
       }
      }

     }
     return $total;
   }


public static function get_sum_of_nonassetsheet($uid,$year){
     $total=0;
     $data=DB::table('noncurrent_asset_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       foreach ($raw_data as $value) {
        foreach ($value as  $value1) {
          $total +=$value1;
        }
       }
      }

     }
     return $total;
   }


public static function get_sum_of_liabilitysheet($uid,$year){
     $total=0;
     $data=DB::table('current_liability_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       foreach ($raw_data as $value) {
        foreach ($value as  $value1) {
          $total +=$value1;
        }
       }
      }

     }
     return $total;
   }


public static function get_sum_of_nonliabilitysheet($uid,$year){
     $total=0;
     $data=DB::table('noncurrent_liability_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       foreach ($raw_data as $value) {
        foreach ($value as  $value1) {
          $total +=$value1;
        }
       }
      }

     }
     return $total;
   }

public static function get_sum_of_equitysheet($uid,$year){
     $total=0;
     $data=DB::table('equity_balancesheet')->where('uid',$uid)->whereYear('created_at',$year)->get();
     if($data->count()>0){
      foreach ($data as  $record) {
        $raw_data=json_decode($record->raw_data,true);
       foreach ($raw_data as $value) {
        foreach ($value as  $value1) {
          $total +=$value1;
        }
       }
      }

     }
     return $total;
   }



}
