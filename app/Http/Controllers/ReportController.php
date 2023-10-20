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
use App\IntroVideo;
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
use App\SendEmail;
use App\Contacts;
use App\UploadPopup1;
use App\UploadPopup2;
use App\ClientTemplateCategory;
use App\FinancialTemplateCategory;
use App\UploadClientTemplate;
use App\UploadFinancialTemplate;
use App\AffiliateRegistration;
use App\PromotionCondition;
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
use App\Chat;
use App\Level_income;
use App\Network;
use App\Bonus_income;
use App\DailyAccessMonitoring;
use App\BasketRotationSetting;
use App\BasketCondition;
use App\AssignUser;
use App\SendCard;
use App\SendVideo;

use Excel;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class ReportController extends Controller
{
 public function get_genealogy_users(Request $request){
        $html = "";
        $status = false;
         $da=$request->all();
         $level=$da['level'];
         $rank_id=$da['rank_id'];
         $year=$da['year'];
         $month=$da['month'];
         $country=$da['country'];
         if($rank_id==0){
          $users=get_genealogy_users_by_paid_level($level,$year,$month,$country);
         }else{
          $users=get_genealogy_users_by_level($level,$rank_id,$year,$month,$country);
         }
       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }


public function get_genealogy_user_monthly(Request $request){
        $html = "";
        $status = false;
         $da=$request->all();
         $rank_id=$da['rank_id'];
         $year=$da['year'];
         $month=$da['month'];
         $country=$da['country'];
         if($rank_id==0){
          $users=get_genealogy_users_monthly($month,$rank_id,$year,$country);
         }else{
          $users=get_genealogy_users_monthly($month,$rank_id,$year,$country);
         }
       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }

    public function get_genealogy_user_quaterly(Request $request){
        $html = "";
        $status = false;
         $da=$request->all();
         $rank_id=$da['rank_id'];
         $start_date=$da['start_date'];
         $end_date=$da['end_date'];
         // $year=$da['year'];
         $month=$da['month'];
         $country=$da['country'];
         
          $users=getGenealogyUserQuaterly($rank_id,$start_date,$end_date,$month,$country);

       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }

    public function get_yearly_member(Request $request){
        // $plan_id="",$level="",$year="",$month="",$country=""
        $html = "";
        $status = false;
         $da=$request->all();
         $plan_id=$da['plan_id'];
         $level=$da['level'];
         $year=$da['year'];
         $country=$da['country'];
         $users=getYearlyMember($plan_id,$level,$year,$country);


       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }

public function get_monthly_member(Request $request){
        // month="",plan_id="",year="",country=""
        $html = "";
        $status = false;
         $da=$request->all();
         $plan_id=$da['plan_id'];
         $month=$da['month'];
         $year=$da['year'];
         $country=$da['country'];
         $users=get_monthly_member($plan_id,$month,$year,$country);


       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }

    public function get_quarterly_member(Request $request){
        // month="",plan_id="",year="",country=""
        $html = "";
        $status = false;
         $da=$request->all();
         $plan_id=$da['plan_id'];
         $start_date=$da['start_date'];
         $end_date=$da['end_date'];
         // $year=$da['year'];
         $country=$da['country'];
         $users=getquarterly_member($plan_id,$start_date,$end_date,$country);


       $html="";
       ob_start();
       if($users->count()>0)
       {
        $status=true;
        foreach($users as $user)
        {
       ?>
      <tr class="nk-tb-item">
         <td class="nk-tb-col">
            <span><?=$user->name;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->email;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->company;?> </span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->level;?></span>
         </td>
         <td class="nk-tb-col">
            <span><?=$user->cellphone;?></span>
         </td>
         <td class="nk-tb-col tb-col-md">
            <div class="custom-control custom-control-sm custom-checkbox notext">
               <input type="checkbox" class="custom-control-input checkboxes" value="<?= $user->id;?>" name="uid<?=$user->id;?>" id="uid<?=$user->id;?>">
               <label class="custom-control-label" for="uid<?=$user->id;?>"></label>
            </div>
         </td>
      </tr>

       <?php
       }
       }

       $html=ob_get_clean();

       echo json_encode(array(
        "valid"=>$status,
        "html" => $html

    ));

    }


public function get_genealogy_total_user(Request $request){

         $da=$request->all();
         $rank_id=$da['rank_id'];
         $year=$da['year'];
          $month=$da['month'];
         $country=$da['country'];
         if($rank_id==0){
          $data['users']=get_genealogy_users_by_paid_level('',$year,$month,$country);
         }else{
          $data['users']=get_genealogy_users_by_level('',$rank_id,$year,$month,$country);
         }
         $data['category'] = CardCategory::orderBy('category','desc')->get();
         $data['cards'] = UploadCard::groupBy('category')->get();

        return view('admin.report.get_genealogy_users_report',$data);
    }







public function manage_client_submit(Request $request)
    {

            $uid = Auth::id();

        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $bakg = $request->bakg;
        $now = date('Y-m-d');
        $user_banner = DB::table('affiliate_banner')->first();
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


    public function manage_client_send_with_reminder(Request $request)
    {

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




public function admin_user_banner_details(Request $request)
    {

         $user_banner = DB::table('affiliate_banner')->first();
         echo $user_banner->preview;
    }



 public function manage_client_send_on(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
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



public function get_checked_email(Request $request){

        $id = explode(',', $request->mail_arr);
        $mail_arr = [];
        $users = User::whereIn('id', $id)->get();
        foreach ($users as $value) {
            array_push($mail_arr, $value->email);
        }
        return $mail_arr;
    }


public function un_checked_email(Request $request)
    {
        $id = $request->id;
        $ClientAppointmentList = User::where('id', $id)->first();
        echo $email = $ClientAppointmentList->email;
    }


  public function unchecked_email_boxes(Request $request)
    {

        $id = $request->id;
        $email = User::where('id', $id)->get();
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

public function admin_emmail_prev_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());

        $subject = $request->id;
        $det = DB::table('email_campaigns')->where('subject', $subject)->first();
        $details  = DB::table('email_campaigns')->where('subject', $subject)->where('created_at', $det->created_at)->orderBy('id', 'desc')->get();
        return $details;
    }

public function admin_title_wise_email(Request $request)
{
    $emails = explode(',', $request->email);
    $contacts = Contacts::whereIn('email', $emails)->where('status', 1)->get();
        foreach ($contacts as $valuee) {
            echo '<div class="col-md-12 padding-0">
                    <label class="checkbox chk-sm">
                        <input type="checkbox" value="'.$valuee->id.'" class="contact_mail" />
                        <i></i> '.$valuee->first_name.' '.$valuee->last_name.'
                    </label>
                </div>';
           }
 }
 public function manage_client_card_send_with_reminder(Request $request)
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


 public function manage_client_card_send_on(Request $request)
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


 public function manage_client_card_submit(Request $request)
    {

            $uid = Auth::id();


        $mails = explode(',', $request->malto);
        // print_r($mails); die();
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $image = $request->img;
        $now = date('Y-m-d');
        $user_banner = DB::table('affiliate_banner')->first();
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
public function manage_client_video_submit(Request $request)
    {

        $uid = Auth::id();
        $mails = explode(',', $request->malto);
        // print_r($mails); die();
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $now = date('Y-m-d');
        $user_banner = DB::table('affiliate_banner')->first();
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
    public function manage_client_video_send_on(Request $request)
    {

         $uid = Auth::id();
        $mails = explode(',', $request->malto);
        $subject = $request->subject;
        $submit_value = $request->submit_value;
        $message = $request->message;
        $now = $request->sendon;
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
    public function manage_client_video_send_with_reminder(Request $request)
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




public  function get_genealogyfilter_data(Request $request)
{
    $html='';


   $country=$request->country;
   $year=$request->year;
   $month=$request->month;
   $total_paid=0;

       $data['ranks']=PromotionCondition::orderBy('id','asc')->get();
       $data['plans']=Plan::orderBy('id','desc')->get();
       $date=$year.'-'.$month.'-01';
        //$date=date('d',strtotime($date));
        $data['year']=$year;
        $data['month']=$month;
        $data['date']=$date;
        $data['country ']=$country;
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

        return view('admin.report.genealogy_report_view',$data);

  }








}
