<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AccessMonitoring extends Model
{
    protected $fillable = [
        'user_id','idle_time','stroke_time','spend_time','total_login','login_points','hour_points','earned_points',
    ];


  
 public static function update_total_stroke_idle_time(){
 
		$q1=AccessMonitoring::where(['user_id'=>Auth::user()->id])->get();
		if($q1->count() > 0){
		  
		 $idle_time=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('idle_time');
		 $stroke_time=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('stroke_time');
		 $spend_time=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('spend_time');
		
		 $total_login=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('total_login');
		 $login_points=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('login_points');
		 $hour_points=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('hour_points');
		 $earned_points=DailyAccessMonitoring::where('user_id',Auth::user()->id)->sum('earned_points');
          $data=array(
          	        'idle_time'      =>$idle_time,
          	        'stroke_time'    =>$stroke_time,
          	        'spend_time'     =>$spend_time,
          	        'total_login'    =>$total_login,
          	        'idle_time'      =>$idle_time,
          	        'login_points'   =>$login_points,
          	        'hour_points'    =>$hour_points,
          	        'earned_points'  =>$earned_points,
                     );
		  
		  AccessMonitoring::where(['user_id'=>Auth::user()->id])->update($data);
		}else{
		  $idle_time=0;
		  $data=array('user_id'=>Auth::user()->id,'idle_time'=>$idle_time);
		  AccessMonitoring::create($data);
		}
     return true;

 }

  
 public static function update_stroke_time(){
 
		$q1=AccessMonitoring::where(['user_id'=>Auth::user()->id])->get();
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
		  AccessMonitoring::where(['user_id'=>Auth::user()->id])->update($data);
		}else{
		  $stroke_time=0;
		  $data=array('user_id'=>Auth::user()->id,'stroke_time'=>$stroke_time);
		  AccessMonitoring::create($data);
		}
     return true;
     
 }


}
