<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use \App\Mail\SendMail;
use DB;
use Auth;

class TestComparision extends Model
{
    //
    protected $fillable = [
        'uid','login_id','client_id','component_id','test_component','current_value','standard_value','status',
    ];


  public static function get_test_components_records($client_id)
  {
      $data=TestComparision::where(['test_comparisions.client_id'=>$client_id,'test_comparisions.login_id'=>Auth::id()])
         ->join('users', 'users.id', '=', 'test_comparisions.login_id')       
         ->join('test_components', 'test_components.id', '=', 'test_comparisions.component_id')
         ->select('test_comparisions.*','test_components.component','test_components.description')
         ->orderBy('test_comparisions.id','DESC')
        
         ->get();
        return $data; 
  }
 


  public static function get_top_comparision_records($client_id,$limit)
  {
      $data = TestComparision::where(['client_id'=>$client_id,'login_id'=>Auth::id()])
      ->orderBy('created_at', 'desc')
      ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
      ->take($limit)
      ->get(array(DB::raw('Date(created_at) as created_at')));
       return $data; 
  }  
 

  public static function get_chart_comparision_records($client_id,$component_id,$limit)
  {
      $data = TestComparision::where(['client_id'=>$client_id,'component_id'=>$component_id,'login_id'=>Auth::id()])
      ->orderBy('created_at', 'desc')
      ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
      ->take($limit)
      ->get(array(DB::raw('Date(created_at) as created_at')));
       return $data; 
  }
 



public static function get_test_coparision_by_month($component_id, $client_id,$month)
 {        
  $uid = "";     
  if((Auth::user()->role) == "affiliate"){
        $uid = Auth::id();
      }else{
        $uid = Auth::user()->affiliate_user_id;  
      }

        $current_year = date('Y');
        $sum = TestComparision::where(['client_id'=>$client_id,'component_id'=>$component_id])->whereDate('created_at', $month)->whereYear('created_at', date('Y'))->sum('current_value');
        return $sum;

    }





public static function get_test_coparision_current_value($component_id, $client_id,$date)
 {        
  $uid = "";     
  if((Auth::user()->role) == "affiliate"){
        $uid = Auth::id();
      }else{
        $uid = Auth::user()->affiliate_user_id;  
      }

        $current_year = date('Y');
        $sum = TestComparision::where(['client_id'=>$client_id,'component_id'=>$component_id])->whereDate('created_at', $date)->whereYear('created_at', date('Y'))->sum('current_value');
        return $sum;

    }







}
