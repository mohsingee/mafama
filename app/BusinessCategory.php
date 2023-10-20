<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $fillable = [
        'category','is_medical'
    ];



    public static function is_medical_user($email)
    {
    	$check=AffiliateRegistration::where(['email'=>$email])->first();
    	if(!empty($check)){
            $business_category=$check->business_category;
            if(!empty($business_category)){
              $check1=BusinessCategory::where('id',$business_category)->first();
              if($check1->is_medical=='yes'){
              	return true;
              }else{
              	return false;
              }
            }else{
            	return false;
            }  
    	}else{
    		return false;
    	}
    }
}
