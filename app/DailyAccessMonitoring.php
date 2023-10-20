<?php

namespace App;
use Illuminate\Support\Carbon;

use Illuminate\Database\Eloquent\Model;
use Auth;

class DailyAccessMonitoring extends Model
{
    protected $fillable = [
        'user_id','idle_time','stroke_time','total_login','spend_time','earned_points','login_points','hour_points',
    ];


  
 public static function update_daily_idle_time(){
 
    $q1=DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])->whereDate('created_at', Carbon::today())->get();
    if($q1->count() > 0){
      $current_datetime = date('Y-m-d H:i:s');          
          $hours = strtotime($current_datetime) - strtotime($q1[0]->updated_at);
          $hours/= 3600;
          $hours = (double)$hours;
      $idle_time=$hours;
      $old_idle_time=$q1[0]->idle_time;  
      $total_idle_time=$idle_time+$old_idle_time;
      $spend_time=$total_idle_time+$q1[0]->stroke_time;
      $data =array('idle_time'=>round($total_idle_time,5),'spend_time'=>round($spend_time,5));
      DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
      ->whereDate('created_at', Carbon::today())->update($data);
      return true;
    }else{
      $idle_time=0;
      $data=array('user_id'=>Auth::user()->id,'idle_time'=>$idle_time);
      DailyAccessMonitoring::create($data);
    }
     return true;

 }


public static function update_user_points(){
   $q1=DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])->whereDate('created_at', Carbon::today())->get();
    if($q1->count() > 0){ 

      // point_qualifications
      $no_of_total_login=$q1[0]->total_login;
      $no_of_total_spend_time=$q1[0]->spend_time;
      $point=EarnedPoint::where('id',1)->first();
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
        DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
       ->whereDate('created_at', Carbon::today())->update($data);

       $q2=DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])->whereDate('created_at', Carbon::today())->get();

         $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
        $data1 =array('earned_points'=>$earned_point);
        DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
       ->whereDate('created_at', Carbon::today())->update($data1);
      }

     // for tolal login hours spend time

      $total_hours=$no_of_total_spend_time/$qualify_hours;
      $total_hours=floor($total_hours);
      if($total_hours >=1){
        $hour_points=$total_hours*$points_by_hours;
        $data =array('hour_points'=>$hour_points);
        DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
       ->whereDate('created_at', Carbon::today())->update($data);

     $q2=DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])->whereDate('created_at', Carbon::today())->get();

       $earned_point=$q2[0]->login_points+$q2[0]->hour_points;
       
        $data1 =array('earned_points'=>$earned_point);
        DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
       ->whereDate('created_at', Carbon::today())->update($data1);  

      }


    }
    return true;
}
  
 public static function update_daily_stroke_time(){
 
    $q1=DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])->whereDate('created_at', Carbon::today())->get();
    if($q1->count() > 0){
      $current_datetime = date('Y-m-d H:i:s');          
          $hours = strtotime($current_datetime) - strtotime($q1[0]->updated_at);
          $hours/= 3600;
          $hours = (double)$hours;
      $stroke_time=$hours;    
      $old_stroke_time=$q1[0]->stroke_time;  
      $total_stroke_time=$stroke_time+$old_stroke_time;
        $spend_time=$total_stroke_time+$q1[0]->idle_time;
      $data =array('stroke_time'=>round($total_stroke_time,5),'spend_time'=>round($spend_time,5));
      DailyAccessMonitoring::where(['user_id'=>Auth::user()->id])
      ->whereDate('created_at', Carbon::today())->update($data);
             return true;

    }else{
      $stroke_time=0;
      $data=array('user_id'=>Auth::user()->id,'stroke_time'=>$stroke_time);
      DailyAccessMonitoring::create($data);
    }
     return true;
     
 }



 public static function get_users_daily_monitoring_records($date){
   

       $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])->whereDate('daily_access_monitorings.created_at',  Carbon::parse($date))
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->select('daily_access_monitorings.*','users.email','users.name')
         ->get();
        return $data; 

 }


 public static function get_users_daily_monitoring_records_by_date($date){
   

       $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])->whereDate('daily_access_monitorings.created_at', Carbon::parse($date))
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->select('daily_access_monitorings.*','users.email')
         ->get();
        return $data; 

 }


 public static function week_idle_time($start_date,$end_date){
 
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereBetween('daily_access_monitorings.created_at', [$start_date, $end_date])     
         ->sum('daily_access_monitorings.idle_time');
  return $data;
 }


  public static function week_total_user_logins($start_date,$end_date){ 
  //  echo $end_date;die;
  $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereBetween('daily_access_monitorings.created_at', [$start_date, $end_date])       
         ->sum('daily_access_monitorings.total_login');
  return  $data;
 }


 public static function week_no_users($start_date,$end_date){
  
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
        ->whereBetween('daily_access_monitorings.created_at', [$start_date, $end_date])      
         ->count();
  return $data;
 }


 public static function week_points($start_date,$end_date){
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereBetween('daily_access_monitorings.created_at', [$start_date, $end_date])     
         ->sum('daily_access_monitorings.earned_points');
  return $data;
 }


 public static function week_spend_time($start_date,$end_date){
 
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereBetween('daily_access_monitorings.created_at', [$start_date, $end_date])       
         ->sum('daily_access_monitorings.stroke_time');
  return $data;
 }


// get month records



 public static function get_idle_time_by_month_name($month,$year){
 
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereMonth('daily_access_monitorings.created_at', $month)     
         ->whereYear('daily_access_monitorings.created_at', $year)     
         ->sum('daily_access_monitorings.idle_time');
  return $data;
 }


  public static function get_userlogins_by_month_name($month,$year){  
 
  $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereMonth('daily_access_monitorings.created_at', $month)     
         ->whereYear('daily_access_monitorings.created_at', $year)        
         ->count();
  return  $data;
 }



 public static function get_no_of_users_by_month_name($month,$year){
  
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
        ->whereMonth('daily_access_monitorings.created_at', $month)     
         ->whereYear('daily_access_monitorings.created_at', $year)      
         ->count();
  return $data;
 }


 public static function get_points_by_month_name($month,$year){
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
         ->whereMonth('daily_access_monitorings.created_at', $month)     
         ->whereYear('daily_access_monitorings.created_at', $year)       
         ->sum('daily_access_monitorings.earned_points');
  return $data;
 }



 public static function get_spend_time_by_month_name($month,$year){
 
   $data=DailyAccessMonitoring::where('users.status',1)->whereNotIn('users.id', [1])
         ->join('users', 'users.id', '=', 'daily_access_monitorings.user_id')       
          ->whereMonth('daily_access_monitorings.created_at', $month)     
         ->whereYear('daily_access_monitorings.created_at', $year)        
         ->sum('daily_access_monitorings.stroke_time');
  return $data;
 }





}
