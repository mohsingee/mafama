<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\AffiliateRegistration;
use App\BusinessRegister;
use DB;
use Auth;
use App\SendSms;
use App\SendEmail;
use Twilio\Rest\Client;
use App\HomeVideo;
use App\HomeTopVideo;
use App\HomeMainVideo;
use App\Menulinks;
use App\EmailManagementBanner;
use App\Folders;

class SendSmsEmailController extends Controller
{
    public function search_by_personal_info(Request $request){
    	$name=$request->name;
    	$email=$request->email;
    	$mobile=$request->mobile;
    	$religious=$request->religious;

    	$q1=BusinessRegister::query();
    	$q2=AffiliateRegistration::query();

    	$thisquery1=['business_registers.first_name' => "%{$name}%", 'business_registers.email' => $email, 'business_registers.religion' => $religious];
    	$thosequery1=['business_registers.cellphone' => $mobile, 'business_registers.business_telephone' => $mobile];

    	$thisquery2=['affiliate_registrations.first_name' => "%{$name}%", 'affiliate_registrations.email' => $email, 'affiliate_registrations.religion' => $religious];

    	$thosequery2=['affiliate_registrations.cellphone' => $mobile, 'affiliate_registrations.business_telephone' => $mobile];


    	$r1=$q1->where($thisquery1)->orWhere($thosequery1);
    	$r2=$q2->where($thisquery2)->orWhere($thosequery2);

    	if($r1){
    		$result=$r1->join('users','users.email','=','business_registers.email')->get();
    	}
    	if($r2){
    		$result=$r2->join('users','users.email','=','affiliate_registrations.email')->get();
    	}
    	ob_start();
    	$html=ob_get_clean();
    	?>

    	<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false" id="sample_editable_1">
    		<thead>
    			<tr class="nk-tb-item nk-tb-head">
    				<th class="nk-tb-col"><span class="sub-text">Name</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Email</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Company</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Level</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Phone</span></th>
    				<th class="nk-tb-col table-checkbox">
    					<input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" /> 
    				</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php if($result->count()>0){
    				foreach($result as $value){ ?>
    				<tr class="nk-tb-item">
    					<td class="nk-tb-col">
    						<span><?=$value->name?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->email?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->company?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->level?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?php if($value->cellphone==$mobile){ echo $value->cellphone;}else{ echo $value->business_telephone; } ?></span>
    					</td>
    					<td class="nk-tb-col">
    						<input type="checkbox" class="checkboxes" value="<?= $value->id;?>" />
    					</td>

    					
    				</tr><!-- .nk-tb-item  -->
    			<?php }}else{
    				?>
    				<tr><td></td><td></td><td></td><td>No data found</td></tr>
    				<?php
    			} ?>
			</tbody>
    	</table>
    	<?php
    	echo $html;
    }

    public function search_by(Request $request)
    {
    	$rank=$request->rank;
    	$plan = $request->plan;
    	$country=$request->country;
    	$state=$request->state;
    	$city=$request->city;
    	$zipcode=$request->zipcode;
    	$business_category=$request->business_category;
    	$level=$request->level;

    	$q1=BusinessRegister::query();
    	$q2=AffiliateRegistration::query();

    	$r1=$q1->where('business_registers.country',$country)->where('business_registers.state',$state)->where('business_registers.city',$city)->where('business_registers.zip_code',$zipcode)->where('business_registers.business_category',$business_category);
    	$r2=$q2->where('affiliate_registrations.country',$country)->where('affiliate_registrations.state',$state)->where('affiliate_registrations.city',$city)->where('affiliate_registrations.zip_code',$zipcode)->where('affiliate_registrations.business_category',$business_category)->where('users.level',$level)->whereIn('users.plan_id', $plan);
    		
    		if($r1){
    			$result=$r1->join('users','users.email','=','business_registers.email')->get();
    		}
    		if($r2){
    			$result=$r2->join('users','users.email','=','affiliate_registrations.email')->get();
    		}

    	ob_start();
    	$html=ob_get_clean();
    	?>

    	<table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false" id="sample_editable_1">
    		<thead>
    			<tr class="nk-tb-item nk-tb-head">
    				<th class="nk-tb-col"><span class="sub-text">Name</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Email</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Company</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Level</span></th>
    				<th class="nk-tb-col"><span class="sub-text">Phone</span></th>
    				<th class="nk-tb-col table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" /> 
                    </th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php if($result->count()>0){
    				foreach($result as $value){ ?>
    				<tr class="nk-tb-item">
    					<td class="nk-tb-col">
    						<span><?=$value->name?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->email?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->company?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->level?></span>
    					</td>
    					<td class="nk-tb-col">
    						<span><?=$value->cellphone;?></span>
    					</td>
    					<td class="nk-tb-col">
    						<input type="checkbox" class="checkboxes" value="<?= $value->id;?>" />
    					</td>
    				</tr><!-- .nk-tb-item  -->
    			<?php }}else{
    				?>
    				<tr><td></td><td></td><td></td><td>No data found</td></tr>
    				<?php
    			} ?>
			</tbody>
    	</table>
    	<?php
    	echo $html;
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
      try {  
                    $account_sid = env("TWILIO_SID");
                    $auth_token = env("TWILIO_TOKEN");
                    $twilio_number = env("TWILIO_FROM");
          
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create("+91 ".$phone_no."", [
                        'from' => $twilio_number, 
                        'body' => $message]);
          
                  //  dd('SMS Sent Successfully.');
          
                } catch (Exception $e) {
                   // dd("Error: ". $e->getMessage());
                }
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
                try {  
                    $account_sid = env("TWILIO_SID");
                    $auth_token = env("TWILIO_TOKEN");
                    $twilio_number = env("TWILIO_FROM");
          
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create("+91 ".$malto."", [
                        'from' => $twilio_number, 
                        'body' => $message]);
          
                  //  dd('SMS Sent Successfully.');
          
                } catch (Exception $e) {
                   // dd("Error: ". $e->getMessage());
                }
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
                try {  
                    $account_sid = env("TWILIO_SID");
                    $auth_token = env("TWILIO_TOKEN");
                    $twilio_number = env("TWILIO_FROM");
          
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create("+91 ".$phone_no."", [
                        'from' => $twilio_number, 
                        'body' => $message]);
          
                  //  dd('SMS Sent Successfully.');
          
                } catch (Exception $e) {
                   // dd("Error: ". $e->getMessage());
                }
            // DB::table('email_campaigns')->where('id', $videoid)->update(['status' => 'sent']);
            }
        $notification  = getNotificationMessage(42);
        $message = $notification;
        $subject = "SMS SEND ";
        addUserActivity($subject,'add',$notification,$message);
        echo "SMS will be sent on ".$now." at ".$request->remindertime;
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

    public function view_email(Request $request){
        $data['title']="View Email";
        $id=$request->id;
        $data['usersms']="";
        $user_id=Auth::id();
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['useremail']=SendEmail::where('email',$id)->where('uid',$user_id)->get();
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners'] = EmailManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['chat'] = "";
        $data['tools'] = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat'] = "on";
            }
            else{
                $data['chat'] = "off";
            }
            if($cdet->tools == "on"){
                $data['tools'] = "on";
            }
            else{
                $data['tools'] = "off";
            }
        }
        return view('view_email',$data);
    }
    public function view_sms(Request $request){
        $data['title']="View SMS";
        $id=$request->id;
        $data['useremail']="";
        $user_id=Auth::id();
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['usersms']=SendSms::where('email',$id)->where('uid',$user_id)->get();
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners'] = EmailManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['chat'] = "";
        $data['tools'] = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat'] = "on";
            }
            else{
                $data['chat'] = "off";
            }
            if($cdet->tools == "on"){
                $data['tools'] = "on";
            }
            else{
                $data['tools'] = "off";
            }
        }
        return view('view_email',$data);
    }
    

}
