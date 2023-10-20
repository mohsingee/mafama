<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
         'name', 'email','sponsor_id','plan_id','team_members','direct_members','total_uplines','password','show_pass', 'role','status','level', 'role2', 'affiliate_user_id', 'affiliate_user_email', 'logincount','is_invite_lead_earned','is_network_lead_earned', 'total_send_emails','username','admin_per_id','phone','zip_code','address','city','permission1','latitute','longitude','is_promoted','rank_id','total_email','email_count','total_sms','sms_count',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


public static function mysharing_link()
{
     $my_referral_link ='';
    if(Auth::check())
    {
     $aff_data=AffiliateRegistration::where('email',Auth::user()->email)->first();
         
          if(!empty($aff_data->code)){
              $sponsor_link=AffiliateRegistration::get_user_referral_link($aff_data->code,$aff_data->email); 
               $my_referral_link=$sponsor_link;
          }
    }
    

          return $my_referral_link;
}

public function user_affiliate_details(){
    return $this->hasOne('App\AffiliateRegistration', 'email', 'email');
}

public static function my_referral_link($email)
{
    $aff_data=AffiliateRegistration::where('email',$email)->first();
          $my_referral_link ='';
          if(!empty($aff_data->code)){
              $sponsor_link=AffiliateRegistration::get_user_referral_link($aff_data->code,$aff_data->email); 
               $my_referral_link =$sponsor_link;
          }

          return $my_referral_link;
}
    public static function get_user_info($user_id){

     $data=User::where(['id'=>$user_id])->first();
     return $data;
    }


     public static function update_total_team_members($user_id){
      
       $user=User::get_user_info($user_id);
       if(!empty($user))
       {
           
        $team_members=$user->team_members+1;
        $data=array('team_members'=>$team_members);
        $q=User::where(['id'=>$user_id])->update($data);
        $update_upline=User::update_total_uplines($user_id);
        $parent_id=$user->sponsor_id;
        $q2=User::update_total_team_members($parent_id);
        if($parent_id  == 1){
            return 1;
        }
       }
        
    }
    
    
    
    public static function get_recent_achievers(){

     $data=PrizeReward::where(['prize_rewards.status'=>1])
     ->leftJoin('users', 'users.id', '=', 'prize_rewards.user_id')  
   ->select('prize_rewards.*','users.name as username','users.email')
   ->orderBy('prize_rewards.id', 'desc')
   ->get();
     return $data;
    }

     
 public static function get_user_profile_pic($email){
     $img= asset('public/images/affiliates/1603958653625_1612262104.jpg');
         $user=AffiliateRegistration::where('email',$email)->first();
         if(!empty($user->image)){
                $img=asset('public/images/affiliates/'.$user->image);
             }
             else
             {
               $img= asset('public/images/affiliates/1603958653625_1612262104.jpg');
             }
         
         return $img;
     }

     public static function update_total_uplines($user_id){
       
       if(!empty($user_id))
       {
        $team_members=Balance_info::all_upline_users($user_id);
        $data=array('total_uplines'=>$team_members);
        $q=User::where(['id'=>$user_id])->update($data);
         return true;  
       }
        
    }



public static function google_analytics_code(){
  $data=DB::table('google_analytics')->where('id',1)->first();
  return $data->analytics_code;
}

}
