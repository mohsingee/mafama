<?php

namespace App;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Mail\SendMail;
class Mlm_transaction extends Model
{
    //

     protected $fillable = [
        'user_id','tid','amount','table_name','description','status','lid',
    ];


 public static function get_level_income_report(){

 // echo Carbon::today();die;

   $data=Bonus_income::where(['bonus_incomes.status'=>1])
   ->leftJoin('users', 'users.id', '=', 'bonus_incomes.user_id')  
   ->select('bonus_incomes.*','users.name as username')
   ->orderBy('bonus_incomes.id', 'desc')
   ->get();
        
        
    return $data;     
 }



 public static function get_bonus_income_report(){

  $data2=BonusReward::where(['bonus_rewards.status'=>1])
   ->leftJoin('users', 'users.id', '=', 'bonus_rewards.user_id')  
   ->select('bonus_rewards.*','users.name as username')
   ->orderBy('bonus_rewards.id', 'desc')
   ->get();

   $data=Mlm_transaction::where(['mlm_transactions.status'=>1])
   ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')  
   ->select('mlm_transactions.*','users.name as username')
   ->orderBy('mlm_transactions.id', 'desc')
   ->get();
    return $data2;   
        
       
 }



 public static function get_prize_report(){

 // echo Carbon::today();die;

   $data=PrizeReward::where(['prize_rewards.status'=>1])   
   ->leftJoin('users', 'users.id', '=', 'prize_rewards.user_id')  
   ->select('prize_rewards.*','users.name as username')
   ->orderBy('prize_rewards.id', 'desc')
   ->get();
    return $data;     
 }


 public static function get_other_prize_report(){

 // echo Carbon::today();die;

   $data=OtherReward::where(['other_rewards.status'=>1])   
   ->leftJoin('users', 'users.id', '=', 'other_rewards.user_id')  
   ->select('other_rewards.*','users.name as username')
   ->orderBy('other_rewards.id', 'desc')
   ->get();
    return $data;     
 }




 public static function transaction_history(){

 // echo Carbon::today();die;

   $data=Mlm_transaction::where(['mlm_transactions.status'=>1])
  
   ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')  
   ->select('mlm_transactions.*','users.name as username')
   ->orderBy('mlm_transactions.id', 'desc')
   ->get();
    return $data;     
 }








 public static function get_usertransaction_list_hwe(){
    $data['']='';
    if(Auth::check()){
       $data=Mlm_transaction::where(['mlm_transactions.status'=>1,'mlm_transactions.user_id'=>Auth::user()->id])
         ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')       
         ->select('mlm_transactions.*','users.name as username')
         ->orderBy('mlm_transactions.id', 'desc')->get(); 
    }

   
    return $data;     
 }
 

 // ravi software develoepr  start code
 public static function get_usertransaction_list($year=null){
     //      $ar = array();
//      Balance_info::get_total_upline(145,145,$ar,1263);
//     echo count($ar);
//   echo '<br>ravi';
    $total_uplines=Balance_info::all_upline_users_hwe(1350,1350);
   
     
    $data_final=array();
    if(Auth::check()){
       $data=Mlm_transaction::where(['mlm_transactions.status'=>1,'mlm_transactions.user_id'=>Auth::user()->id])
         ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')
         ->select('mlm_transactions.*','users.name as username')
         ->orderBy('mlm_transactions.id', 'desc')->get(); 
         
         if(!empty($year)){
          $data=Mlm_transaction::where(['mlm_transactions.status'=>1,'mlm_transactions.user_id'=>Auth::user()->id])
         ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')
         ->where( DB::raw('YEAR(mlm_transactions.created_at)'), '=', $year )
         ->select('mlm_transactions.*','users.name as username')
         ->orderBy('mlm_transactions.id', 'desc')->get(); 
         }
         if(!empty($data)){
                            
             foreach($data as $data_val){
                
                 $data_hwe['id'] = $data_val->id;
                
                            $data_hwe['user_id'] = $data_val->user_id;
                            $data_hwe['tid'] = $data_val->tid;
                            $data_hwe['amount'] = $data_val->amount;
                            $data_hwe['description'] = $data_val->description;
                            $data_hwe['table_name'] = $data_val->table_name;
                            $data_hwe['status'] = $data_val->status;
                            $data_hwe['transaction_type'] = $data_val->transaction_type;
                            $data_hwe['created_at'] = $data_val->created_at;
                            $data_hwe['updated_at'] = $data_val->updated_at;
                            $data_hwe['username'] = $data_val->username;
                 if($data_val->table_name =='bonus_incomes' || $data_val->table_name =='level_earnings'){
                     if($data_val->description =='Direct Earning'){
                        //  echo $data_val->description;
                         $get_user_info_levels = DB::table('level_earnings')->where('id',$data_val->lid)->get('ref_id');
                         if(!empty($get_user_info_levels)){
                             foreach($get_user_info_levels as $get_user_info_levels_val){
                                   $get_user_info = DB::table('users')->where('id',$get_user_info_levels_val->ref_id)->get('email');
                             if(!empty($get_user_info)){
                             foreach($get_user_info as $get_user_info_val){
                                 $email = $get_user_info_val->email;
                                 $affiliate_registrations_data =  DB::table('affiliate_registrations')->where('affiliate_registrations.email', $email)->leftJoin('country', 'country.iso', '=', 'affiliate_registrations.country')->leftJoin('comunes', 'comunes.id', '=', 'affiliate_registrations.commune')->get(['affiliate_registrations.*','country.name as country_name','comunes.commune as commune_name']);
                                if(!empty($affiliate_registrations_data)){
                             foreach($affiliate_registrations_data as $affiliate_registrations_val){
                                $data_hwe['first_name'] = $affiliate_registrations_val->first_name;
                                $data_hwe['last_name'] = mb_substr($affiliate_registrations_val->last_name,0,1);
                                $data_hwe['code'] = $affiliate_registrations_val->code;
                                if($affiliate_registrations_val->country_name =='HAITI'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->commune_name;
                                $data_hwe['city'] = '';//$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='US'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = '';
                                $data_hwe['city'] =$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='US'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state_name?:'';
                                $data_hwe['city'] =$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else{
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state;
                                $data_hwe['city'] = $affiliate_registrations_val->city;
                                $data_hwe['commune'] = $affiliate_registrations_val->commune_name?:'';
                                }
                                
                             }
                             }
                        }
                       
                      }
                     
                             }
                              
                         }
                        
                     }else{
                     if($data_val->table_name =='bonus_incomes'){
                         $ref_id_get = DB::table('bonus_incomes')->where('id',$data_val->tid)->get('ref_id');
                     }else if($data_val->table_name =='level_earnings'){
                         $ref_id_get = DB::table('level_earnings')->where('user_id',$data_val->user_id)->get('ref_id');
                     }
                      
                      if(!empty($ref_id_get)){
                         foreach($ref_id_get as $ref_id_val){
                             $ref_id = $ref_id_val->ref_id?:0;
                             if($ref_id != 0){
                            $get_user_info = DB::table('users')->where('id',$ref_id)->get('email');
                             if(!empty($get_user_info)){
                             foreach($get_user_info as $get_user_info_val){
                                 $email = $get_user_info_val->email;
                                 $affiliate_registrations_data =  DB::table('affiliate_registrations')->where('affiliate_registrations.email', $email)->leftJoin('country', 'country.iso', '=', 'affiliate_registrations.country')->leftJoin('comunes', 'comunes.id', '=', 'affiliate_registrations.commune')->leftJoin('state', 'state.code', '=', 'affiliate_registrations.state')->get(['affiliate_registrations.*','country.name as country_name','comunes.commune as commune_name','state.name as state_name']);
                                if(!empty($affiliate_registrations_data)){
                             foreach($affiliate_registrations_data as $affiliate_registrations_val){
                                $data_hwe['first_name'] = $affiliate_registrations_val->first_name;
                                $data_hwe['last_name'] =  mb_substr($affiliate_registrations_val->last_name,0,1);
                                $data_hwe['code'] = $affiliate_registrations_val->code;
                                if($affiliate_registrations_val->country_name =='HAITI'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->commune_name;
                                $data_hwe['city'] = '';//$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='US'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = '';
                                $data_hwe['city'] =$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='JM'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state_name?:'';
                                $data_hwe['city'] ='';//$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else{
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state;
                                $data_hwe['city'] = $affiliate_registrations_val->city;
                                $data_hwe['commune'] = $affiliate_registrations_val->commune_name?:'';
                                }
                             }
                             }
                        }
                      }
                      }
                         }
                      }
                 }
                 }else {
                     
                         $get_user_info = DB::table('users')->where('id',$data_val->user_id)->get('email');
                             if(!empty($get_user_info)){
                             foreach($get_user_info as $get_user_info_val){
                                 $email = $get_user_info_val->email;
                                 $affiliate_registrations_data =  DB::table('affiliate_registrations')->where('affiliate_registrations.email', $email)->leftJoin('country', 'country.iso', '=', 'affiliate_registrations.country')->leftJoin('comunes', 'comunes.id', '=', 'affiliate_registrations.commune')->get(['affiliate_registrations.*','country.name as country_name','comunes.commune as commune_name']);
                                if(!empty($affiliate_registrations_data)){
                             foreach($affiliate_registrations_data as $affiliate_registrations_val){
                                $data_hwe['first_name'] = $affiliate_registrations_val->first_name;
                                $data_hwe['last_name'] = mb_substr($affiliate_registrations_val->last_name,0,1);
                                $data_hwe['code'] = $affiliate_registrations_val->code;
                                if($affiliate_registrations_val->country_name =='HAITI'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->commune_name;
                                $data_hwe['city'] = '';//$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='US'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = '';
                                $data_hwe['city'] =$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else if($affiliate_registrations_val->country =='US'){
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state_name?:'';
                                $data_hwe['city'] =$affiliate_registrations_val->city;
                                $data_hwe['commune'] = '';//$affiliate_registrations_val->commune_name?:'';
                                }else{
                                    $data_hwe['country'] = $affiliate_registrations_val->country_name;
                                $data_hwe['state'] = $affiliate_registrations_val->state;
                                $data_hwe['city'] = $affiliate_registrations_val->city;
                                $data_hwe['commune'] = $affiliate_registrations_val->commune_name?:'';
                                }
                                
                             }
                             }
                        }
                      }
                     
                     
                 }
                 
                 
                   
                          array_push($data_final,$data_hwe);
                 

             }
         }
        
    }
    // print_r($data_final);
    // die;
    return $data_final;     
 }


 public static function get_usercommission_list(){
    $data['']='';
    //,'bonus_rewards','prize_rewards','other_rewards'
    if(Auth::check()){
       $data=Mlm_transaction::where(['mlm_transactions.status'=>1,'mlm_transactions.user_id'=>Auth::user()->id])
       ->whereIn('mlm_transactions.table_name',['bonus_incomes'])
         ->leftJoin('users', 'users.id', '=', 'mlm_transactions.user_id')
         ->select('mlm_transactions.*','users.name as username')
         ->orderBy('mlm_transactions.id', 'desc')->get();
    }


    return $data;
 }

    
}
