<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffiliateRegistration extends Model
{
    protected $fillable = [
        'code', 'joining_date', 'password', 'first_name', 'last_name','type', 'religion','otherreligion' ,'email', 'cellphone', 'business_telephone', 'business_category','otherbusiness','lead_category', 'image', 'address', 'zip_code', 'city', 'state', 'country','commune','department','arrondissement', 'birth_zip_code', 'birth_city', 'birth_state', 'birth_country','birth_commune','birth_department','birth_arrondissement', 'billing_address', 'billing_zip_code', 'billing_city', 'billing_state','dob', 'billing_country','sponsor_id','status','is_profile_pic_updated', 'company','username','licence_no'
    ];



    public static function get_user_affiliate_code($code_name){
        $data=Levels::where('code_name',$code_name)->first();
        $level=$data->level;
        if($level <=6 && !empty($level))
        {
          $next_level=$level+1;
            $data1=Levels::where('level',$next_level)->first();
            return $data1->code_name;
        }else{

           $data1=Levels::first();
           return $data1->code_name;
        }

     }



    public static function get_user_level($code_name){
        $data=Levels::where('code_name',$code_name)->first();
        $level=$data->level;
        if($level <=6 && !empty($level))
        {
          $next_level=$level;
            return $next_level;
        }else{
           $next_level=1;

           return $next_level;
        }

     }





  public static function get_user_referral_link($code_name,$email){
    //   return $email;
        $data=Levels::where('code_name',$code_name)->first();
        // dd($data);
        $level=$data->level ?? "";
        if($level <=5 && !empty($level))
        {
          $next_level=$level+1;
            $data1=Levels::where('level',$next_level)->first();
            $code= $data1->code_name;
        }else{

           $data1=Levels::first();
           $code= $data1->code_name;
        }
        if(isset(auth()->user()->language)){
            $language = auth()->user()->language;
        }else{
            $language = 'en';
        }
        $invitation_code=base64_encode($code);
        $user_id=base64_encode($email);
        $last_link=$user_id.'/'.$invitation_code.'/'.$language;
        return url('/introduction_videos/'.$last_link);
     }


    public static function get_affiliate_fee($code_name){
        $data=Levels::where('code_name',$code_name)->first();
        return $data->fees;

     }




}
