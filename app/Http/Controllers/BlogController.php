<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\TopBanner;
use App\TextBanner;
use App\SettingBanner;
use App\AppointmentBanner;
use App\ClientManagementBanner;
use App\EmailManagementBanner;
use App\FinancialManagementBanner;
use App\ArchivesBanner;
use App\HomeVideo;
use App\HomeTopVideo;
use App\HomeMainVideo;
use App\Menulinks;
use App\PhotoSlides;
use App\ActivePlan;
use App\SettingTutorial;
use App\AppointmentTutorial;
use App\ClientTutorial;
use App\EmailTutorial;
use App\FinanceTutorial;
use App\ArchiveTutorial;
use App\TermsCondition;
use App\Archives;
use App\IntroVideo;
use App\Setting;
use App\LibraryForm;
use App\Chat;
use Session;
use Auth;
use App\User_invite;
use App\AffiliateRegistration;
use App\TempAffiliateRegistration;
use App\Payment as Transactionhistory;
use Carbon\Carbon;
use DateTime;
use App\Mail\RegistrationMail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Levels;
use App\ClientAppointmentList;
use App\Religion;
use App\CardCategory;
use App\ScriptCategory;
use App\BusinessCategory;
use App\LeadsCategory;
use App\UploadCard;
use App\UploadScript;
use App\UploadBusiness;
use App\UploadLeads;
use App\Mail\SendCardMail;
use App\BusinessRegister;
use App\EmailCampaign;
use App\SendCard;
use App\SendVideo;
use App\SendSms;
use App\SendEmail;
use App\Folders;
use App\Contacts;
use App\Mlm_transaction;
use App\FinancialInvoiceSetup;
use App\Notification;
use Charts;
use App\ClientReport;
use App\ClientDiagnosticReport;
use App\ClientRecommendation;
use App\ClientMedication;
use App\Http\Requests;
use Twilio\Rest\Client;
use Validator;
use URL;
use Redirect;
use App\Comune;


class BlogController extends Controller
{


  public function index(){
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
         if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
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
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        //print_r($data['invoice_setup']);die();
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
        $data['blogs']=DB::table('blogs')->orderBy('id','DESC')->get();
        return view('blog',$data);
  }


  public function blog_detail($id){
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
         if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
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
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        //print_r($data['invoice_setup']);die();
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
        $data['blog']=DB::table('blogs')->where('id',$id)->first();
        return view('blog_detail',$data);
  }
}

