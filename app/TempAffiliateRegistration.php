<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempAffiliateRegistration extends Model
{
    protected $fillable = [
        'code', 'joining_date', 'password','show_pass', 'first_name', 'last_name', 'religion', 'otherreligion' ,'email', 'cellphone', 'business_telephone', 'lead_category', 'business_category','otherbusiness', 'image', 'address', 'zip_code', 'city', 'state', 'country','commune','department','arrondissement',  'birth_address', 'birth_zip_code', 'birth_city', 'birth_state', 'birth_country','birth_commune','birth_department','birth_arrondissement', 'billing_address', 'billing_zip_code', 'billing_city', 'billing_state', 'billing_country','sponsor_id','card_holder_name','card_no','cvv','card_validity','fees','plan_id','company','dob','total_email','email_count','total_sms','sms_count',
    ];


 



}
