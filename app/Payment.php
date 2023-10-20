<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'currency','payment_id','transaction_id',' description','payment_status','status',
    ];


public static function weekly_jobs(){
	$now = Carbon::now();
	$weekStartDate = $now->startOfWeek()->format('Y-m-d');
	$weekEndDate = $now->endOfWeek()->format('Y-m-d');
	$user=DB::table('revenue_record')->where('balance','<',0)->whereBetween('created_at', [$weekStartDate,$weekEndDate])->get();
	foreach ($user as $value) {
		$user_id=$value->uid;
	$check=payment::send_email_notification($user_id);
	}

}

public static function send_email_notification($user_id,$reason="",$rank=""){



      $admin_email=Setting::get_admin_email();
      $user=User::get_user_info($user_id);
         $data3= array(
          'admin_email'       =>   $admin_email,
          'template'          =>  'reminder_notification',
          'webtitle'          =>  'MAFAMA',
          'subject'           =>  "Not enough balance",
          'full_name'         =>  $user->name,
           'task'             =>  $reason
      );
       $full_name=$user->name;
       $email=$user->email;
       $subject="Not enough balance";
       $web_name="MAFAMA";
       $data1 =array('data'=>$data3);
         \Mail::send('emails.reminder_notification', $data1, function($message) use ($email, $subject,$admin_email,$web_name) {
                 $message->to($email)->subject($subject);
                 $message->from($admin_email, $web_name);
            });
}

}
