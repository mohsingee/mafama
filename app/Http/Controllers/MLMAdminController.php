<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rating;
use App\Menulinks;
use App\Levels;
use App\PhotoSlides;
use DB;
use Session;
use Auth;
use App\TopBanner;
use App\TextBanner;
use App\HomeVideo;
use App\HomeTopVideo;
use App\SettingBanner;
use App\AppointmentBanner;
use App\ClientManagementBanner;
use App\EmailManagementBanner;
use App\FinancialManagementBanner;
use App\ArchivesBanner;
use App\HomeMainVideo;
use App\SettingTutorial;
use App\AppointmentTutorial;
use App\ClientTutorial;
use App\EmailTutorial;
use App\FinanceTutorial;
use App\ArchiveTutorial;
use App\TermsCondition;
use App\Archives;
use App\Popup1;
use App\Popup2;
use App\UploadPopup1;
use App\UploadPopup2;
use App\ClientTemplateCategory;
use App\FinancialTemplateCategory;
use App\UploadClientTemplate;
use App\UploadFinancialTemplate;
use App\AffiliateRegistration;
use Carbon\Carbon;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Religion;
use App\CardCategory;
use App\ScriptCategory;
use App\BusinessCategory;
use App\LeadsCategory;
use App\UploadCard;
use App\UploadScript;
use App\UploadBusiness;
use App\UploadLeads;
use App\Setting;
use App\Plan;
use App\Level_income;
use App\Network;
use App\Bonus_income;
use App\Bonus_condition;
use App\Prize_condition;
use App\OtherCondition;
use App\DailyAccessMonitoring;
use App\Balance_info;
use App\Mlm_transaction;
use App\EarnedPoint;
use App\BonusPoolPrice;
use App\AffiliateEmailTemplate;
use App\PoolPrice;
use App\BasketRotationSetting;
use App\BasketCondition;
use App\LeadQualifierSetting;
use App\LibraryForm;
use App\AssignUser;
use App\PromotionCondition;
use App\EmailCampaign;
use App\SendEmail;
use App\BusinessRegister;
use App\SendSms;

class MLMAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $topbanner = TopBanner::get();
        $topbannercount = count($topbanner);
        Session::put('topbannercount', $topbannercount);
        $textbanner = TextBanner::get();
        $textbannercount = count($textbanner);
        Session::put('textbannercount', $textbannercount);
        $homevideo = HomeVideo::get();
        $homevideocount = count($homevideo);
        Session::put('homevideocount', $homevideocount);
        $hometopvideo = HomeTopVideo::get();
        $hometopvideocount = count($hometopvideo);
        Session::put('hometopvideocount', $hometopvideocount);
        $homemainvideo = HomeMainVideo::get();
        $homemainvideocount = count($homemainvideo);
        Session::put('homemainvideocount', $homemainvideocount);
        $settingbanner = SettingBanner::get();
        $settingbannercount = count($settingbanner);
        Session::put('settingbannercount', $settingbannercount);
        $appointmentbanner = AppointmentBanner::get();
        $appointmentbannercount = count($appointmentbanner);
        Session::put('appointmentbannercount', $appointmentbannercount);
        $clientmanagementbanner = ClientManagementBanner::get();
        $clientmanagementbannercount = count($clientmanagementbanner);
        Session::put('clientmanagementbannercount', $clientmanagementbannercount);
        $emailmanagementbanner = EmailManagementBanner::get();
        $emailmanagementbannercount = count($emailmanagementbanner);
        Session::put('emailmanagementbannercount', $emailmanagementbannercount);
        $financialmanagementbanner = FinancialManagementBanner::get();
        $financialmanagementbannercount = count($financialmanagementbanner);
        Session::put('financialmanagementbannercount', $financialmanagementbannercount);
        $archivesbanner = ArchivesBanner::get();
        $archivesbannercount = count($archivesbanner);
        Session::put('archivesbannercount', $archivesbannercount);
    }
  
   
// ramkishor code here
    public function my_network()
    {
        if(permission_access('affiliate_mgt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
          $networks=Network::get_my_network(Auth::user()->id);
        $data=array('page_title'=>'Team Network','networks'=>$networks);
        return view('admin.network',$data);
    }

   public function affiliate_commission_setting()
    {

        $data['setting']=Setting::general_setting();
        // \LogActivity::addToLog('visited general setting','view',$data);
        return view('admin.affiliate_commission_setting',$data);
    }

    public function general_settings()
    {
        if(permission_access('general_settings_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['setting']=Setting::general_setting();
        // \LogActivity::addToLog('visited general setting','view',$data);
        return view('admin.general_setting_page',$data);
    }
 public function transaction_history()
    {
        if(permission_access('transactions_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['reports']=Mlm_transaction::transaction_history();
        return view('admin.all_transactions',$data);
    }
    public function bonus_income_report()
    {
        if(permission_access('reports_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
        $data['reports']=Mlm_transaction::get_bonus_income_report();
        return view('admin.bonus_income_report',$data);
        
    }
    
    public function level_income_report()
    {
        if(permission_access('level_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
       $data['bonus']=Mlm_transaction::get_level_income_report();
        return view('admin.level_income_report',$data);
    }
    public function prize_report()
    {
        if(permission_access('prize_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
        $data['reports']=Mlm_transaction::get_prize_report();
        return view('admin.prize_report',$data);
    }
    public function other_report()
    {
        if(permission_access('other_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
        $data['reports']=Mlm_transaction::get_other_prize_report();
        return view('admin.other_prize_report',$data);
    }
    public function level_income($id)
    {
        $data['plans']=Plan::where('status',1)->get();
        $data['level']=Level_income::where('id',$id)->first();
        return view('admin.level_income',$data);
    }
  public function bonus_conditions($id="")
    {
        if(permission_access('bonus_prize_setup_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
           
           if(permission_access('bonus_prize_setup_edit')!=1  &&  $id !='')
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }  
       $data['bonus']='';
       if(!empty($id)){
         $data['bonus']=Bonus_condition::where('id',$id)->first();
       }   
        return view('admin.bonus_conditions_page',$data);
    }
    public function bonus_condition_table()
    {
        if(permission_access('bonus_prize_setup_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
         $data['bonus_conditions']=Bonus_condition::where('status',1)->orderBy('id','desc')->get();
      
       $data['pool']=PoolPrice::where('id',1)->first();
       $data['pool_setting']=DB::table('pool_prize_limits')->where('id',1)->first();
        return view('bonus_condition_table',$data);
    }
  public function prize_condition_table()
    {
        if(permission_access('bonus_prizes_table_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }  
         $data['prize_conditions']=Prize_condition::where('status',1)->orderBy('id','desc')->get();
         $data['pool']=PoolPrice::where('id',1)->first();
        $data['pool_setting']=DB::table('pool_prize_limits')->where('id',1)->first();
        return view('admin.prize_condition_table',$data);
    }
     public function other_condition_table()
    {
        if(permission_access('bonus_other_table_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 

       $data['prize_conditions']=OtherCondition::where('status',1)->orderBy('id','desc')->get();
         $data['pool']=PoolPrice::where('id',1)->first();
        $data['pool_setting']=DB::table('pool_other_limits')->where('id',1)->first();
        return view('admin.other_condition_table',$data);
    }
  public function prize_conditions($id="")
    {
        if(permission_access('bonus_prizes_table_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
           
           if(permission_access('bonus_prizes_table_edit')!=1  &&  $id !='')
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }  
       $data['bonus']='';
       if(!empty($id)){
         $data['bonus']=Prize_condition::where('id',$id)->first();
       }   
        return view('admin.prize_conditions_page',$data);
    }
  public function other_conditions($id="")
    {
        if(permission_access('bonus_other_table_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
           
           if(permission_access('bonus_other_table_edit')!=1  &&  $id !='')
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 

       $data['bonus']='';
       if(!empty($id)){
         $data['bonus']=OtherCondition::where('id',$id)->first();
       }   
        return view('admin.other_conditions_page',$data);
    }
    public function affiliate_package_update($id)
    {
        $data['plan']=Plan::where('id',$id)->first();
        return view('admin.plan',$data);
    }

     public function update_affiliate_commission_setting(Request $request)
    {
        $data = array(
         'deduction_amount'       => $request->deduction_amount,
         'commission_amount'       => $request->commission_amount,
         'commission_month'       => $request->commission_month,


        );
        Setting::where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Setting updated successfully");
    }
    public function update_general_setting(Request $request)
    {
        $data = array(
         'grace_period'       => $request->grace_period,
         'registration_fee'       => $request->registration_fee,
         'shareable_fields_one'   => $request->shareable_fields_one,
         'shareable_fields_two'   => $request->shareable_fields_two,
         'success_page_message'   => $request->success_page_message,
         'email_subject'          => $request->email_subject,
         'email_body'             => $request->email_body,
         'invitation_email_subject' => $request->invitation_email_subject,
         'invitation_email_body'  => $request->invitation_email_body,
           
        );
        Setting::where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back();
    }
    public function update_affiliate_package(Request $request)
    {
        $data = array(
         'name'               => $request->name,
         'monthly_fee'        => $request->monthly_fee,
         'management_fee'     => $request->management_fee,
         'bonus_one'          => $request->bonus_one,
         'bonus_two'          => $request->bonus_two,
         'bonus_three'        => $request->bonus_three,
         'bonus_four'         => $request->bonus_four,
         'prize'              => $request->prize,
         'other'              => $request->other,
         'balance'            => $request->balance,
         'affiliate_share_price'  => $request->affiliate_share_price,
         'status'             => 1,
           
        );
        Plan::where('id',$request->id)->update($data);
        $price=$request->affiliate_share_price;
        $data = array(

         'level_2'               => round($price/2,2),
         'level_3'               => round($price/3,2),
         'level_4'               => round($price/4,2),
         'level_5'               => round($price/5,2),
         'level_6'               => round($price/6,2),
         'level_7'               => round($price/7,2),
         'level_8'               => round($price/8,2),
         'level_9'               => round($price/9,2),
         'level_10'              => round($price/10,2),
         'level_11'              => round($price/11,2),
         'level_12'              => round($price/12,2),
         'status'                => 1,

        );
        Level_income::where('plan_id',$request->id)->update($data);
        Session::flash('success', "Success!");
        return redirect('/comm_table')->with('status',"Plan updated successfully");
    }
    public function update_level_income(Request $request)
    {
        $data = array(
         'plan_id'               => $request->plan_id,
         'level_2'               => $request->level_2,
         'level_3'               => $request->level_3,
         'level_4'               => $request->level_4,
         'level_5'               => $request->level_5,
         'level_6'               => $request->level_6,
         'level_7'               => $request->level_7,
         'level_8'               => $request->level_8,
         'level_9'               => $request->level_9,
         'level_10'              => $request->level_10,
         'level_11'              => $request->level_11,
         'level_12'              => $request->level_12,
         'status'                => 1,
           
        );
        Level_income::where('id',$request->id)->update($data);
        Session::flash('success', "Success!");
        return redirect('/comm_table')->with('status',"Level income updated successfully");
    }
    public function update_bonus_conditions(Request $request)
    {
         $data = array(
         'level'               => $request->level,      
         'point_earned'        => $request->point_earned,
         'active_days'         => $request->active_days,         
         'active_users'         => $request->active_users,
         'downline_affiliate'  => $request->downline_affiliate,
         'start_date'          => $request->start_date,
         'end_date'            => $request->end_date,
         'status'              => 1,
           
        );
        if(!empty($request->id))
        {
           $q1=Bonus_condition::where('id',$request->id)->update($data);
        }
        else{
           $q1= Bonus_condition::create($data);
        }  
        Session::flash('success', "Success!");
        return redirect('/bonus_condition_table')->with('status',"Bonus condition  updated successfully");
    }
    public function update_prize_conditions(Request $request)
    {
         $data = array(
         'level'               => $request->level,      
         'point_earned'        => $request->point_earned,
         'active_days'         => $request->active_days,         
         'downline_affiliate'  => $request->downline_affiliate,
         'active_users'        => $request->active_users,
         'start_date'          => $request->start_date,
         'end_date'            => $request->end_date,
         'status'              => 1,
           
        );
        if(!empty($request->id))
        {
           $q1=Prize_condition::where('id',$request->id)->update($data);
        }
        else{
           $q1= Prize_condition::create($data);
        }  
        Session::flash('success', "Success!");
        return redirect('/prize_condition_table')->with('status',"Prize condition  updated successfully");
    }
    public function update_other_conditions(Request $request)
    {
         $data = array(
         'level'               => $request->level,      
         'point_earned'        => $request->point_earned,
         'active_days'         => $request->active_days,         
         'downline_affiliate'  => $request->downline_affiliate,
         'active_users'        => $request->active_users,
         'start_date'          => $request->start_date,
         'end_date'            => $request->end_date,
         'status'              => 1,
           
        );
        if(!empty($request->id))
        {
           $q1=OtherCondition::where('id',$request->id)->update($data);
        }
        else{
           $q1= OtherCondition::create($data);
        }  
        Session::flash('success', "Success!");
        return redirect('/other_condition_table')->with('status',"Other condition  updated successfully");
    }
     // search tree 
  public function CheckSponser(Request $request){ 
      
      $message = "User not found under this sponser";
      $status = false;
      $newuid = "";
      $newsid = "";
      $sponsor_id = Auth::user()->id;
      $user_id=$request->id;
     
      $user = DB::select( DB::raw("SELECT t1.*,t2.sponsor_id from users as t1 left join networks as t2 ON t2.user_id=t1.id where t1.id='$user_id'  ") );
    
      ob_start();
      if(!empty($user))
      {
          if($user[0]->id == $sponsor_id)
          {
              $message = "User you searched is self sponser"; 
          }
          else if($user[0]->id > $sponsor_id)
          {
              if($user[0]->sponsor_id != '')
                {
                    $sponsor_id = $user[0]->sponsor_id;
                    $newuid=$user[0]->id;
                    $newsid=$user[0]->sponsor_id;
                    
                }
                else
                {
                    $da=Network::where(['user_id'=>$user[0]->id])->first();
                    $newuid=$da->user_id;
                    $newsid=$da->sponsor_id;
                }
               $status = true;
          }
       }
      else
        {
            $message = "User ID is not registered with us";
        }
       echo json_encode(array(
        "valid"=>$status,
        "message" => $message,
        "uid" => $newuid,
        "sid" => $newsid
    ));
      
      
  }
  public function getchildtree(Request $request){
      
    $user_id=$request->id;
    $sponsor_id=$request->sponsor_id;
    
    $tree=Network::get_my_network($user_id,$sponsor_id);
    echo $tree;
      
  }
    
   public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('admin.logActivity',compact('logs'));
    }




  public function notificationsfilterbydates(Request $request)
  {
    $success = false;
    $message = "";
    $url = "";
    $html = "";
    $from_date=$request->from_date;
    $to_date=$request->to_date;

    $logs=DB::table("log_activities")->whereBetween('created_at', [$from_date,$to_date])->orderBy('id','desc')->get();
    ob_start();
    if($logs->count() >0)
    {
      $success = true;
      $i=1;
      foreach($logs as $log){
      ?>
       <tr class="nk-tb-item">
        <td class="nk-tb-col">
            <span><?= $i++ ;?>.</span>
        </td>
        <td class="nk-tb-col">
            <span><?= $log->username ;?></span>
        </td>
        <td class="nk-tb-col">
            <span><?= $log->notification ;?></span>
        </td>
        <td class="nk-tb-col">
            <span><?= $log->ip ;?></span>
        </td>
        <td class="nk-tb-col">
            <span><?= $log->created_at ;?></span>
        </td>
        <td class="nk-tb-col tb-col-md">
            <a href="javascript:voi(0)" data-id="<?=$log->id;?>" data-list="log_activities" class="btn btn-sm btn-success deleterow">Delete</a>
        </td>
    </tr>

   <?php  }
     }else{ ?>
<tr class="nk-tb-item">
        <td class="nk-tb-col" colspan="6">
            <span>No Data Found.</span>
        </td>
</tr>
   <?php  }

   $html=ob_get_clean();

    echo json_encode(array(
        "valid"=>$success,
        "url" => $url,
        "html" => $html,
        "msg" => $message
    ));
    exit;
    }



  public function approve_test_component(Request $request){
    
    $success = false;
    $message = "";
    $url = "";
    $id=$request->id;
    $data["status"]=1;
   
    $q1=DB::table("test_components")->where('id', $id)->update($data);
    if($q1)
    {
      $success = true;
      $message = "Approved successfully";
    }
    else
    {
      $message = "Not approved";
    }
   
    echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
  
  public function deleteRow(Request $request){
    
    $success = false;
    $message = "";
    $url = "";
    $id=$request->id;
    $table=$request->list;
   
    $q1=DB::table("".$table."")->where('id', $id)->delete();
    if($q1)
    {
      $success = true;
      $message = "Record deleted  successfully";
    }
    else
    {
      $message = "Not Deleted";
    }
   
    echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
  
 public function access_monitoring(Request $request ){
       if(permission_access('access_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
     if(!empty($request->get('date'))){
        $date=$request->get('date'); 
        $date=date('d',strtotime($date));
        $date=$request->get('year').'-'.$request->get('month').'-'.$date;
        }else{
         $date=date('Y-m-d');
        } 
     if(!empty($request->get('month'))){
        $month=$request->get('month'); 
        }else{
             $month=date('m',strtotime($date));
        } 
        if(!empty($request->get('year'))){
        $year=$request->get('year'); 
        }else{
             $year=date('Y',strtotime($date));
        }   
    
     $data['date']=$date;
     $data['month']=$month;
     $data['year']=$year;
     $current_date = date('Y-m-d', strtotime("$date first day of this month"));
     $first_week_date=date('Y-m-d' , strtotime( "$current_date +7 day" ));
     $second_week_date=date('Y-m-d' , strtotime( "$first_week_date +7 day" ));
     $third_week_date=date('Y-m-d' , strtotime( "$second_week_date +7 day" ));
     $fourth_week_date=date('Y-m-d' , strtotime( "$third_week_date +9 day" ));
    $currentYear = Carbon::parse($date)->format('Y');
    $Q1start=Carbon::createMidnightDate($currentYear,1,1);
    $Q1end=Carbon::createMidnightDate($currentYear,3,31);
    $Q2start=Carbon::createMidnightDate($currentYear,4,1);
    $Q2end=Carbon::createMidnightDate($currentYear,6,30);
    $Q3start=Carbon::createMidnightDate($currentYear,7,1);
    $Q3end=Carbon::createMidnightDate($currentYear,9,30);
    $Q4start=Carbon::createMidnightDate($currentYear,10,1);
    $Q4end=Carbon::createMidnightDate($currentYear,12,31);
    
    
     $data['daily']=DailyAccessMonitoring::get_users_daily_monitoring_records($date);
     $data['first_week_idle_time']=DailyAccessMonitoring::week_idle_time($current_date,$first_week_date);
     $data['first_week_no_users']=DailyAccessMonitoring::week_no_users($current_date,$first_week_date);
     $data['first_week_point']=DailyAccessMonitoring::week_points($current_date,$first_week_date);
     $data['first_week_total_spend_time']=DailyAccessMonitoring::week_spend_time($current_date,$first_week_date);
     $data['first_week_total_logins']=DailyAccessMonitoring::week_total_user_logins($current_date,$first_week_date);
     $data['second_week_idle_time']=DailyAccessMonitoring::week_idle_time($first_week_date,$second_week_date);
     $data['second_week_no_users']=DailyAccessMonitoring::week_no_users($first_week_date,$second_week_date);
     $data['second_week_point']=DailyAccessMonitoring::week_points($first_week_date,$second_week_date);;
     $data['second_week_total_spend_time']=DailyAccessMonitoring::week_spend_time($first_week_date,$second_week_date);;
     $data['second_week_total_logins']=DailyAccessMonitoring::week_total_user_logins($first_week_date,$second_week_date);;
     $data['third_week_idle_time']=DailyAccessMonitoring::week_idle_time($second_week_date,$third_week_date);
     $data['third_week_no_users']=DailyAccessMonitoring::week_no_users($second_week_date,$third_week_date);
     $data['third_week_point']=DailyAccessMonitoring::week_points($second_week_date,$third_week_date);
     $data['third_week_total_spend_time']=DailyAccessMonitoring::week_spend_time($second_week_date,$third_week_date);
     $data['third_week_total_logins']=DailyAccessMonitoring::week_total_user_logins($second_week_date,$third_week_date);
     $data['four_week_idle_time']=DailyAccessMonitoring::week_idle_time($third_week_date,$fourth_week_date);
     $data['four_week_no_users']=DailyAccessMonitoring::week_no_users($third_week_date,$fourth_week_date);
     $data['four_week_point']=DailyAccessMonitoring::week_points($third_week_date,$fourth_week_date);
     $data['four_week_total_spend_time']=DailyAccessMonitoring::week_spend_time($third_week_date,$fourth_week_date);
     $data['four_week_total_logins']=DailyAccessMonitoring::week_total_user_logins($third_week_date,$fourth_week_date);
     $data['first_quater_idle_time']=DailyAccessMonitoring::week_idle_time($Q1start,$Q1end);
     $data['first_quater_no_users']=DailyAccessMonitoring::week_no_users($Q1start,$Q1end);
     $data['first_quater_point']=DailyAccessMonitoring::week_points($Q1start,$Q1end);
     $data['first_quater_total_spend_time']=DailyAccessMonitoring::week_spend_time($Q1start,$Q1end);
     $data['first_quater_total_logins']=DailyAccessMonitoring::week_total_user_logins($Q1start,$Q1end);
    $data['second_quater_idle_time']=DailyAccessMonitoring::week_idle_time($Q2start,$Q2end);
     $data['second_quater_no_users']=DailyAccessMonitoring::week_no_users($Q2start,$Q2end);
     $data['second_quater_point']=DailyAccessMonitoring::week_points($Q2start,$Q2end);
     $data['second_quater_total_spend_time']=DailyAccessMonitoring::week_spend_time($Q2start,$Q2end);
     $data['second_quater_total_logins']=DailyAccessMonitoring::week_total_user_logins($Q2start,$Q2end);
    $data['third_quater_idle_time']=DailyAccessMonitoring::week_idle_time($Q3start,$Q3end);
     $data['third_quater_no_users']=DailyAccessMonitoring::week_no_users($Q3start,$Q3end);
     $data['third_quater_point']=DailyAccessMonitoring::week_points($Q3start,$Q3end);
     $data['third_quater_total_spend_time']=DailyAccessMonitoring::week_spend_time($Q3start,$Q3end);
     $data['third_quater_total_logins']=DailyAccessMonitoring::week_total_user_logins($Q3start,$Q3end);
     $data['four_quater_idle_time']=DailyAccessMonitoring::week_idle_time($Q4start,$Q4end);
     $data['four_quater_no_users']=DailyAccessMonitoring::week_no_users($Q4start,$Q4end);;
     $data['four_quater_point']=DailyAccessMonitoring::week_no_users($Q4start,$Q4end);
     $data['four_quater_total_spend_time']=DailyAccessMonitoring::week_points($Q4start,$Q4end);
     $data['four_quater_total_logins']=DailyAccessMonitoring::week_total_user_logins($Q4start,$Q4end);
     $data['jan_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('01',$year);
     $data['feb_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('02',$year);
     $data['mar_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('03',$year);
     $data['apr_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('04',$year);
     $data['may_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('05',$year);
     $data['jun_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('06',$year);
     $data['jul_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('07',$year);
     $data['aug_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('08',$year);
     $data['sep_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('09',$year);
     $data['oct_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('10',$year);
     $data['nov_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('11',$year);
     $data['dec_idle_time']=DailyAccessMonitoring::get_idle_time_by_month_name('12',$year);
     $data['jan_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('01',$year);
     $data['feb_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('02',$year);
     $data['mar_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('03',$year);
     $data['apr_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('04',$year);
     $data['may_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('05',$year);
     $data['jun_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('06',$year);
     $data['jul_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('07',$year);
     $data['aug_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('08',$year);
     $data['sep_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('09',$year);
     $data['oct_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('10',$year);
     $data['nov_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('11',$year);
     $data['dec_no_users']=DailyAccessMonitoring::get_userlogins_by_month_name('12',$year);
     $data['jan_points']=DailyAccessMonitoring::get_points_by_month_name('01',$year);
     $data['feb_points']=DailyAccessMonitoring::get_points_by_month_name('02',$year);
     $data['mar_points']=DailyAccessMonitoring::get_points_by_month_name('03',$year);
     $data['apr_points']=DailyAccessMonitoring::get_points_by_month_name('04',$year);
     $data['may_points']=DailyAccessMonitoring::get_points_by_month_name('05',$year);
     $data['jun_points']=DailyAccessMonitoring::get_points_by_month_name('06',$year);
     $data['jul_points']=DailyAccessMonitoring::get_points_by_month_name('07',$year);
     $data['aug_points']=DailyAccessMonitoring::get_points_by_month_name('08',$year);
     $data['sep_points']=DailyAccessMonitoring::get_points_by_month_name('09',$year);
     $data['oct_points']=DailyAccessMonitoring::get_points_by_month_name('10',$year);
     $data['nov_points']=DailyAccessMonitoring::get_points_by_month_name('11',$year);
     $data['dec_points']=DailyAccessMonitoring::get_points_by_month_name('12',$year);
     $data['jan_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('01',$year);
     $data['feb_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('02',$year);
     $data['mar_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('03',$year);
     $data['apr_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('04',$year);
     $data['may_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('05',$year);
     $data['jun_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('06',$year);
     $data['jul_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('07',$year);
     $data['aug_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('08',$year);
     $data['sep_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('09',$year);
     $data['oct_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('10',$year);
     $data['nov_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('11',$year);
     $data['dec_time_spend']=DailyAccessMonitoring::get_spend_time_by_month_name('12',$year);
     $data['jan_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('01',$year);
     $data['feb_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('02',$year);
     $data['mar_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('03',$year);
     $data['apr_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('04',$year);
     $data['may_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('05',$year);
     $data['jun_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('06',$year);
     $data['jul_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('07',$year);
     $data['aug_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('08',$year);
     $data['sep_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('09',$year);
     $data['oct_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('10',$year);
     $data['nov_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('11',$year);
     $data['dec_total_login']=DailyAccessMonitoring::get_userlogins_by_month_name('12',$year);
     return view('access_monitoring',$data);
    }
 // earning points setting 
   public function earning_point_setting()
   {     
    if(permission_access('earning_points_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
          
        $data['setting']=EarnedPoint::where('id',1)->first();
        return view('admin.earning_point_setting',$data);
   }
   public function update_earning_point_setting(Request $request)
   {
        $data = array(
         'no_of_login'         => $request->no_of_login,      
         'login_points'        => $request->login_points,
         'no_of_hours'         => $request->no_of_hours,         
         'hour_points'         => $request->hour_points,
         'start_date'          => $request->start_date,
         'end_date'            => $request->end_date,
        
           
        );
        if(!empty($request->id))
        {
           $q1=EarnedPoint::where('id',$request->id)->update($data);
        }
        
        Session::flash('success', "Success!");
        return redirect('/earning-point-setting')->with('status',"Earned point setting  updated successfully");
   }
    
    // public function pool_price_list()
    // {
    //     $data['poolprices']=PoolPrice::where('id',1)->orderBy('id','desc')->get();
    //     return view('admin.pool_price_list',$data);
    // }
    public function bonus_pool_price_list()
    {
        if(permission_access('bonus_pool_setup_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['bonuspoolprices']=BonusPoolPrice::where('status',1)->orderBy('id','desc')->get();
        $data['poolprices']=PoolPrice::where('id',1)->orderBy('id','desc')->get();
        return view('admin.bonus_pool_price_list',$data);
    }
  
   public function edit_bonus_pool_price_post(Request $request)
   {
        if(permission_access('bonus_pool_setup_edit')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data = array(
         'price'          => $request->price,      
         'level'          => $request->level,
        
        );
        if(!empty($request->id))
        {
           $q1=BonusPoolPrice::where('id',$request->id)->update($data);
        }
        
        Session::flash('success', "Success!");
        return redirect('/bonus-pool-price-list')->with('status',"Bonus pool price updated successfully");
   }
  
   public function edit_bonus_pool_price($id)
   {   
   if(permission_access('bonus_pool_setup_edit')!=1  &&  $id !='')
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
    $data['pool']=BonusPoolPrice::where('id',$id)->first();
    return view('admin.bonus_pool_price_page',$data);
        
       
   }
  public function affiliate_email_templates()
  { 
       if(permission_access('aff_email_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }   
      $data['template']=AffiliateEmailTemplate::where('id',1)->first();
        return view('admin.template.affiliate_email_templates',$data);
  }
public function update_affiliate_template(Request $request)
{
   $data = array(
         
         'comm_subject'             => $request->comm_subject,
         'comm_message'             => $request->comm_message,
         'bonus_subject_day'        => $request->bonus_subject_day,
         'bonus_message_day'        => $request->bonus_message_day,
         'bonus_subject_quarter'    => $request->bonus_subject_quarter,
         'bonus_message_quarter'    => $request->bonus_message_quarter,
         'prize_subject_day'        => $request->prize_subject_day,
         'prize_message_day'        => $request->prize_message_day,
         'prize_subject_quarter'    => $request->prize_subject_quarter,
         'prize_message_quarter'    => $request->prize_message_quarter,
         'status'                   => 1,
           
        );
        AffiliateEmailTemplate::where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Template  updated successfully");
}
 public function client_registration_email_template()
  { 
        if(permission_access('client_reg_email_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }   
      $data['template']=DB::table('client_registration_email_template')->where('id',1)->first();
        return view('admin.template.client_registration_email_template',$data);
  }
public function update_client_registration_email_template(Request $request)
{
        $data['email_subject']=$request->email_subject;
        $data['email_body']=$request->email_body;
        DB::table('client_registration_email_template')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Template  updated successfully");
}
 public function business_registration_email_template()
  { 
       if(permission_access('business_reg_email_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }   
      $data['template']=DB::table('business_registration_email_template')->where('id',1)->first();
        return view('admin.template.business_registration_email_template',$data);
  }
  
public function update_business_registration_email_template(Request $request)
{
        $data['email_subject']=$request->email_subject;
        $data['email_body']=$request->email_body;
        DB::table('business_registration_email_template')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Template  updated successfully");
}
 public function record_transactions_email_template()
  { 
       if(permission_access('record_transaction_email_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }   
      $data['template']=DB::table('record_transactions_email_template')->where('id',1)->first();
        return view('admin.template.record_transactions_email_template',$data);
  }
 
public function update_record_transactions_email_template(Request $request)
{
        $data['email_subject']=$request->email_subject;
        $data['email_body']=$request->email_body;
        DB::table('record_transactions_email_template')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Template  updated successfully");
}
 public function minus_balance_email_template()
  { 
         if(permission_access('minus_balance_email_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }   
      $data['template']=DB::table('minus_balance_email_template')->where('id',1)->first();
       return view('admin.template.minus_balance_email_template',$data);
  }
 
public function update_minus_balance_email_template(Request $request)
{
        $data['email_subject']=$request->email_subject;
        $data['email_body']=$request->email_body;
        DB::table('minus_balance_email_template')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Template  updated successfully");
}
public function update_pool_prize_value(Request $request)
{
   $data = array(         
         'pool_prize'             => $request->pool_prize,
        );
        DB::table('pool_prize_limits')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Prize price  updated successfully");
}
public function update_pool_other_value(Request $request)
{
   $data = array(         
         'pool_prize'             => $request->pool_prize,
        );
        DB::table('pool_other_limits')->where('id',1)->update($data);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Other pool price  updated successfully");
}
  public function view_lead_user(Request $request){
    
    $success = false;
    $message = "";
    $html = "";
    $url = "";
    $id=$request->id;
    
   
    $q1=UploadLeads::find($id);
    if($q1)
    {
       $lead_cat=DB::table('leads_categories')->where('id',$q1->category)->first()->category; 
        
      $success = true;
      ob_start(); ?>
      <style type="text/css">
          tr, td,th {
     text-align: left; 
     padding-left: 10px;
         }
      </style>
     <table width="100%" border="1">
         
         <tr>
            <th width="30%">First Name</th>  <td><?=$q1->first_name;?></td>
         </tr> 
          <tr>
            <th width="30%">Last Name</th>  <td><?=$q1->last_name;?></td>
         </tr>   
         <tr>
            <th width="30%">Email</th>  <td><?=$q1->email;?></td>
         </tr>      
        <tr>
            <th width="30%">Cell Phone</th>  <td><?=$q1->phone_no;?></td>
         </tr>  
          <tr>
            <th width="30%">Company Name</th>  <td><?=$q1->company_name;?></td>
         </tr>  
          <tr>
            <th width="30%">Address</th>  <td><?=$q1->address;?></td>
         </tr>  
          <tr>
            <th width="30%">City/Provice</th>  <td><?=$q1->city;?></td>
         </tr>  
          <tr>
            <th width="30%">State</th>  <td><?=$q1->state;?></td>
         </tr> 
          <tr>
            <th width="30%">Zip Code</th>  <td><?=$q1->zipcode;?></td>
         </tr> 
          <tr>
            <th width="30%">Country</th>  <td><?=$q1->country;?></td>
         </tr> 
          <tr>
            <th width="30%">Category</th>  <td><?=$lead_cat;?></td>
         </tr> 
         <tr>
            <th width="30%">Description</th>  <td><?=$q1->description;?></td>
         </tr>   
     </table>
      <?php 
      $html=ob_get_clean();
    }
    else
    {
      $message = "Not found";
    }
   
    echo json_encode(array(
        "valid"=>$success,        
        "html" => $html,
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
      
    
    
    
public function basket_condition($basket,$id='')
{
   $data['setting']='';
   $data['basket_id']=$basket;
   if(!empty($id)){
    $data['setting']=BasketCondition::find($id);
   }
      $data['baskets']=DB::table('baskets')->get();
      $data['leads_category']=LeadsCategory::orderBy('id','asc')->get();
        return view('admin.basket_condition',$data);
}
public function basket_rotation_setting_OLD($id='')
{
   $data['setting']='';
   if(!empty($id)){
    $data['setting']=BasketRotationSetting::find($id);
   }
      $data['baskets']=DB::table('baskets')->get();
        return view('admin.basket_rotation',$data);
}
public function basket_rotation_setting()
{   
          if(permission_access('basket_leads_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
    $id=1;
    $data['setting']=BasketRotationSetting::find($id);  
    return view('admin.basket_rotation',$data);
}
public function leads_by_category($slug)
{
     if(permission_access('leads_category_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
    if(!empty($slug)){
       $slug=str_replace('-', ' ' , $slug);
       //$data['leads']=UploadLeads::where('upload_leads.category',$slug)->orderBy('id','desc')->get();
        $data['leads'] = UploadLeads::where('upload_leads.category',$slug)->join('leads_categories', 'leads_categories.id', '=', 'upload_leads.category')
            ->select('upload_leads.*','leads_categories.category as catname')
            ->orderBy('upload_leads.id','desc')
           ->get();
       $lead_cat=DB::table('leads_categories')->where('id',$slug)->first()->category; 
        
       $data['category_name']=ucwords($lead_cat);
       
      // print_r( $data['leads']);
       return view('admin.leads_by_category',$data);
    }
}
public function update_basket_rotation(Request $request)
{
   
   $data = array(         
         'old_lead'                     => $request->old_lead,
         'direct_affiliates'            => $request->direct_affiliates,
         'stay_active'                  => $request->stay_active,
         'active_users'                 => $request->active_users,
         'send_emails'                  => $request->send_emails,
         'earned_points'                => $request->earned_points,
         'paid_users'                   => $request->paid_users,        
         'point_month'                  => $request->point_month,        
         'email_month'                  => $request->email_month,        
         'status'                      => 1,
        );
        if(!empty($request->id))
        {
           $q1=BasketRotationSetting::where('id',$request->id)->update($data);
        }else{
           $q1=BasketRotationSetting::create($data);
        }
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Setting  updated successfully");
}
public function update_basket_rotation_OLDDD(Request $request)
{
    $notification=isset($request->notification)?'Yes':'No';
   $data = array(         
         'term_days'              => $request->term_days,
         'basket_id'              => $request->basket_id,
         'all_downlines'          => $request->all_downlines,
         'lower_level'            => $request->lower_level,
         'qualification1'         => $request->qualification1,
         'qualification2'         => $request->qualification2,
         'qualification3'         => $request->qualification3,
         'notification'           => $notification,
         'status'                 => 1,
        );
        if(!empty($request->id))
        {
           $q1=BasketRotationSetting::where('id',$request->id)->update($data);
        }else{
           $q1=BasketRotationSetting::create($data);
        }
        Session::flash('success', "Success!");
        return redirect('basket_leads_rotation')->with('status',"Setting  updated successfully");
}

public function update_basket_condition(Request $request)
{
    $categories='';
   if(!empty($request->categories)){
     $categories=implode(',', $request->categories);
   }
   
   $data = array(         
         'active_affiliates'      => $request->active_affiliates,
         'basket_id'              => $request->basket_id,
         'plus_users'             => $request->plus_users,
         'from_date'              => $request->from_date,
         'to_date'                => $request->to_date,
         'closest_contacts'       => $request->closest_contacts,
         'place_basket'           => $request->place_basket,        
         'categories'             => $categories,        
         'status'                 => 1,
        );
        if(!empty($request->id))
        {
           $q1=BasketCondition::where('id',$request->id)->update($data);
        }else{
           $q1=BasketCondition::create($data);
        }
        Session::flash('success', "Success!");
        return redirect('basket'.$request->basket_id.'_condition')->with('status',"Setting  updated successfully");
}


public function update_assign_users_conditions(Request $request)
{


   $data = array(
         'affiliate'      => $request->affiliate,
         'enterprises'    => $request->enterprises,
         'gold'           => $request->gold,
         'silver'         => $request->silver,
         'status'         => 1,
        );

           $q1=AssignUser::where('id',1)->update($data);

        Session::flash('success', "Success!");
        return redirect('assign_users')->with('status',"Setting  updated successfully");
}
  // manage project 
  
    public function manageBasketForm(Request $request)
    {   
     //   echo "<pre>";
    //   print_r($request->all());die();
        $success = false;
        $message = "";
        $url = "";
        if(isset($request->selected_user_ids) && !empty($request->selected_user_ids))
        {
        
        
          $uids=$request->selected_user_ids;
         // $uids=explode(',',$request->selected_user_ids);
       ///  print_r($uids);die;
         
          foreach($uids as $id){
              $query= UploadLeads::where('id', $id)->delete(); 
          }
             
             if($query)
             {             
                 $success = true;
                 $message="User deleted successfully.";            
                 $url=url('admin_upload_leads');          
              }
              else
              {            
                 $message="Not moved";          
              }
         
          
         
        }
               
        echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
         ));
    }
    
    
    
  // manage project 
  
    public function manageBasketForm_old()
    {   
        //echo "<pre>";
       //print_r($request->all());die();
        $success = false;
        $message = "";
        $url = "";
        if(isset($request->selected_user_ids) && !empty($request->selected_user_ids))
        {
          $basket_id=$request->basket_id;
          if(!empty($basket_id))
          {
          $uids=explode(',',$request->selected_user_ids);
          //print_r($uids);die;
          if($basket_id==1)
          {
              $data=array('basket1'=>'Yes');
          }elseif($basket_id==2)
          {
              $data=array('basket2'=>'Yes');
          }elseif($basket_id==3)
          {
              $data=array('basket3'=>'Yes');
          }
          elseif($basket_id==4)
          {
              $data=array('basket4'=>'Yes');
          }
          foreach($uids as $id){
              $query= UploadLeads::where('id', $id)->update($data); 
          }
             
             if($query)
             {             
                 $success = true;
                 $message="User moved successfully.";            
                 $url=url('admin_upload_leads');          
              }
              else
              {            
                 $message="Not moved";          
              }
          }else{
              $message="Select Basket First";     
          }  
          
         
        }
               
        echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
         ));
    }
 
   
    public function lead_qualifier_setting()
    {
        if(permission_access('lead_qualifier_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }      
       $data['setting']=LeadQualifierSetting::find(1);   
       $data['lead_categories']=LeadsCategory::get();
       return view('admin.lead_qualifier_setting',$data);
    
    }
    
    
    
   
    public function terms_conditions()
    {
        if(permission_access('terms_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 
       $data['terms']=DB::table('register_terms')->find(1) ; 
      
       return view('admin.terms_and_conditions',$data);
    
    }
     
    public function affilates_registration_enquiry()
    {
       if(permission_access('reg_request_view')!=1)
           {
              echo '<header class="text-center">
                <h1>Access Denied!</h1>
                </header>';
                 die();
           }
           $date=date('Y-m-d');
            $current_date = date('Y-m-d', strtotime("$date first day of this month"));
        $first_week_date=date('Y-m-d' , strtotime( "$current_date +7 day" ));
        $second_week_date=date('Y-m-d' , strtotime( "$first_week_date +7 day" ));
        $third_week_date=date('Y-m-d' , strtotime( "$second_week_date +7 day" ));
        $fourth_week_date=date('Y-m-d' , strtotime( "$third_week_date +9 day" ));
        $currentYear = Carbon::parse($date)->format('Y');
        $Q1start=Carbon::createMidnightDate($currentYear,1,1);
        $Q1end=Carbon::createMidnightDate($currentYear,3,31);
        $Q2start=Carbon::createMidnightDate($currentYear,4,1);
        $Q2end=Carbon::createMidnightDate($currentYear,6,30);
        $Q3start=Carbon::createMidnightDate($currentYear,7,1);
        $Q3end=Carbon::createMidnightDate($currentYear,9,30);
        $Q4start=Carbon::createMidnightDate($currentYear,10,1);
        $Q4end=Carbon::createMidnightDate($currentYear,12,31);


        $quarter_start = array();
        $quarter_start[]= array('start_date'=>$Q1start,'end_date'=>$Q1end);
        $quarter_start[]= array('start_date'=>$Q2start,'end_date'=>$Q2end);
        $quarter_start[]= array('start_date'=>$Q3start,'end_date'=>$Q3end);
        $quarter_start[]= array('start_date'=>$Q4start,'end_date'=>$Q4end);
        $data['quarters']=$quarter_start;
       $data['users']=DB::table('affiliate_enqueries')->orderBy('id','desc')->get() ; 
       $data['category'] = CardCategory::orderBy('category','desc')->get();
         $data['cards'] = UploadCard::groupBy('category')->get();
          $data['scripts'] = ScriptCategory::get();
        $data['greetings'] = DB::table('personalised_greeting')->get();
       $data['category'] = CardCategory::orderBy('category','desc')->get();
        $data['colors'] = DB::table('background_color')->get();
      $data['titles'] = EmailCampaign::orderBy('id', 'desc')
        ->groupBy('subject')
        ->get();
      
       return view('admin.affiliate_enqueries',$data);
    
    }
    
    
public function update_term_condition(Request $request)
{
   //echo $request->terms  ;die;
   $data = array(         
         'terms'     => $request->terms ,
         'updated_at' =>date('Y-m-d H:i:s')        
         
        );
       
     DB::table('register_terms')->where('id',1)->update($data);
       
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Terms  updated successfully");
}  
    
public function lead_qualifier_setting_update(Request $request)
{
   
   $cat=$request->default_category;
  
    $cats=implode(',',$cat);
    
   $data = array(         
         'pro_pic_update_lead'     => $request->pro_pic_update_lead,
         'banner_update_lead'      => $request->banner_update_lead,
         'team_network'            => $request->team_network,
         'direct_sponsor'          => $request->direct_sponsor,
         'paid_users'              => $request->paid_users,
         'team_network_leads'      => $request->team_network_leads,
         'sending_email'           => $request->sending_email,
         'invites_leads'           => $request->invites_leads,
         'no_of_times_training'    => $request->no_of_times_training,        
         'training_taken_days'     => $request->training_taken_days, 
         'training_leads'          => $request->training_leads, 
         'default_category'          => $cats, 
         'status'                  => 1,
        );
       
     LeadQualifierSetting::where('id',1)->update($data);
       
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Setting  updated successfully");
}
 
public function promotion_setting_update(Request $request)
{

   $cat=$request->lead_category;

    $cats=implode(',',$cat);

   $data = array(
         'received_lead'     => $request->received_lead,
         'closest_contact'   => $request->closest_contact,
         'lead_category'     => $cats,
         'placed_basket'     => $request->placed_basket,
         'assign_position'   => $request->assign_position,
         'status'            => 1,
        );
    //   PromotionCondition::create($data);
     PromotionCondition::where('id',$request->id)->update($data);

        Session::flash('success', "Success!");
        return redirect('affiliates_promotion_condition')->with('status',"Setting  updated successfully");
}

  
public function setEnv($name, $value)
{
    $path = base_path('.env');
    if (file_exists($path)) {
        file_put_contents($path, str_replace(
            $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
        ));
    }
}
public function update_payment_gateway_setting(Request $request){
  
        if(permission_access('payment_gateway_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 

        $this->setEnv('PAYPAL_MODE', $request->mode);
        $this->setEnv('PAYPAL_CLIENT_ID', $request->paypal_client_id);
        $this->setEnv('PAYPAL_SECRET', $request->paypal_secret_key);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Setting  updated successfully");
}

public function update_plan_menu_perimission(Request $request){

      $data=$request->all();

    $val = !empty($data['val'])?1:'';

    if($data['type'] == 'gold_access'){
        $data1['gold_access']=$val;
    }elseif($data['type'] == 'silver_access'){
         $data1['silver_access']=$val;
    }elseif($data['type'] == 'enterprise_access'){
         $data1['enterprise_access']=$val;
    }
 //print_r($data['id']);die;
    Menulinks::where('id',$data['id'])->update($data1);
    echo "updated";
}
public function update_smtp_setting(Request $request){
  

      if(permission_access('smtp_setting_edit')!=1)
     {
        echo '<center class="text-center">
          <h1>Access Denied!</h1>
          </center>';
           die();
     } 
     
        $this->setEnv('MAIL_ENCRYPTION', $request->MAIL_ENCRYPTION);
        $this->setEnv('MAIL_DRIVER', $request->MAIL_DRIVER);
        $this->setEnv('MAIL_HOST', $request->MAIL_HOST);
        $this->setEnv('MAIL_PORT', $request->MAIL_PORT);
        $this->setEnv('MAIL_USERNAME', $request->MAIL_USERNAME);
        $this->setEnv('MAIL_PASSWORD', $request->MAIL_PASSWORD);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Setting  updated successfully");
}
 public function smtp_setting()
{    
    if(permission_access('smtp_setting_view')!=1)
     {
        echo '<center class="text-center">
          <h1>Access Denied!</h1>
          </center>';
           die();
     } 
    return view('admin.smtp_setting');
    
}
 public function google_analytic_setting()
    {
        if(permission_access('google_analytics_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           } 

       $data['analytics']=DB::table('google_analytics')->find(1) ;
       return view('admin.google-analytics-setting',$data);
    
    }
public function update_google_analytics(Request $request)
{
   
    if(permission_access('google_analytics_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
   $data = array(         
         'analytics_code'     => $request->analytics_code         
        );       
     DB::table('google_analytics')->where('id',1)->update($data); 
     Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Analytics code  updated successfully");
}
     
public function payment_gateway_setting()
{   
  if(permission_access('payment_gateway_view')!=1)
   {
      echo '<center class="text-center">
        <h1>Access Denied!</h1>
        </center>';
         die();
   } 

   return view('admin.payment_gateway_setting');    
}


public function promotion_conditions($id='')
{

    $data['setting']='';


   $data['lead_categories']=LeadsCategory::get();
   if(!empty($id)){
    $data['setting']=PromotionCondition::where('id',$id)->first();
   }
   return view('admin.promotion_condition',$data);
}
     
public function admin_tests_components($id='')
{   
    if(permission_access('test_components_view')!=1)
     {
        echo '<center class="text-center">
          <h1>Access Denied!</h1>
          </center>';
           die();
     } 

     if(permission_access('test_components_edit')!=1  &&  $id !='')
     {
        echo '<center class="text-center">
          <h1>Access Denied!</h1>
          </center>';
           die();
     }  

    $data['form']='';
   
    $data['forms']=DB::table('test_components')->orderBy('id','desc')->get();
    
   if(!empty($id)){
    $data['form']=DB::table('test_components')->where('id',$id)->first();
   }
   return view('admin.admin_tests_components',$data);    
}
public function update_admin_tests_components(Request $request)
{
   
      
    if(empty($request->id)){
       $data = array(         
         'component'           => $request->component,         
         'description'         => $request->bonus_message_day,         
         'standard_value'      =>$request->standard_value,         
         'uid'                 =>1,         
         'status'              =>1,         
         'created_at'          =>date('Y-m-d H:i:s'),         
         'updated_at'          =>date('Y-m-d H:i:s'),         
                  
        );  
     DB::table('test_components')->insert($data); 
     Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Component added successfully.");
    }else{
        $data = array(         
         'component'           => $request->component,         
         'description'         => $request->bonus_message_day,
         'standard_value'      =>$request->standard_value,  
         'updated_at'          =>date('Y-m-d H:i:s'),         
                  
        ); 
      DB::table('test_components')->where('id',$request->id)->update($data); 
     Session::flash('success', "Success!");
     return redirect('admin/tests_components')->with('status',"Component  updated successfully");
  
    } 
}
     
public function admin_forms_library($id='')
{   

   if(permission_access('forms_library_add')!=1)
   {
      echo '<center class="text-center">
        <h1>Access Denied!</h1>
        </center>';
         die();
   } 


   if(permission_access('forms_library_edit')!=1  &&  $id !='')
   {
      echo '<center class="text-center">
        <h1>Access Denied!</h1>
        </center>';
         die();
   }  

    $data['form']='';
    $data['buniness_categories']=BusinessCategory::get();
    $data['form_cats']=DB::table('library_form_category')->get();
    $data['forms']=LibraryForm::where(['library_forms.status'=>1])
   ->leftJoin('library_form_category', 'library_form_category.id', '=', 'library_forms.form_cat_id')  
    ->leftJoin('business_categories', 'business_categories.id', '=', 'library_forms.business_cat_id')  
   ->select('library_forms.*','library_form_category.cat_name','business_categories.category as business_cat')
   ->orderBy('library_forms.id', 'desc')
   ->get();
   if(!empty($id)){
    $data['form']=LibraryForm::find($id);
   }
   return view('admin.admin_forms_library',$data);    
}
public function update_admin_forms_library(Request $request)
{
   // print_r($request->all());die;
    $file_path=$request->file_path1;
    if($request->hasFile('file_path'))
        {
            $file = $request->file('file_path');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $file_path = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/files';
            $file->move($destinationPath,$file_path);
        }
     $data = array(         
         'name'           => $request->form_name,         
         'form_data'      => $request->form_data,         
         'form_cat_id'    => $request->form_cat_id,         
         'business_cat_id'    => $request->business_cat_id,         
         'file_path'      => $file_path,         
         'status'         => 1,         
        );  
    if(empty($request->id)){
     LibraryForm::create($data); 
     Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Form added successfully.");
    }else{
      LibraryForm::where('id',$request->id)->update($data); 
     Session::flash('success', "Success!");
     return redirect('admin/forms_library')->with('status',"Form  updated successfully");
  
    }         
     
}
// marina


public function checkboxesmail(Request $request){
        $id = explode(',', $request->mail_arr);
        $mail_arr = [];
        $ClientAppointmentList = DB::table('affiliate_enqueries')->whereIn('id', $id)->get();
        foreach ($ClientAppointmentList as $value) {
            array_push($mail_arr, $value->email);
        }
        return $mail_arr;
    }

    public function uncheckboxesmail(Request $request)
    {
        $id = $request->id;
        $ClientAppointmentList = DB::table('affiliate_enqueries')->where('id', $id)->first();
        echo $email = $ClientAppointmentList->email;
    }
    public function uncheckedboxesmail(Request $request)
    {
        $id = $request->id;
        $email = DB::table('affiliate_enqueries')->where('id', $id)->get();
        $dmail = $email[0]->email;
        $mails = explode(',', $request->mails);
        $pos = array_search($dmail, $mails);
        unset($mails[$pos]);
        $mls = [];
        foreach ($mails as $value) {
            array_push($mls, $value);
        }
        return $mls;
    }

    public function manage_client_submit(Request $request)
    {

        // print_r($mails);die;

        $uid = Auth::id();

        $uemail=admin_email();
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $bakg = $request->bakg;
        $now = date('Y-m-d');
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        $mails = explode(',', $request->malto);
        // print_r($user_banner->preview);die;
        foreach($mails as $malto){
            $values = array(
                'email'             => $malto,
                'subject'           => $subject,
                'background'       => $bakg,
                'message'           => $message,
                'date'              => $now,
                'status'            => "sent",
                'user_banner'       => $user_banner->preview,
                'uid'               => $uid,
                'created_at'        => date('Y-m-d')
            );

            // echo print_r($values);
            DB::table('manage_client_email')->insert($values);
            $emaildetails = array(
                'malto'             => $malto,
                'subject'           => $subject,
                'bakg'              => $bakg,
                'campaign_name'     => "",
                'body'              => $message,
                'user_banner'       => $user_banner->preview,
            );
            Mail::send('manage_client_template', $emaildetails, function($message) use ($malto, $subject) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->from('support@mafama.com', Auth::user()->name);
              });
            User::where('email', Auth::user()->email)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
        }
        $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client Email Send";
        addUserActivity($subject,'add',$notification,$message);
        echo "Email has been sent succesfully";
    }

    public function admin_user_banner_details(Request $request)
    {
      $uemail = admin_email();
      $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
      echo $user_banner->preview;
    }

    public function admin_manage_client_send_on(Request $request)
    {
      $uid = "";
      $uid = Auth::id();
      $mails = explode(',', $request->malto);
      $subject = $request->subject;
      $submit_value = $request->submit_value;
      $message = $request->message;
      $bakg = $request->bakg;
      $now = $request->sendon;
      $user_banner = DB::table('affiliate_banner')->first();
      foreach($mails as $malto){
        $values = array(
          'email'             => $malto,
          'subject'           => $subject,
          'background'       => $bakg,
          'message'           => $message,
          'date'              => $now,
          'status'            => "pending",
          'user_banner'       => $user_banner->preview,
          'uid'               => $uid,
          'created_at'        => date('Y-m-d')
        );
        DB::table('manage_client_email')->insert($values);
      }
      $datee = date('d F Y', strtotime($now));
      $notification  = getNotificationMessage(41);
      $message = $notification;
      $subject = "Client Email Send";
      addUserActivity($subject,'add',$notification,$message);
      echo "Email will be sent on ".$datee;
    }

    public function admin_manage_client_card_submit(Request $request)
    {
      $uid = Auth::id();
      $uemail=admin_email();
      $mails = explode(',', $request->malto);
      $subject = $request->subject;
      $bakg = $request->bakg;
      $submit_value = $request->submit_value;
      $message = $request->message;
      $image = $request->img;
      $now = date('Y-m-d');
      $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        foreach($mails as $malto){
            $values = array(
                'email'             => $malto,
                'subject'           => $subject,
                'image'             => $image,
                'message'           => $message,
                'date'              => $now,
                'status'            => "sent",
                'user_banner'       => $user_banner->preview,
                'uid'               => $uid,
                'created_at'        => date('Y-m-d')
            );
            DB::table('manage_client_card_email')->insert($values);
            $emaildetails = array(
                'malto'             => $malto,
                'subject'           => $subject,
                'image'             => $image,
                'body'              => $message,
                'user_banner'       => $user_banner->preview,
            );
            Mail::send('manage_client_card_template', $emaildetails, function($message) use ($malto, $subject) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->from('support@mafama.com', Auth::user()->name);
              });
            User::where('email', Auth::user()->email)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
        }
        $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client Card Email Send";
        addUserActivity($subject,'add',$notification,$message);
        echo "Email has been sent succesfully";
    }


    public function admin_manage_client_card_send_on(Request $request)
    {
         $uid = Auth::id();

        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $image = $request->img;
        $now = $request->sendon;
        $user_banner = DB::table('affiliate_banner')->first();
        foreach($mails as $malto){
            $values = array(
                'email'             => $malto,
                'subject'           => $subject,
                'image'             => $image,
                'message'           => $message,
                'date'              => $now,
                'status'            => "pending",
                'user_banner'       => $user_banner->preview,
                'uid'               => $uid,
                'created_at'        => date('Y-m-d')
            );
            DB::table('manage_client_card_email')->insert($values);
        }
        $datee = date('d F Y', strtotime($now));
        $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client Card Email Send";
        addUserActivity($subject,'add',$notification,$message);
        echo "Email will be sent on ".$datee;
    }
    public function admin_manage_client_card_send_with_reminder(Request $request)
    {
        $uid = Auth::id();
        $uemail=admin_email();
        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $image = $request->img;
        $now = date('Y-m-d');
        $time1 = date("H:i");
        $time = date("H:i", strtotime('+'.$request->reminderdate.' hours', strtotime($time1)));
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        foreach($mails as $malto){
            $values = array(
                'email'             => $malto,
                'subject'           => $subject,
                'image'             => $image,
                'message'           => $message,
                'date'              => $now,
                'time'              => $time,
                'status'            => "sent",
                'user_banner'       => $user_banner->preview,
                'uid'               => $uid,
                'created_at'        => date('Y-m-d')
            );
            DB::table('manage_client_card_email')->insert($values);
            $SendCard = SendCard::create([
                'email'             => $malto,
                'subject'           => $subject,
                'image'             => $image,
                'message'           => $message,
                'date'              => $now,
                'status'            => "pending",
                'user_banner'       => $user_banner->preview,
                'time'              => $time,
                'uid'               => $uid,
                'time_diff'         => $request->reminderdate,
                'times'             => $request->remindertimes,
            ]);
        }
        $datee = date('d F Y', strtotime($now));
          $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client Card Email Send";
        addUserActivity($subject,'add',$notification,$message);
        echo "Email will be sent.";
    }

    public function admin_manage_client_video_submit(Request $request)
    {
        $uid = Auth::id();
      $uemail=admin_email();
        $mails = explode(',', $request->malto);
        // print_r($mails); die();
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $now = date('Y-m-d');
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        $file = $request->file('video');
        $filenames = explode('.', $file->getClientOriginalName());
        $filename = $filenames[0];
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $destinationPath = 'public/videos';
        if($file->move($destinationPath,$fileNameToStore))
        {
            $urll = url('/');
            $paath = $urll."/public/videos/";
            $img_path = $paath.$fileNameToStore;
            foreach($mails as $malto){
                $values = array(
                    'email'             => $malto,
                    'subject'           => $subject,
                    'video'             => $fileNameToStore,
                    'message'           => $message,
                    'date'              => $now,
                    'status'            => "sent",
                    'user_banner'       => $user_banner->preview,
                    'uid'               => $uid,
                    'created_at'        => date('Y-m-d')
                );
                DB::table('manage_client_video_email')->insert($values);
                $emaildetails = array(
                    'malto'             => $malto,
                    'subject'           => $subject,
                    'body'              => $message,
                    'user_banner'       => $user_banner->preview,
                );
                Mail::send('manage_client_video_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                     $message->to($malto)
                     ->subject($subject);
                     $message->attach($img_path);
                     $message->from('support@mafama.com', Auth::user()->name);
                  });
                User::where('email', Auth::user()->email)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
            }
        $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client  Email Send";
        addUserActivity($subject,'add',$notification,$message);
            echo "Email has been sent succesfully";
        }
        else{
            echo "Something went wrong!!!";
        }
    }
    public function admin_manage_client_video_send_on(Request $request)
    {
        $uid = Auth::id();
        $uemail=admin_email();
        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $now = $request->sendon;
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        $file = $request->file('video');
        $filenames = explode('.', $file->getClientOriginalName());
        $filename = $filenames[0];
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $destinationPath = 'public/videos';
        if($file->move($destinationPath,$fileNameToStore))
        {
            foreach($mails as $malto){
                $values = array(
                    'email'             => $malto,
                    'subject'           => $subject,
                    'video'             => $fileNameToStore,
                    'message'           => $message,
                    'date'              => $now,
                    'status'            => "pending",
                    'user_banner'       => $user_banner->preview,
                    'uid'               => $uid,
                    'created_at'        => date('Y-m-d')
                );
                DB::table('manage_client_video_email')->insert($values);
            }
            $datee = date('d F Y', strtotime($now));
         $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client  Email Send";
        addUserActivity($subject,'add',$notification,$message);
            echo "Email will be sent on ".$datee;
        }
        else{
            echo "Something went wrong !!!";
        }
    }
    public function admin_manage_client_video_send_with_reminder(Request $request)
    {
       $uid = Auth::id();
        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $image = $request->img;
        $now = date('Y-m-d');
        $time1 = date("H:i");
        $time = date("H:i", strtotime('+'.$request->reminderdate.' hours', strtotime($time1)));
        $user_banner = DB::table('affiliate_banner')->first();
        $file = $request->file('video');
        $filenames = explode('.', $file->getClientOriginalName());
        $filename = $filenames[0];
        $extension = $file->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $destinationPath = 'public/videos';
        if($file->move($destinationPath,$fileNameToStore))
        {
            foreach($mails as $malto){
                $values = array(
                    'email'             => $malto,
                    'subject'           => $subject,
                    'video'             => $fileNameToStore,
                    'message'           => $message,
                    'date'              => $now,
                    'time'              => $time,
                    'status'            => "sent",
                    'user_banner'       => $user_banner->preview,
                    'uid'               => $uid,
                    'created_at'        => date('Y-m-d')
                );
                DB::table('manage_client_video_email')->insert($values);
                $SendVideo = SendVideo::create([
                    'email'             => $malto,
                    'subject'           => $subject,
                    'image'             => $fileNameToStore,
                    'backhground'       => "",
                    'message'           => $message,
                    'date'              => $now,
                    'status'            => "pending",
                    'user_banner'       => $user_banner->preview,
                    'time'              => $time,
                    'uid'               => $uid,
                    'time_diff'         => $request->reminderdate,
                    'times'             => $request->remindertimes,
                ]);
            }
            $datee = date('d F Y', strtotime($now));
            $notification  = getNotificationMessage(41);
            $message = $notification;
           $subject = "Client  Email Send";
           addUserActivity($subject,'add',$notification,$message);
            echo "Email will be sent.";
        }
        else{
            echo "Something went wrong !!!";
        }
    }

    public function admin_manage_client_send_with_reminder(Request $request){
        $uid = Auth::id();
        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $bakg = $request->bakg;
        $now = date('Y-m-d');
        $time1 = date("H:i");
        $time = date("H:i", strtotime('+'.$request->reminderdate.' hours', strtotime($time1)));
        $user_banner = DB::table('affiliate_banner')->first();
        foreach($mails as $malto){

            $values = array(
                'email'             => $malto,
                'subject'           => $subject,
                'background'        => $bakg,
                'message'           => $message,
                'date'              => $now,
                'time'              => $time,
                'status'            => "sent",
                'user_banner'       => $user_banner->preview,
                'uid'               => $uid,
                'created_at'        => date('Y-m-d')
            );
            DB::table('manage_client_email')->insert($values);
            $SendEmail = SendEmail::create([
                    'email'             => $malto,
                    'subject'           => $subject,
                    'image'             => "",
                    'backhground'       => $bakg,
                    'message'           => $message,
                    'date'              => $now,
                    'campaign_name'     => "",
                    'status'            => "pending",
                    'user_banner'       => $user_banner->preview,
                    'time'              => $time,
                    'uid'               => $uid,
                    'time_diff'         => $request->reminderdate,
                    'times'             => $request->remindertimes,
                ]);
        }
        $datee = date('d F Y', strtotime($now));
         $notification  = getNotificationMessage(41);
        $message = $notification;
        $subject = "Client Email Send";
        addUserActivity($subject,'add',$notification,$message);
        echo "Email will be sent.";
    }

    public function get_checked_mobile(Request $request){
      $id = explode(',', $request->mail_arr);
      $mail_arr = [];
      $q1 = AffiliateRegistration::query();
      $q2 = BusinessRegister::query();
      $data1=$q1->whereIn('affiliate_registrations.id',$id)->get();
      $data2=$q2->where('business_registers.id',$id)->get();
      if($data1->count()>0){
        $ClientAppointmentList=$data1;
      }
      if($data2->count()>0){
        $ClientAppointmentList=$data2;
      }
      foreach ($ClientAppointmentList as $value) {
        array_push($mail_arr, $value->cellphone);
      }
      return $mail_arr;
    }

    public function get_checked_box_mobile(Request $request){
      $id = explode(',', $request->mail_arr);
      $mail_arr = [];
      $q1 = AffiliateRegistration::query();
      $q2 = BusinessRegister::query();
      $data1=$q1->whereIn('affiliate_registrations.id',$id)->get();
      $data2=$q2->where('business_registers.id',$id)->get();
      if($data1->count()>0){
        $ClientAppointmentList=$data1;
      }
      if($data2->count()>0){
        $ClientAppointmentList=$data2;
      }
      foreach ($ClientAppointmentList as $value) {
        array_push($mail_arr, $value->cellphone);
      }
      return $mail_arr;
    }

    public function admin_send_sms(Request $request){
      $uid = Auth::id();
      $uemail = admin_email();
      $phones = explode(',', $request->malto);
      $submit_value = $request->submit_value;
      $message = $request->message;
      $now = date('Y-m-d');
      $fileNameToStore = "";
      $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
      $videoid = '';
      $fileNameToStore = '';
      foreach($phones as $phone_no){
        $SendSms = SendSms::create([
            'phone_no'             => $phone_no,
            'image'             => $fileNameToStore,
            'backhground'       => "",
            'message'           => $message,
            'date'              => $now,
            'greeting'          => $request->greeting,
            'forecolorr'        => $request->forecolorr,
            'status'            => "sent",
            'user_banner'       => $user_banner->preview,
            'uid'               => $uid
        ]);
        $videoid = DB::getPdo()->lastInsertId();
      }
/*
        foreach($mails as $malto){
            $username = "";
            $userdet = DB::table('contacts')->where('email', $malto)->get();
            if(count($userdet) > 0){
                $username = $userdet[0]->first_name." ".$userdet[0]->last_name;
            }
            $emaildetails = array(
                'malto'             => $malto,
                'subject'           => $subject,
                'bakg'              => $bakg,
                'campaign_name'     => "",
                'body'              => $message,
                'username'          => $username,
                'greetings'         => $request->greeting,
                'forecolorr'        => $request->forecolorr,
                'user_banner'       => $user_banner->preview
            );
            Mail::send('email_campaign_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->attach($img_path);
                 $message->from('support@mafama.com', Auth::user()->name);
              });
              User::where('email', Auth::user()->email)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
        }  */
       $notification  = getNotificationMessage(42);
        $message = $notification;
        $subject = "SMS Send";
        addUserActivity($subject,'add',$notification,$message);
         echo "Message sent succesfully";
    }

    public function admin_send_sms_send_on(Request $request){
      $uid = Auth::id();
      $uemail = admin_email();
      $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $bakg = $request->bakg;
        $now = date('Y-m-d', strtotime($request->sendon));
        $fileNameToStore = "";
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        // $script = explode('public/images/', $request->script_path);
        // $script_img = $script[1];
            $fileNameToStore ='';
            foreach($mails as $malto){
                $SendSms = SendSms::create([
                    'phone_no'             => $malto,
                    'subject'           => $subject,
                    'image'             => $fileNameToStore,
                    'backhground'       => $bakg,
                    'message'           => $message,
                    'date'              => $now,
                    'greeting'          => $request->greeting,
                    'forecolorr'        => $request->forecolorr,
                    'status'            => "pending",
                    'user_banner'       => $user_banner->preview,
                    'uid'               => $uid
                ]);
                $videoid = DB::getPdo()->lastInsertId();
            // DB::table('email_campaigns')->where('id', $videoid)->update(['status' => 'sent']);
            }
        $notification  = getNotificationMessage(42);
        $message = $notification;
        $subject = "SMS SEND ";
        addUserActivity($subject,'add',$notification,$message);
        echo "SMS will be sent on ".$now;
    }

    public function send_sms_with_reminder(Request $request){
      $uid = Auth::id();
      $uemail = admin_email();
      $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $bakg = "";
        $now = date('Y-m-d');
        $time1 = date("H:i");
        $time = date("H:i", strtotime('+'.$request->reminderdate.' hours', strtotime($time1)));
        $fileNameToStore = "";
        $user_banner = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->first();
        // $script = explode('public/images/', $request->script_path);
        // $script_img = $script[1];
            foreach($mails as $malto){
                $SendSms = SendSms::create([
                    'phone_no'             => $malto,
                    'subject'           => $subject,
                    'image'             => $fileNameToStore,
                    'backhground'       => $bakg,
                    'message'           => $message,
                    'date'              => $now,
                    'greeting'          => $request->greeting,
                    'forecolorr'        => $request->forecolorr,
                    'status'            => "pending",
                    'user_banner'       => $user_banner->preview,
                    'time'              => $time,
                    'uid'               => $uid,
                    'time_diff'         => $request->reminderdate,
                    'times'             => $request->remindertimes,
                ]);
                $videoid = DB::getPdo()->lastInsertId();
            // DB::table('email_campaigns')->where('id', $videoid)->update(['status' => 'sent']);
            }
        $notification  = getNotificationMessage(42);
        $message = $notification;
        $subject = "SMS SEND ";
        addUserActivity($subject,'add',$notification,$message);
        echo "SMS will be sent on ".$now." at ".$request->remindertime;
    }


    // marina
    // software developer Ravi coding start 
 public function country_status_setting($id="")
    {
        // if(permission_access('country_status_setting_view')!=1)
        //    {
        //       echo '<center class="text-center">
        //         <h1>Access Denied!</h1>
        //         </center>';
        //          die();
        //    }
      $data['id']=$id;
      if(!empty($id)){
        $data['result']=DB::table('country_status_setting')->whereId($id)->first();
      }
        $data['settings']=DB::table('country_status_setting')->get();
         $data['c_user_id'] = Auth::user()->id ?:'';
        $data['non_country'] = DB::table('option_meta')->where('key','country_of_residense_admin_message')->first();
        // \LogActivity::addToLog('visited general setting','view',$data);
        return view('admin.country_status_setting',$data);
    }
    
    public function add_country_status_setting(Request $request){
      $status=isset($request->status)?1:0;
      $billing_status=isset($request->billing_status)?1:0;
      $country=$request->country;
      $affiliate_commission=$request->affiliate_commission;
      $deduct_amount=$request->deduct_amount;
      $data=[
        "country"=>$country,
        "status"=>$status,
        "billing_status"=>$billing_status,
        "affiliate_commission"=>$affiliate_commission,
        "deduct_amount"=>$deduct_amount,
      ];
      // print_r($data);die;
      if(empty($request->id)){
        $q=DB::table('country_status_setting')->where('country',$country)->first();
        if(empty($q)){
          $query=DB::table('country_status_setting')->insert($data);
          Session::flash('success', "Success!");
          return redirect()->back()->with('status',"Setting added successfully");
        }else{
          Session::flash('error', "Error!");
          return redirect('country-status-setting')->with('status',"Setting already exist");
        }
      }else{
        $q=DB::table('country_status_setting')->where('id','!=',$request->id)->where('country',$country)->first();
        if(empty($q)){
          $query=DB::table('country_status_setting')->whereId($request->id)->update($data);
          Session::flash('success', "Success!");
          return redirect('country-status-setting')->with('status',"Setting updated successfully");
        }else{
          Session::flash('error', "Error!");
          return redirect()->back()->with('status',"Setting already exist");
        }
      }
      
    }
    public function add_country_status_setting_message(Request $request){
      if(!isset($request->id)){
           return redirect('country-status-setting')->with('status',"User Not Login.");
      }
      
      
      if(empty($request->id)){
        
        return redirect('country-status-setting')->with('status',"User Not Login.");
      }else{
         $message=$request->non_country_user_message;

          $q=DB::table('option_meta')->where('key','country_of_residense_admin_message')->first();
          
          if(empty($q)){
               $q=DB::table('option_meta')->insert(['user_id'=>$request->id,'key'=>'country_of_residense_admin_message','value'=>$message]);
          }else{
               $q=DB::table('option_meta')->where('key','country_of_residense_admin_message')->update(['value'=>$message]);
          }
          return redirect('country-status-setting')->with('status',"Update successfully.");
        
      }
      
    }
public function deduct_affiliate_commission(){
        $query=DB::table("users")
        ->select("users.id as user_id","affiliate_registrations.country")
        ->join("affiliate_registrations","affiliate_registrations.email",'users.email')
        ->get();
        $message="";
        if(!empty($query)){
            $count=0;
           foreach ($query as $user){
            $country_setting=!empty(getCountrySetting($user->country))?getCountrySetting($user->country)->country:"";
            $affiliate_commission=!empty(getCountrySetting($user->country))?getCountrySetting($user->country)->affiliate_commission:0;
            $deduct_amount=!empty(getCountrySetting($user->country))?getCountrySetting($user->country)->deduct_amount:0;

            if(!empty($country_setting) && $user->country==$country_setting){
                $user_id=$user->user_id;



                $users=DB::table('mlm_transactions')->where("transaction_type","deduct_affiliate_commission")->where("user_id",$user_id)->whereMonth('created_at',date('m'))->whereYear('created_at',date('Y'))->first();
                    $current_month_earning=getCurrentMonthEarning($user_id);

                    if(empty($users)){
                        if($current_month_earning>0){
                        if($current_month_earning>=$affiliate_commission){
                            $user_balance_query=Balance_info::where("user_id",$user_id)->first();
                            
                            if(!empty($user_balance_query)){
                                $user_balance=$user_balance_query->amount;
                                if($user_balance>=$affiliate_commission){
                                
                                $user_deduct_amount=$user_balance-$deduct_amount;
                                 $query=Balance_info::where("user_id",$user_id)->update(array("amount"=>$user_deduct_amount));
                                 $data=[
                                    "user_id"=>$user_id,
                                    "amount"=>$deduct_amount,
                                    "description"=>"Monthly affiliate commission deduct",
                                    "status"=>1,
                                    "table_name"=>"Balance_infos",
                                    "transaction_type"=>"deduct_affiliate_commission"
                                ];
                                $transaction_query=Mlm_transaction::create($data);

                                $admin_balance=getAdminBalance()+$deduct_amount;

                                Balance_info::where("user_id",1)->update(array("amount"=>$admin_balance));

                                

                                $admindata=[
                                    "user_id"=>1,
                                    "amount"=>$deduct_amount,
                                    "description"=>"affiliate commission",
                                    "status"=>1,
                                    "table_name"=>"Balance_infos",
                            
                                ];
                                $transaction_query=Mlm_transaction::create($admindata);
                                 if($transaction_query){
                                    $message="Cron excuted successfully";
                                }
                            }else{
                                $message="User balance is less than affiliate commission";
                            }
                        }


                        }else{
                            $message="User current month income is less than affiliate commission";
                        }
                        }else{
                        $message="User current month income is 0";                            
                         }
                    }else{
                        $message="Commission deducted of current month";
                    }
                }
                else{
                    $message="No country setting";
                }
            }
        }
        else{
            $message="No user releted to the country setting";
        }
    // }else{
    //     $message="Today is not a last day of month";
    // }
        return redirect()->back()->with("status",$message);
    
    }

        // software developer Ravi coding end 

    
    
}
