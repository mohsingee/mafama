<?php

namespace App\Console\Commands;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\SendEmail;
use DB;
use Illuminate\Support\Facades\Mail;


class SchedulePointReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:scheduleppointreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       // DB::table('daily_access_monitorings')->update_user_points();
  $q12=DB::table('daily_access_monitorings')->whereDate('created_at', Carbon::today())->get();
    if($q12->count() > 0){ 
      foreach($q12  as $q1 )
      {
      // point_qualifications
      $user_id=$q1->user_id;
      $no_of_total_login=$q1->total_login;
      $no_of_total_spend_time=$q1->spend_time;
      $point=DB::table('daily_points')->where('id',1)->first();
      $qualify_logins=$point->no_of_login;
      $points_by_login=$point->login_points;
      $qualify_hours=$point->no_of_hours;
      $points_by_hours=$point->hour_points;


      // for login

      $logins=$no_of_total_login/$qualify_logins;
      $logins=floor($logins);
      if($logins >=1){
        $login_points=$logins*$points_by_login;
       
        $data =array('login_points'=>$login_points);
        DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])
       ->whereDate('created_at', Carbon::today())->update($data);

       $q2=DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])->whereDate('created_at', Carbon::today())->get();

         $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
        $data1 =array('earned_points'=>$earned_point);
        DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])
       ->whereDate('created_at', Carbon::today())->update($data1);
      }

     // for tolal login hours spend time

      $total_hours=$no_of_total_spend_time/$qualify_hours;
      $total_hours=floor($total_hours);
      if($total_hours >=1){
        $hour_points=$total_hours*$points_by_hours;
        $data =array('hour_points'=>$hour_points);
        DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])
       ->whereDate('created_at', Carbon::today())->update($data);

     $q2=DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])->whereDate('created_at', Carbon::today())->get();

       $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
       
        $data1 =array('earned_points'=>$earned_point);
        DB::table('daily_access_monitorings')->where(['user_id'=>$user_id])
       ->whereDate('created_at', Carbon::today())->update($data1);  
       
      }

      }


    }
    
}
       
        
    
}
