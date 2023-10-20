<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'registration_fee','promo_days', 'shareable_fields_one', 'shareable_fields_two','success_page_message','email_subject','email_body','invitation_email_subject','invitation_email_body','commission_amount','deduction_amount','commission_month'
    ];

  
    public static function general_setting(){
        $data=Setting::where('id',1)->first();
        return $data;
        
     }    

  public static function get_admin_email(){

  	return 'mem2u2@yahoo.com';
  }
 
 
 
 
  public static function lead_categories_menu_list(){

    return LeadsCategory::orderBy('category','asc')->get();
  }
 

 
 


}
