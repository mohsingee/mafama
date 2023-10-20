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
     ob_start();

   $country=$request->country;
   $year=$request->year;
   $month=$request->month;
   $total_paid=0;

     ?>
        <div class="tab-pane active" id="tabItem11">
          <div class=" heading-dotted margin-bottom-10 text-center">
             <h5>Yearly Genealogy</h5>
          </div>
          <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
             <thead>
                <tr  class="nk-tb-item nk-tb-head">
                   <th class="nk-tb-col"><span class="sub-text">Name</th>
                   <?php
                   for($i=1;$i<=6;$i++){
                     ?>

                   <th class="nk-tb-col"><span class="sub-text">Level <?=$i++;?> </th>
                   <?php } ?>
                   <th class="nk-tb-col"><span class="sub-text">Total </th>
                </tr>
             </thead>
             <tbody>
                <tr class="nk-tb-item">
                   <td class="nk-tb-col">
                      <span>Affiliates (Paid)</span>
                   </td>
                 <?php
                   for($i=1;$i<=6;$i++)
                  {
                   $paid=getPaidAffiliates($i,$year,$month,$country);
                   $total_paid +=$paid;
                    ?>
                   <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(0,<?=$i;?>,<?=$year;?>,<?=$month;?>,<?=$country;?>)">
                      <span><?=$paid;?></span>
                   </td>
                   <?php } ?>
                   <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(0,<?=$year;?>,<?=$month;?>,<?=$country;?>)">
                      <span><?=$total_paid;?></span>
                   </td>
                </tr>
                <?php
                $total=0;
                $total=$total_paid;
                $array=array();

                foreach($ranks as $rank)
                    { ?>
                <tr class="nk-tb-item">
                   <td class="nk-tb-col">
                      <span>{{$rank->assign_position}}</span>
                   </td>
                   <?php
                   $m_sub=0;

                   for($i=1;$i<=6;$i++)
                   {
                   $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
                   $m_sub += $mTotal;
                   $total +=$mTotal;
                   ?>
                   <td class="nk-tb-col" onclick="getYearlyGenealogybylevel(<?=$rank->id;?>,<?=$i;?>,<?=$year;?>,<?=$month;?>,<?=$country;?>)">
                      <span><?=$mTotal;?></span>
                   </td>
                   <?php } ?>
                   <td class="nk-tb-col" onclick="getYearlyGenealogyRecord(<?=$rank->id;?>,<?=$year;?>,<?=$month;?>,<?=$country;?>)">
                      <span><?=$m_sub;?></span>
                   </td>
                </tr>
                <!-- .nk-tb-item  -->
                <?php } ?>
                <tr class="nk-tb-item tr-border-red">
                   <td class="nk-tb-col">
                      <span>Total</span>
                   </td>
                   <?php
                   for($i=1;$i<=6;$i++)
                   {
                   $paid=getPaidAffiliates($i,$year,$month,$country);
                   $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
                   $tolal_sub=$paid+$tot;
                   ?>
                   <td class="nk-tb-col">
                      <span><?=$tolal_sub;?></span>
                   </td>
                   <?php } ?>
                   <td class="nk-tb-col">
                      <span><?=$total;?></span>
                   </td>
                </tr>
                <!-- .nk-tb-item  -->
             </tbody>
          </table>
       </div>
                           <div class="tab-pane" id="tabItem21">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Affiliates Monthly Genealogy</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Rank</span></th>
                                       <?php
                                       foreach(getMonthsName() as $m){
                                        ?>
                                       <th class="nk-tb-col"><span class="sub-text"><= date("M", mktime(0, 0, 0, $m, 10)) ;?></span></th>
                                       <?php } ?>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       <?php
                                       $year=date('Y');
                                       $total_paid=0;

                                       foreach(getMonthsName() as $month)
                                       {
                                       $paid=getPaidAffiliatesMonthly($month,$year,$country);
                                       $total_paid +=$paid;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$paid;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$total_paid;?></span>
                                       </td>
                                    </tr>
                                    <?php
                                    $total=0;
                                    $total=$total_paid;
                                    $array=array();

                                    foreach($ranks as $rank){ ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$rank->assign_position;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;
                                       foreach(getMonthsName() as $month)
                                       {
                                       $mTotal=getGeanologyUserMonthly($month,$rank->id,$year,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                        ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <?php } ?>
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       <?php
                                       foreach(getMonthsName() as $month)
                                       {
                                       $paid=getPaidAffiliatesMonthly($month,$year,$country);
                                       $tot=getGeanologyUserMonthlyTotal($month,$year,$country);
                                       $tolal_sub=$paid+$tot;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col tb-col-md">
                                          <span><?=$total;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem31">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Affiliates Quarterly Genealogy</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Rank/Quarterly</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       <?php

                                       $total_paid=0;
                                       foreach($quarters as $qtr)
                                       {
                                       $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $total_paid +=$paid;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$paid;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$total_paid;?></span>
                                       </td>
                                    </tr>
                                    <?php
                                    $total=0;
                                    $total=$total_paid;
                                    $array=array();

                                    foreach($ranks as $rank)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$rank->assign_position;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       foreach($quarters as $qtr)
                                       {

                                       $mTotal=getGeanologyUserQuarterly($qtr['start_date'],$qtr['end_date'],$rank->id);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <?php } ?>
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       <?php
                                       foreach($quarters as $qtr)
                                       {
                                       $paid=getPaidAffiliatesQuarterly($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tot=getGeanologyUserQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tolal_sub=$paid+$tot;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col tb-col-md">
                                          <span><?=$total;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem4">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 >Yearly Members</h5>
                              </div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead  class="thead-light">
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Name</th>
                                       <?php for($i=1;$i<=6;$i++){ ?>
                                       <th class="nk-tb-col"><span class="sub-text">Level <?=$i;?> </th>
                                       <?php } ?>
                                       <th class="nk-tb-col"><span class="sub-text">Total </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $total=0;
                                    $array=array();

                                    foreach($plans as $plan)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$plan->name;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       for($i=1;$i<=6;$i++)
                                       {
                                       $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <?php } ?>
                                    <tr class="nk-tb-item tr-border-red">
                                       <td class="nk-tb-col">
                                          <spa;?>Total</span>
                                       </td>
                                       <?php for($i=1;$i<=6;$i++){

                                       $tot=getMemberUserYearlyTotal($i,$year,$month,$country);
                                       $tolal_sub=$tot;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$total;?></span>
                                       </td>
                                    </tr>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem5">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 > Monthly Members</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Plan</span></th>
                                       <?php
                                       foreach(getMonthsName() as $m){ ?>
                                       <th class="nk-tb-col"><span class="sub-text"><?= date("M", mktime(0, 0, 0, $m, 10)) ;?></span></th>
                                       <?php } ?>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $total=0;
                                    $array=array();

                                    foreach($plans as $plan)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$plan->name;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       foreach(getMonthsName() as $month)
                                       {
                                       $mTotal=getMemberMonthly($month,$plan->id,$year,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                      <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <?php } ?>
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       <?php
                                       foreach(getMonthsName() as $month)
                                       {
                                       $tot=getMemberMonthlyTotal($month,$year,$country);
                                       $tolal_sub=$tot;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col tb-col-md">
                                          <span><?=$total;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane" id="tabItem6">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5 > Quarterly Members</h5>
                              </div>
                              <div class="row" style="margin-bottom:20px;"></div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Plan/Quarterly</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jan-Mar</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Apr-Jun</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Jul-Sep</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Oct-Dec</span></th>
                                       <th class="nk-tb-col"><span class="sub-text">Total</span></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $total=0;
                                    $array=array();

                                    foreach($plans as $plan)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$plan->name;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       foreach($quarters as $qtr)
                                       {
                                       $mTotal=getMemberQuarterly($qtr['start_date'],$qtr['end_date'],$plan->id,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                    <?php } ?>
                                    <tr class="nk-tb-item">
                                       <th class="nk-tb-col">
                                          <span>Total</span>
                                       </th>
                                       <?php
                                       foreach($quarters as $qtr)
                                       {
                                       $tot=getMemberQuarterlyTotal($qtr['start_date'],$qtr['end_date'],$month,$country);
                                       $tolal_sub=$tot;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col tb-col-md">
                                          <span><?=$total;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                 </tbody>
                              </table>
                           </div>
                           <div class="tab-pane " id="tabItem7">
                              <div class=" heading-dotted margin-bottom-10 text-center">
                                 <h5>Network Total</h5>
                              </div>
                              <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                 <thead>
                                    <tr  class="nk-tb-item nk-tb-head">
                                       <th class="nk-tb-col"><span class="sub-text">Name</th>
                                       <?php for($i=1;$i<=6;$i++){ ?>
                                       <th class="nk-tb-col"><span class="sub-text">Level <?=$i;?> </th>
                                       <?php } ?>
                                       <th class="nk-tb-col"><span class="sub-text">Total </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>Affiliates (Paid)</span>
                                       </td>
                                       <?php
                                       $year=date('Y');
                                       $total_paid=0;

                                       for($i=1;$i<=6;$i++)
                                       {
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $total_paid +=$paid;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$paid;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$total_paid;?></span>
                                       </td>
                                    </tr>
                                    <?php

                                    foreach($ranks as $rank)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span>{{$rank->assign_position}}</span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       for($i=1;$i<=6;$i++)
                                      {
                                       $mTotal=getGeanologyUserYearly($i,$rank->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                   <?php } ?>
                                    <?php
                                    foreach($plans as $plan)
                                        { ?>
                                    <tr class="nk-tb-item">
                                       <td class="nk-tb-col">
                                          <span><?=$plan->name;?></span>
                                       </td>
                                       <?php
                                       $m_sub=0;

                                       for($i=1;$i<=6;$i++)
                                       {
                                       $mTotal=getMemberUserYearly($i,$plan->id,$year,$month,$country);
                                       $m_sub += $mTotal;
                                       $total +=$mTotal;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$mTotal;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$m_sub;?></span>
                                       </td>
                                    </tr>
                                    <!-- .nk-tb-item  -->
                                     <?php } ?>
                                    <tr class="nk-tb-item tr-border-red" >
                                       <td class="nk-tb-col">
                                          <span>Total</span>
                                       </td>
                                       <?php
                                       $net_pay=0;

                                       for($i=1;$i<=6;$i++)
                                       {
                                       $paid=getPaidAffiliates($i,$year,$month,$country);
                                       $mem=getMemberUserYearlyTotal($i,$year,$month,$country);
                                       $tot=getGeanologyUserYearlyTotal($i,$year,$month,$country);
                                       $tolal_sub=$paid+$tot+$mem;
                                       $net_pay +=$tolal_sub;
                                       ?>
                                       <td class="nk-tb-col">
                                          <span><?=$tolal_sub;?></span>
                                       </td>
                                       <?php } ?>
                                       <td class="nk-tb-col">
                                          <span><?=$net_pay;?></span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
    <?php
     $html=ob_get_clean();
    echo $html;
}








}
