<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use \App\Mail\SendMail;
class Chat extends Model
{
    //

     protected $fillable = [
        'to_user_id','from_user_id','reply_uid','status','message','attachment','video_link','seen_date',
    ];



    
public static function short_name($name) {
 //The strtoupper() function converts a string to uppercase.
    $name  = strtoupper($name); 
    //prefixes that needs to be removed from the name
    $remove = ['.', 'MRS', 'MISS', 'MS', 'MASTER', 'DR', 'MR'];
    $nameWithoutPrefix=str_replace($remove," ",$name);
    $words = explode(" ", $nameWithoutPrefix);
    //this will give you the first word of the $words array , which is the first name
    $firtsName = reset($words); 

    //this will give you the last word of the $words array , which is the last name
    $lastName  = end($words);

    echo substr($firtsName,0,1); 
    echo substr($lastName ,0,1); 

}
  
   
    
    
}
