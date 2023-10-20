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
use App\SettingTutorial;
use App\AppointmentTutorial;
use App\ClientTutorial;
use App\EmailTutorial;
use App\FinanceTutorial;
use App\ArchiveTutorial;
use App\TermsCondition;
use App\Archives;
use App\ActivePlan;
use App\LibraryForm;
use App\Setting;
use App\Network;
use App\Balance_info;
use Session;
use Auth;
use App\User_invite;
use App\AffiliateRegistration;
use App\TempAffiliateRegistration;
use App\Plan;
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
use App\LevelEarning;
use App\Mlm_transaction;
use App\FinancialInvoiceSetup;
use App\Notification;
use App\LogActivity;
use App\FinancialTemplateCategory;
use App\Bonus_income;
use App\BonusReward;
use App\PrizeReward;
use App\OtherReward;
use App\BonusPoolPrice;
use App\Bonus_condition;
use App\Prize_condition;
use App\OtherCondition;
use App\DailyAccessMonitoring;
use App\AccessMonitoring;
use Charts;
use File;
use App\Http\Requests;
use Validator;
use URL;
use Redirect;
use App\ClientReport;
use App\ClientDiagnosticReport;
use App\ClientRecommendation;
use App\ClientMedication;
use App\ClientTask;
use App\StatusReport;
use App\LabTest;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use App\Comune;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
      // private $_api_context;
    private $_api_context;
    public function __construct()
    {
         $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }
    public function appointment_login()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        return view('main.appointment_login')->with($data);
    }
    public function user_register()
    {
         $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        return view('main.user_register')->with($data);
    }
    public function register_user(Request $request)
    {
        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    public function user_appointment_step1()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step1')->with($data);
    }
    public function user_appointment_step2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $religion = $request->religion;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $zipcode = $request->zipcode;
        Session::put('religion', $religion);
        Session::put('country', $country);
        Session::put('state', $state);
        Session::put('city', $city);
        Session::put('zipcode', $zipcode);
        return redirect('user_appointment_step2_detail');
    }
    public function user_appointment_step2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $religion = Session::get('religion');
        $country = Session::get('country');
        $state = Session::get('state');
        $city = Session::get('city');
        $zipcode = Session::get('zipcode');
        $data['clients'] = "";
        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['clients2'] = "";
        $data['users'] = "";
        if(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip_code', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::get();
            $data['affiliates'] = AffiliateRegistration::get();
            $data['users'] = DB::table('user_access_role')->get();
            $data['clients2'] = ClientAppointmentList::get();
            $data['searchf'] = "Search for ".$religion;
        }
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step2')->with($data);
    }
    public function user_appointment_stepp2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company = $request->company;
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('company', $company);
        if(($first_name == "") && ($last_name == "") && ($company == "")){
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Enter Details.");
        }
        return redirect('user_appointment_stepp2_detail');
    }
    public function user_appointment_stepp2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $first_name = Session::get('first_name');
        $last_name = Session::get('last_name');
        $company = Session::get('company');

        $data['clients'] = "";
        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['clients2'] = "";
        $data['users'] = "";
        if(($first_name != "") && ($last_name != "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name == "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = "";
            $data['users'] = "";
            $data['clients2'] = ClientAppointmentList::where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$last_name;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$company;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name;
        }
        elseif(($first_name != "") && ($last_name != "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name;
        }

        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step2')->with($data);
    }
    public function user_appointment_steppp2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $category = $request->category;
        Session::put('category', $category);
        return redirect('user_appointment_steppp2_detail');
    }
    public function user_appointment_steppp2_detail()
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $category = Session::get('category');
        $data['clients'] = ClientAppointmentList::select('client_appointment_lists.first_name as first_name', 'client_appointment_lists.last_name as last_name', 'client_appointment_lists.email as email', 'client_appointment_lists.company as company', 'client_appointment_lists.address as address', 'client_appointment_lists.state as state','client_appointment_lists.country as country', 'client_appointment_lists.zip_code as zip', 'client_appointment_lists.city as city', 'client_appointment_lists.cell_phone as phone', 'client_appointment_lists.image as image')
                ->join('users', 'users.id', '=', 'client_appointment_lists.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $data['affiliates'] = AffiliateRegistration::where('business_category', $category)->get();
        $data['clients2'] = ClientAppointmentList::select('client_appointment_lists.first_name as first_name', 'client_appointment_lists.last_name as last_name', 'client_appointment_lists.email as email', 'client_appointment_lists.company as company', 'client_appointment_lists.address as address', 'client_appointment_lists.state as state','client_appointment_lists.country as country', 'client_appointment_lists.zip_code as zip', 'client_appointment_lists.city as city', 'client_appointment_lists.cell_phone as phone', 'client_appointment_lists.image as image')
                ->join('users', 'users.id', '=', 'client_appointment_lists.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $data['users'] = DB::table('user_access_role')
                ->join('users', 'users.id', '=', 'user_access_role.sponsor_id')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $category_name = BusinessCategory::where('id', $category)->first();
        $data['searchf'] = "Search for ".$category_name->category;
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step2')->with($data);
    }
    public function user_appointment_step3(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['id'] = base64_decode($request->id);
        $client = User::where('email', $data['id'])->first();
        // $afft = User::where('id', $client->uid)->first();
        $uemail = base64_decode($request->id);
        Session::put('affid', $client->id);
        Session::put('affemail', $uemail);
        $data['appointment_settings_day'] = DB::table('appointment_settings')->where('uemail',$uemail)->first();
        $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step3')->with($data);
    }
    public function user_appointment_step4_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        if($request->app_date == ""){
            return redirect()->back()->with('status',"Please select a date and time slot.");
        }
        if($request->slot == ""){
            return redirect()->back()->with('status',"Please select a time slot.");
        }
        Session::put('appointment_date', $request->app_date);
        Session::put('appointment_time', $request->slot);
        Session::put('appointment_reason', $request->reason);
        Session::put('appointment_id', Auth::id());
        return redirect('user_appointment_step4');
    }
    public function user_appointment_step4()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_date'] = Session::get('appointment_date');
        $data['appointment_time'] = Session::get('appointment_time');
        $data['appointment_reason'] = Session::get('appointment_reason');
        $data['appointment_id'] = Session::get('appointment_id');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step4')->with($data);
    }
    public function user_appointment_step5()
    {
        $uemail = Session::get('affemail');
        $uid = Session::get('affid');
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['folders'] = Folders::where('uid', $uid)->orWhere('uid', "default")->get();
        $data['contacts'] = Contacts::where('uid', $uid)->get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        $changeappointmentid = Session::get('changeappointmentid');
        if($changeappointmentid != ""){
            return redirect('user_confirm_appointment');
        }
        else{
            return view('main.user_appointment_step5')->with($data);
        }
    }
    public function user_appointment_additional(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        Session::put('additional_comment', $request->additional_comment);
        Session::put('name1', $request->name1);
        Session::put('name2', $request->name2);
        Session::put('name3', $request->name3);
        Session::put('email1', $request->email1);
        Session::put('email2', $request->email2);
        Session::put('email3', $request->email3);
        return redirect('user_confirm_appointment');
    }
    public function user_confirm_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_date'] = Session::get('appointment_date');
        $data['appointment_time'] = Session::get('appointment_time');
        $data['appointment_reason'] = Session::get('appointment_reason');
        $data['appointment_id'] = Session::get('appointment_id');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_confirm_appointment')->with($data);
    }
    public function user_final_appointment()
    {
        $uemail = Session::get('affemail');
        $uid = Session::get('affid');
        $changeappointmentid = Session::get('changeappointmentid');
        if($changeappointmentid == ""){
            $slot = DB::table('appointment_settings')->where('uemail', $uemail)->first();
            $start = Session::get('appointment_time');
            $end = date("H:i", strtotime('+'.$slot->receive_time.' minutes', strtotime($start)));

            $usr = DB::table('user_front')->where('email', Auth::user()->email)->first();
            $clint = ClientAppointmentList::where('email', Auth::user()->email)->where('uid', Session::get('affid'))->get();
            if(count($clint) <= 0){
                ClientAppointmentList::create([
                    'first_name'            => $usr->first_name,
                    'last_name'             => $usr->last_name,
                    'password'              => $usr->password,
                    'email'                 => $usr->email,
                    'cell_phone'            => $usr->phone,
                    'uid'                   => Session::get('affid')
                ]);
            }
            $values = array(
                'appointment_id' => DB::getPdo()->lastInsertId(),
                'appointment_date' => date('Y-m-d', strtotime(Session::get('appointment_date'))),
                'appointment_time' => Session::get('appointment_time'),
                'appointment_end' => $end,
                'appointment_reason' => Session::get('appointment_reason'),
                'additional_comment' => Session::get('additional_comment'),
                'name1' => Session::get('name1'),
                'name2' => Session::get('name2'),
                'name3' => Session::get('name3'),
                'email1' => Session::get('email1'),
                'email2' => Session::get('email2'),
                'email3' => Session::get('email3'),
                'uid'   => $uid,
                'temp_user_id' => Auth::id(),
            );
            DB::table('appointments')->insert($values);
        }
        else{
            $slot = DB::table('appointment_settings')->where('uemail', $uemail)->first();
            $start = Session::get('appointment_time');
            $end = date("H:i", strtotime('+'.$slot->receive_time.' minutes', strtotime($start)));
            $values = array(
                'appointment_date' => date('Y-m-d', strtotime(Session::get('appointment_date'))),
                'appointment_time' => Session::get('appointment_time'),
                'appointment_end' => $end,
                'appointment_reason' => Session::get('appointment_reason'),
                'uid'   => $uid
            );
            DB::table('appointments')->where('appointments.cstatus', "on")->where('id', $changeappointmentid)->update($values);
            DB::table('change_appointment')->insert($values);
            Session::put('changeappointmentid', "");
        }
         $notification  = getNotificationMessage(3);
          $message = $notification;
        $subject = "Appointment Booked ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect('user_print_appointment');
    }
    public function user_print_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_id'] = Session::get('appointment_id');
        $data['appointment_date'] = date('d F Y', strtotime(Session::get('appointment_date')));
        $data['appointment_time'] = Session::get('appointment_time');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        $data['chat'] = "off";
        $data['tools'] = "off";
        $data['banner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->first();
        return view('main.user_print_appointment')->with($data);
    }
    public function manage_appointment_client()
    {
        if(Auth::id() == NULL){
            return redirect('login');
        }
        if(Auth::user()->role == "temp_user"){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = ClientManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['clients'] = ClientAppointmentList::where('uid', $uid)->get();
        $data['category'] = CardCategory::orderBy('category','desc')->get();
        $data['cards'] = UploadCard::groupBy('category')->get();
        //print_r($data['top_banners']);die();
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
        return view('main.manage_appointment_client')->with($data);
    }
    public function user_change_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();

        $data['appointments'] = DB::table('appointments')->select('*', 'appointments.id AS aid')->join('client_appointment_lists', 'appointments.appointment_id', 'client_appointment_lists.id')->where('appointments.cstatus', "on")->where('appointments.temp_user_id', Auth::id())->orderBy('appointments.id', 'desc')->get();

        $data['chat'] = "off";
        $data['tools'] = "off";

        return view('main.user_change_appointment')->with($data);
    }
    public static function getappointmentdetailstemp($id)
    {
        $appointment = DB::table('appointments')->where('id', $id)->first();
        $email = User::where('id', $appointment->uid)->first();
        $change_details = DB::table('appointment_settings')->where('uemail', $email->email)->first();
        return $change_details;
    }
    public static function user_change_appointment_view(Request $request)
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $changeappointmentid = $request->id;
        $data['appointments'] = DB::table('appointments')
                ->select('client_appointment_lists.first_name as client_first_name', 'client_appointment_lists.last_name as client_last_name', 'client_appointment_lists.email as client_email', 'client_appointment_lists.company as client_company', 'client_appointment_lists.address as client_address', 'client_appointment_lists.state as client_state','client_appointment_lists.country as client_country', 'client_appointment_lists.zip_code as client_zip', 'client_appointment_lists.city as client_city', 'client_appointment_lists.cell_phone as client_phone', 'appointments.appointment_date as appointment_date', 'appointments.appointment_time as appointment_time', 'appointments.appointment_end as appointment_end', 'appointments.appointment_reason as appointment_reason', 'affiliate_registrations.first_name as affiliate_first_name', 'affiliate_registrations.last_name as affiliate_last_name', 'affiliate_registrations.email as affiliate_email', 'affiliate_registrations.image as affiliate_image', 'affiliate_registrations.cellphone as affiliate_phone', 'affiliate_registrations.address as affiliate_address', 'affiliate_registrations.state as affiliate_state', 'affiliate_registrations.country as affiliate_country', 'affiliate_registrations.city as affiliate_city', 'affiliate_registrations.zip_code as affiliate_zip', 'affiliate_registrations.religion as affiliate_religion', 'affiliate_registrations.business_category as affiliate_category', 'affiliate_registrations.company as affiliate_company')
                ->join('users', 'users.id', '=', 'appointments.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->join('client_appointment_lists', 'appointments.appointment_id', '=', 'client_appointment_lists.id')
                ->where('appointments.id', $changeappointmentid)
                ->where('appointments.cstatus', "on")
                ->first();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_change_appointment_view')->with($data);
    }
    public function user_change_appointment_step(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $changeappointmentid = $request->id;
        Session::put('changeappointmentid', $changeappointmentid);
        $data = DB::table('appointments')
                ->join('users', 'appointments.uid', 'users.id')
                ->join('affiliate_registrations', 'users.email', 'affiliate_registrations.email')
                ->where('appointments.id', $request->id)
                ->where('appointments.cstatus', "on")
                ->first();
        $first_name = $data->first_name;
        $last_name = $data->last_name;
        $company = $data->company;
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('company', $company);
        Session::put('clientid', $data->appointment_id);
        Session::put('aid', $data->uid);
        return redirect('user_appointment_step3');
    }
    public function user_appointment_stepp3()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $clientid = Session::get('aid');
        $id = $clientid;
        // print_r($data['id']);die();
        $client = User::where('id', $id)->first();
        $data['id'] = $client->email;
        // $afft = User::where('id', $client->uid)->first();
        $uemail = $client->email;
        Session::put('affid', $client->id);
        Session::put('affemail', $uemail);
        // $data['appointment_settings_day'] = DB::table('appointment_settings')->where('uemail',$uemail)->first();
        // $client = ClientAppointmentList::where('id', $data['id'])->first();
        // $afft = User::where('id', $client->uid)->first();
        // $uemail = $afft->email;
        $data['appointment_settings_day'] = DB::table('appointment_settings')->where('uemail',$uemail)->first();
        // print_r($data['appointment_settings_day']);die();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_appointment_step3')->with($data);
    }
    public function user_cancel_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointments'] = DB::table('appointments')->select('*', 'appointments.id AS aid')->join('client_appointment_lists', 'appointments.appointment_id', 'client_appointment_lists.id')->where('appointments.temp_user_id', Auth::id())->orderBy('appointments.id', 'desc')->get();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.user_cancel_appointment')->with($data);
    }
    public function user_delete_appointment(Request $request)
    {
        $id = explode('delete', $request->id);
        $det = DB::table('appointments')->where('id', $id[1])->first();
        $values = array(
                'appointment_id' => $det->appointment_id,
                'appointment_date' => $det->appointment_date,
                'appointment_time' => $det->appointment_time,
                'appointment_end' => $det->appointment_end,
                'appointment_reason' => $det->appointment_reason,
                'additional_comment' => $det->additional_comment,
                'name1' => $det->name1,
                'name2' => $det->name2,
                'name3' => $det->name3,
                'email1' => $det->email1,
                'email2' => $det->email2,
                'email3' => $det->email3,
                'cancel_reason' => $request->delete_reason,
                'uid'   => $det->uid
            );
        $values2 = array('cstatus'  => "off");
        DB::table('cancel_appointment')->insert($values);
        DB::table('appointments')->where('appointments.cstatus', "on")->where('id', $id[1])->update($values2);
    }
    public function affiliate_dashboard()
    {
        if(Auth::id() == NULL){
            return redirect('login');
        }
        if(Auth::user()->role == "temp_user"){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
            return redirect('/home')->with('status',"Admin can't access this page.");
        }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $uemail = "";
        if((Auth::user()->role) == "affiliate"){
            $uemail = Auth::user()->email;
        }
        else{
            $uemail = Auth::user()->affiliate_user_email;
        }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        // print_r($data['top_banners']);die();
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
        $today = date('m-d');
        $data['birthdays'] = ClientAppointmentList::where('dob', 'like', '%' .$today. '%')->where('uid', $uid)->get();
        $data['meeting_task'] = DB::table('meeting_task')->where('affiliate_id', $uid)->where('date', date('Y-m-d'))->get();
        // $data['appointments'] = DB::table('appointments')->where('uid', $uid)->where('appointment_date', date('Y-m-d'))->get();
        $data['appointments'] = DB::table('appointments')
                ->select('client_appointment_lists.first_name as client_first_name', 'client_appointment_lists.last_name as client_last_name', 'client_appointment_lists.email as client_email', 'client_appointment_lists.company as client_company', 'client_appointment_lists.address as client_address', 'client_appointment_lists.state as client_state','client_appointment_lists.country as client_country', 'client_appointment_lists.zip_code as client_zip', 'client_appointment_lists.city as client_city', 'client_appointment_lists.cell_phone as client_phone', 'appointments.appointment_date as appointment_date', 'appointments.appointment_time as appointment_time', 'appointments.appointment_end as appointment_end', 'appointments.appointment_reason as appointment_reason', 'affiliate_registrations.first_name as affiliate_first_name', 'affiliate_registrations.last_name as affiliate_last_name', 'affiliate_registrations.email as affiliate_email', 'affiliate_registrations.image as affiliate_image', 'affiliate_registrations.cellphone as affiliate_phone', 'affiliate_registrations.address as affiliate_address', 'affiliate_registrations.state as affiliate_state', 'affiliate_registrations.country as affiliate_country', 'affiliate_registrations.city as affiliate_city', 'affiliate_registrations.zip_code as affiliate_zip', 'affiliate_registrations.religion as affiliate_religion', 'affiliate_registrations.business_category as affiliate_category')
                ->join('users', 'users.id', '=', 'appointments.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->join('client_appointment_lists', 'appointments.appointment_id', '=', 'client_appointment_lists.id')
                ->where('appointments.uid', $uid)
                ->where('appointments.cstatus', "on")
                ->where('appointments.appointment_date', date('Y-m-d'))
                ->get();
        $data['clients'] = DB::table('client_appointment_lists')->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('uid', $uid)->get();
        $data['email_campaigns'] = DB::table('email_campaigns')->where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_emails'] = SendEmail::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_cards'] = SendCard::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_videos'] = SendVideo::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_sms'] = SendSms::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['revenue_records'] = DB::table('revenue_record')->where('transaction_date', date('Y-m-d'))->where('uid', $uid)->get();
        $data['expense_records'] = DB::table('expense_record')->where('transaction_date', date('Y-m-d'))->where('uid', $uid)->get();

        return view('affiliate_dashboard')->with($data);
    }
    public function front_dashboard()
    {
        if(Auth::id() == NULL){
            return redirect('login');
        }
        if(Auth::user()->role == "temp_user"){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
            return redirect('/home')->with('status',"Admin can't access this page.");
        }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $uemail = "";
        if((Auth::user()->role) == "affiliate"){
            $uemail = Auth::user()->email;
        }
        else{
            $uemail = Auth::user()->affiliate_user_email;
        }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        // print_r($data['top_banners']);die();
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
        $today = date('m-d');
        $data['birthdays'] = ClientAppointmentList::where('dob', 'like', '%' .$today. '%')->where('uid', $uid)->get();
        $data['meeting_task'] = DB::table('meeting_task')->where('affiliate_id', $uid)->where('date', date('Y-m-d'))->get();
        // $data['appointments'] = DB::table('appointments')->where('uid', $uid)->where('appointment_date', date('Y-m-d'))->get();
        $data['appointments'] = DB::table('appointments')
                ->select('client_appointment_lists.first_name as client_first_name', 'client_appointment_lists.last_name as client_last_name', 'client_appointment_lists.email as client_email', 'client_appointment_lists.company as client_company', 'client_appointment_lists.address as client_address', 'client_appointment_lists.state as client_state','client_appointment_lists.country as client_country', 'client_appointment_lists.zip_code as client_zip', 'client_appointment_lists.city as client_city', 'client_appointment_lists.cell_phone as client_phone', 'appointments.appointment_date as appointment_date', 'appointments.appointment_time as appointment_time', 'appointments.appointment_end as appointment_end', 'appointments.appointment_reason as appointment_reason', 'affiliate_registrations.first_name as affiliate_first_name', 'affiliate_registrations.last_name as affiliate_last_name', 'affiliate_registrations.email as affiliate_email', 'affiliate_registrations.image as affiliate_image', 'affiliate_registrations.cellphone as affiliate_phone', 'affiliate_registrations.address as affiliate_address', 'affiliate_registrations.state as affiliate_state', 'affiliate_registrations.country as affiliate_country', 'affiliate_registrations.city as affiliate_city', 'affiliate_registrations.zip_code as affiliate_zip', 'affiliate_registrations.religion as affiliate_religion', 'affiliate_registrations.business_category as affiliate_category')
                ->join('users', 'users.id', '=', 'appointments.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->join('client_appointment_lists', 'appointments.appointment_id', '=', 'client_appointment_lists.id')
                ->where('appointments.uid', $uid)
                ->where('appointments.cstatus', "on")
                ->where('appointments.appointment_date', date('Y-m-d'))
                ->get();

        $data['clients'] = DB::table('client_appointment_lists')->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('uid', $uid)->get();

        $data['email_campaigns'] = DB::table('email_campaigns')->where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_emails'] = SendEmail::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_cards'] = SendCard::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_videos'] = SendVideo::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['send_sms'] = SendSms::where('uid', $uid)->where('created_at', 'like', '%' .date('Y-m-d'). '%')->where('status', "sent")->get();
        $data['revenue_records'] = DB::table('revenue_record')->where('transaction_date', date('Y-m-d'))->where('uid', $uid)->get();
        $data['expense_records'] = DB::table('expense_record')->where('transaction_date', date('Y-m-d'))->where('uid', $uid)->get();
        $data['total_revenue'] = DB::table('revenue_record')->whereMonth('transaction_date', '=', date('m'))->whereYear('transaction_date', '=', date('Y'))->where('uid', $uid)->sum('bill');
        $data['total_expense'] = DB::table('expense_record')->whereMonth('transaction_date', '=', date('m'))->whereYear('transaction_date', '=', date('Y'))->where('uid', $uid)->sum('total');
        $data['total_appointment'] = DB::table('appointments')->whereMonth('appointment_date', '=', date('m'))->whereYear('appointment_date', '=', date('Y'))->where('uid', $uid)->where('appointments.cstatus', "on")->count();
        $email1 = DB::table('email_campaigns')->where('uid', $uid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('status', "sent")->count();
        $email2 = SendEmail::where('uid', $uid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('status', "sent")->count();
        $email3 = SendCard::where('uid', $uid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('status', "sent")->count();
        $email4 = SendVideo::where('uid', $uid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('status', "sent")->count();
        $email5 = SendSms::where('uid', $uid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->where('status', "sent")->count();
        $data['totalemail'] = $email1+$email2+$email3+$email4+$email5;
        $fromDate = Carbon::now()->startOfWeek()->toDateString();
        $tillDate = Carbon::now()->endOfWeek()->toDateString();
        // print_r(Carbon::now()->startOfWeek());

        $i=0;
        $data['weeklycnt'] = [];
        $data['weeklychangeappointment'] = [];
        $data['weeklycancelappointment'] = [];
        do
        {
            // echo $fromDate;
            $countweek = DB::table('expense_record')->whereDate('transaction_date', $fromDate)->where('uid', $uid)->count();
            $countweek2 = DB::table('change_appointment')->whereDate('created_at', $fromDate)->where('uid', $uid)->count();
            $countweek3 = DB::table('cancel_appointment')->whereDate('created_at', $fromDate)->where('uid', $uid)->count();
            array_push($data['weeklycnt'], $countweek);
            array_push($data['weeklychangeappointment'], $countweek2);
            array_push($data['weeklycancelappointment'], $countweek3);
            $fromDate=date('Y-m-d', strtotime(date("Y-m-d", strtotime($fromDate))."+1 day"));
        }while($fromDate <= $tillDate);
        $fromMonth = "01";
        $tillMonth = "13";
        $data['monthlyrevenue'] = [];
        $data['monthlyexpense'] = [];
        $data['monthlyclient'] = [];
        $data['monthlyappointment'] = [];
        $data['monthlycancelappointment'] = [];
        $data['monthlychangeappointment'] = [];
        do{
            $monthlyrev = DB::table('revenue_record')->whereMonth('transaction_date', $fromMonth)->whereYear('transaction_date',date('Y'))->where('uid', $uid)->count();
            $monthlyexp = DB::table('expense_record')->whereMonth('transaction_date', $fromMonth)->whereYear('transaction_date',date('Y'))->where('uid', $uid)->count();
            $monthlyclient = DB::table('client_appointment_lists')->whereMonth('created_at', $fromMonth)->whereYear('created_at',date('Y'))->where('uid', $uid)->count();
            $monthlychangeappointment = DB::table('change_appointment')->whereMonth('created_at', $fromMonth)->whereYear('created_at',date('Y'))->where('uid', $uid)->count();
            $monthlycancelappointment = DB::table('cancel_appointment')->whereMonth('created_at', $fromMonth)->whereYear('created_at',date('Y'))->where('uid', $uid)->count();
            $monthlyappointment = DB::table('appointments')->whereMonth('appointment_date', $fromMonth)->whereYear('appointment_date',date('Y'))->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            array_push($data['monthlyrevenue'], $monthlyrev);
            array_push($data['monthlyexpense'], $monthlyexp);
            array_push($data['monthlyclient'], $monthlyclient);
            array_push($data['monthlyappointment'], $monthlyappointment);
            array_push($data['monthlycancelappointment'], $monthlycancelappointment);
            array_push($data['monthlychangeappointment'], $monthlychangeappointment);
            if($fromMonth == "12"){
                break;
            }
            else{
                $month_year = date('Y')."-".$fromMonth;
                $fromMonth=date('m', strtotime(date("Y-m", strtotime($month_year))."+1 month"));
            }
        }while($fromMonth <= $tillMonth);
        // print_r($data['monthlyrevenue']);
        // die();

       $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
       $data["medical_category"]=[6,7,8];
       $af=AffiliateRegistration::where('email',Auth::user()->email)->first();
       $data["business_category"]=$af->business_category;
       $data["role_type"]=$af->type;
       $data["lab_name"]="";
       $bnr=DB::table('affiliate_banner')->where('affiliate_email',Auth::user()->email)->first();
       if(!empty($bnr)){
         $data["lab_name"]=$bnr->business_name;
       }
       //->where('uid', $uid)->whereMonth('created_at', date('m'))
        $data['total_lab_tests'] = DB::table('lab_tests')->where('uid', $uid)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
       $data['total_pharmacy_orders'] = DB::table('pharmacy_details')->whereMonth('created_at', date('m'))->where('uid', $uid)->whereYear('created_at', date('Y'))->count();
      $data['total_medication_orders']=0;
      $medito=DB::table('pharmacy_details')->where('uid', $uid)->whereYear('created_at', date('Y'))->get();
      if($medito->count()>0)
        {
         $m1=$m2=$m3=0;
        foreach($medito as $medi)
          {
             if(!empty($medi->medication1)){
               $m2 =$m2+1;
             }

             if(!empty($medi->medication2)){
               $m1 =$m1+1;
             }
             if(!empty($medi->medication3)){
               $m3 =$m3+1;
             }
          }

        $total_medications=$m1+$m2+$m3;
        $data['total_medication_orders']=$total_medications;
        }
      // $data['total_medication_orders'] = DB::table('pharmacy_details')->whereYear('created_at', date('Y'))->count();
        $data['today_orders'] = DB::table('pharmacy_details')->where('uid', $uid)->whereDate('created_at', Carbon::today())->whereYear('created_at', date('Y'))->count();
        $data["lab_records"]=LabTest::get_all_lab_tests();

        $data['total_client_mgt'] = DB::table('client_appointment_lists')->whereMonth('created_at', date('m'))->where('uid', $uid)->count();

        $data["payments_total1"]=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>Auth::id()])->whereMonth('transaction_date', date('m'))->whereYear('transaction_date', date('Y'))->sum('amount_paid');
        $data["payments_total2"]=DB::table('expense_record')->where(['uid'=>Auth::id()])->whereMonth('transaction_date', date('m'))->whereYear('transaction_date', date('Y'))->sum('amount_paid');

        $data["payments_total"]=$data["payments_total1"];
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>Auth::id()])->whereMonth('transaction_date', date('m'))->whereYear('transaction_date', date('Y'))->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $data["balance_total"]='$'.$bal;

        $data['new_clients'] = DB::table('client_appointment_lists')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('uid', $uid)->count();
        $today1=date('m');
        $data['birthdays_total'] = ClientAppointmentList::where('dob', 'like', '%' .$today1. '%')->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();

        $data['events_total'] = DB::table('meeting_task')->where('affiliate_id', $uid)->whereMonth('date',  date('m'))->count();
        $data["family_total"]=DB::table('contacts')->where('folder',7)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();;
        $data["clients_total"]=DB::table('contacts')->where('folder',9)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();;
        $data["vip_clients"]=DB::table('contacts')->where('folder',10)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();;
        $data["friends"]=DB::table('contacts')->where('folder',8)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();
        $data["basket_1_users"]=DB::table('contacts')->where('folder',13)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();
        $data["basket_2_users"]=DB::table('contacts')->where('folder',12)->whereMonth('created_at', date('m'))->where('uid', Auth::id())->count();

        //$data['bonus_commission']=number_format(Bonus_income::where('user_id',Auth::user()->id)->whereMonth('created_at', date('m'))->sum('amount'),2);
        $data['bonus_commission']=number_format(LevelEarning::where('user_id',Auth::user()->id)->whereMonth('created_at', date('m'))->sum('amount'),2);
        $data['bonus']=number_format(BonusReward::where('user_id',Auth::user()->id)->whereMonth('created_at',  date('m'))->sum('amount'),2);
        $data['prize']=number_format(PrizeReward::where('user_id',Auth::user()->id)->whereMonth('created_at',  date('m'))->sum('amount'),2);
        $data['other']=number_format(OtherReward::where('user_id',Auth::user()->id)->whereMonth('created_at',  date('m'))->sum('amount'),2);

       // $data['ytd_bonus_comm1']=number_format(Bonus_income::where('user_id',Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->sum('amount'),2);
        $data['ytd_bonus_comm1']=number_format(LevelEarning::where('user_id',Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->sum('amount'),2);
        $data['ytd_bonus_comm']= $data['ytd_bonus_comm1'] - $data['bonus_commission'];
        $data['ytd_bonus1']=number_format(BonusReward::where('user_id',Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->sum('amount'),2) ;
        $data['ytd_bonus']=$data['ytd_bonus1'] - $data['bonus'];
        $data['ytd_prize1']=number_format(PrizeReward::where('user_id',Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->sum('amount'),2);
        $data['ytd_prize']= $data['ytd_prize1'] - $data['prize'];
        $data['ytd_other1']=number_format(OtherReward::where('user_id',Auth::user()->id)->whereYear('created_at', Carbon::now()->year)->sum('amount'),2);
        $data['ytd_other']= $data['ytd_other1'] - $data['other'];
        $level=Auth::user()->level;
        $data['level']=$level;


        $lvl=$level;
        if($level>4)
        {
            $lvl=1;
        }else{
            $data['bonus']=0;
        }
       //   echo $lvl;die;
        $data['bonus_pool']=BonusPoolPrice::find($lvl);
        $data['bonus_condition']=Bonus_condition::find($level);
        $data['prize_condition']=Prize_condition::find($level);
        $data['other_condition']=OtherCondition::find($level);
        $user=User::where('id',Auth::user()->id)->first();
        $user_active_days=DailyAccessMonitoring::where('user_id',Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->count();
      //  echo Auth::user()->id;die;
        $points=AccessMonitoring::where('user_id',Auth::user()->id)->whereMonth('updated_at', Carbon::now()->month)->get();

        $earned_points=0;
        if($points->count() >0 ){
            foreach($points as $point)
            {
                 $earned_points +=$point->earned_points;
            }

        }
      // echo $earned_points;die;
        $check=UploadLeads::check_lead_criteria();

    $currentYear = date('Y');
    $cmonth=date('m');
    if($cmonth >=1 && $cmonth < 4)
    {
        $Qstart=Carbon::createMidnightDate($currentYear,1,1);
        $Qend=Carbon::createMidnightDate($currentYear,3,31);
    }
    elseif($cmonth >=4 && $cmonth < 7)
    {
        $Qstart=Carbon::createMidnightDate($currentYear,4,1);
        $Qend=Carbon::createMidnightDate($currentYear,6,30);
    }
    elseif($cmonth >=7 && $cmonth < 10)
    {
        $Qstart=Carbon::createMidnightDate($currentYear,7,1);
        $Qend=Carbon::createMidnightDate($currentYear,9,30);
    }
    elseif($cmonth >=10 && $cmonth < 13)
    {
        $Qstart=Carbon::createMidnightDate($currentYear,10,1);
        $Qend=Carbon::createMidnightDate($currentYear,12,31);
    }

    $active_users= User::where(['sponsor_id'=>Auth::user()->id,'status'=>1])->whereBetween('created_at', [$Qstart, $Qend])->count();


        $require_emails= $check->sending_email;
        $paid_users= $check->paid_users;
        $team_network= $check->team_network;

         $data['needed_emails']=$require_emails;
         $data['needed_total_users']=$team_network;
         $data['user_active_days']=$user_active_days;
         $data['total_users']=$user->team_members;
         $data['earned_points']=$earned_points;
         $data['active_users']=$active_users;
         $data['direct_sponsor']=User::where('sponsor_id',Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->count();
         $data['weather']=getCurrentWeather();
         $data['plan']=Plan::where('id',1)->first();
         $data['share_price']=$data['plan']->affiliate_share_price;
        return view('main.front_dashboard')->with($data);
    }

public function calculator_function()
    {
        if(Auth::id() == NULL){
            return redirect('login');
        }
        // if(Auth::user()->role == "temp_user"){
        //     return redirect('/home')->with('status', "You can't access this page.");
        // }
        // if(Auth::user()->role == "admin"){
        //     return redirect('/home')->with('status',"Admin can't access this page.");
        // }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $uemail = "";
        if((Auth::user()->role) == "affiliate"){
            $uemail = Auth::user()->email;
        }
        else{
            $uemail = Auth::user()->affiliate_user_email;
        }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        // print_r($data['top_banners']);die();
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

      $data['plan']=Plan::where('id',1)->first();

      $data['share_price']=$data['plan']->affiliate_share_price;

        return view('main.calculator')->with($data);
    }




    public function member_appointment_step3(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uemail = "";
        $uid = "";
        $data['id'] = "";
        if(Session::get('changeappointmentid') != ""){
            $appointment = DB::table('appointments')->where('id', Session::get('changeappointmentid'))->first();
            $affiliate = User::where('id', $appointment->uid)->first();
            $data['id'] = $affiliate->email;
        }
        else{
            $data['id'] = base64_decode($request->id);
        }

        Session::put('affemail', $data['id']);
        $users = User::where('email', $data['id'])->first();
        $uid = $users->id;
        $uemail = $users->email;
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', $uemail)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_settings_day'] = DB::table('appointment_settings')->where('uemail',$uemail)->first();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_appointment_step3')->with($data);
    }
    public function member_appointment_step4_details(Request $request)
    {
                //\LogActivity::addToLog('visited profile','view',Auth::user());
        if($request->app_date == ""){
            return redirect()->back()->with('status',"Please select a date and time slot.");
        }
        if($request->slot == ""){
            return redirect()->back()->with('status',"Please select a time slot.");
        }
        $client_id = ClientAppointmentList::where('email', Auth::user()->email)->first();
        Session::put('appointment_date', $request->app_date);
        Session::put('appointment_time', $request->slot);
        Session::put('appointment_reason', $request->reason);
       if(!empty($client_id))
       {
        Session::put('appointment_id', $client_id->id);
       }
        return redirect('member_appointment_step4');
    }
    public function member_appointment_step4()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_date'] = Session::get('appointment_date');
        $data['appointment_time'] = Session::get('appointment_time');
        $data['appointment_reason'] = Session::get('appointment_reason');
        $data['appointment_id'] = Session::get('appointment_id');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_appointment_step4')->with($data);
    }
    public function member_appointment_step5()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['folders'] = Folders::where('uid', Auth::id())->orWhere('uid', "default")->get();
        $data['contacts'] = Contacts::where('uid', Auth::id())->get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        $changeappointmentid = Session::get('changeappointmentid');
        if($changeappointmentid != ""){
            return redirect('member_confirm_appointment');
        }
        else{
            return view('main.member_appointment_step5')->with($data);
        }
    }
    public function member_appointment_additional(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        Session::put('additional_comment', $request->additional_comment);
        Session::put('name1', $request->name1);
        Session::put('name2', $request->name2);
        Session::put('name3', $request->name3);
        Session::put('email1', $request->email1);
        Session::put('email2', $request->email2);
        Session::put('email3', $request->email3);
        return redirect('member_confirm_appointment');
    }
    public function member_confirm_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_date'] = Session::get('appointment_date');
        $data['appointment_time'] = Session::get('appointment_time');
        $data['appointment_reason'] = Session::get('appointment_reason');
        $data['appointment_id'] = Session::get('appointment_id');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_confirm_appointment')->with($data);
    }
    public function member_final_appointment()
    {
        $uemail = Session::get('affemail');
        $userid = User::where('email', $uemail)->first();
        $uid = $userid->id;
        $changeappointmentid = Session::get('changeappointmentid');
        if($changeappointmentid == ""){
            $slot = DB::table('appointment_settings')->where('uemail', $uemail)->first();
            $start = Session::get('appointment_time');
            $end = date("H:i", strtotime('+'.$slot->receive_time.' minutes', strtotime($start)));
            if(Auth::user()->role == "client"){
                $detclt = ClientAppointmentList::where('email', Auth::user()->email)->where('password', Auth::user()->password)->first();
                ClientAppointmentList::create([
                    'first_name'            => $detclt->first_name,
                    'last_name'             => $detclt->last_name,
                    'password'              => $detclt->password,
                    'email'                 => $detclt->email,
                    'cell_phone'            => $detclt->cell_phone,
                    'work_phone'            => $detclt->work_phone,
                    'address'               => $detclt->address,
                    'zip_code'              => $detclt->zip_code,
                    'city'                  => $detclt->city,
                    'state'                 => $detclt->state,
                    'country'               => $detclt->country,
                    'company'               => $detclt->company,
                    'comment'               => $detclt->comment,
                    'dob'                   => $detclt->dob,
                    'religion'              => $detclt->religion,
                    'image'                 => $detclt->image,
                    'uid'                   => $userid->id,
                ]);
            }
            else{
                $detclt = AffiliateRegistration::where('email', Auth::user()->email)->first();
                ClientAppointmentList::create([
                    'first_name'            => $detclt->first_name,
                    'last_name'             => $detclt->last_name,
                    'password'              => $detclt->password,
                    'email'                 => $detclt->email,
                    'cell_phone'            => $detclt->cellphone,
                    'work_phone'            => $detclt->business_telephone,
                    'address'               => $detclt->address,
                    'zip_code'              => $detclt->zip_code,
                    'city'                  => $detclt->city,
                    'state'                 => $detclt->state,
                    'country'               => $detclt->country,
                    'company'               => $detclt->company,
                    'comment'               => "",
                    'dob'                   => "",
                    'religion'              => $detclt->religion,
                    'image'                 => $detclt->image,
                    'uid'                   => $userid->id,
                ]);
                File::copy(public_path('images/affiliates/'.$detclt->image), public_path('assets/images/client/'.$detclt->image));
                User::where('email', $detclt->email)->update(['role2' => 'client']);
            }
            $values = array(
                'appointment_id' => Session::get('appointment_id'),
                'appointment_date' => date('Y-m-d', strtotime(Session::get('appointment_date'))),
                'appointment_time' => Session::get('appointment_time'),
                'appointment_end' => $end,
                'appointment_reason' => Session::get('appointment_reason'),
                'additional_comment' => Session::get('additional_comment'),
                'name1' => Session::get('name1'),
                'name2' => Session::get('name2'),
                'name3' => Session::get('name3'),
                'email1' => Session::get('email1'),
                'email2' => Session::get('email2'),
                'email3' => Session::get('email3'),
                'uid'   => $uid
            );
            DB::table('appointments')->insert($values);
        }
        else{
            $slot = DB::table('appointment_settings')->where('uemail', $uemail)->first();
            $start = Session::get('appointment_time');
            $end = date("H:i", strtotime('+'.$slot->receive_time.' minutes', strtotime($start)));
            $values = array(
                'appointment_id' => Session::get('appointment_id'),
                'appointment_date' => date('Y-m-d', strtotime(Session::get('appointment_date'))),
                'appointment_time' => Session::get('appointment_time'),
                'appointment_end' => $end,
                'appointment_reason' => Session::get('appointment_reason'),
                'uid'   => $uid
            );
            DB::table('appointments')->where('appointments.cstatus', "on")->where('id', $changeappointmentid)->update($values);
            DB::table('change_appointment')->insert($values);
            Session::put('changeappointmentid', "");
        }
         $notification  = getNotificationMessage(4);
         $message = $notification;
        $subject = "Appointment Booked ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect('member_print_appointment');
    }
    public function member_print_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
            $data['bbbanner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['appointment_id'] = Session::get('appointment_id');
        $data['appointment_date'] = date('d F Y', strtotime(Session::get('appointment_date')));
        $data['appointment_time'] = Session::get('appointment_time');
        $data['day'] =  Carbon::parse($data['appointment_date'])->format('l');
        $data['affiliates'] = DB::table('affiliate_registrations')
                ->where('email', Session::get('affemail'))
                ->first();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        $data['banner'] = DB::table('affiliate_banner')->where('affiliate_email', Session::get('affemail'))->first();
        return view('main.member_print_appointment')->with($data);
    }
    public function add_to_client(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $id = $request->id;
        $client = ClientAppointmentList::where('id', $id)->first();
        $ClientAppointmentList = ClientAppointmentList::create([
            'first_name'            => $client->first_name,
            'last_name'             => $client->last_name,
            'password'              => $client->password,
            'email'                 => $client->email,
            'cell_phone'            => $client->cell_phone,
            'home_phone'            => $client->home_phone,
            'work_phone'            => $client->work_phone,
            'address'               => $client->address,
            'zip_code'              => $client->zip_code,
            'city'                  => $client->city,
            'state'                 => $client->state,
            'country'               => $client->country,
            'company'               => $client->company,
            'comment'               => $client->comment,
            'dob'                   => $client->dob,
            'religion'              => $client->religion,
            'image'                 => $client->image,
            'uid'                   => $uid
        ]);
         $notification  = getNotificationMessage(69);
         $message = $notification;
        $subject = "Member Added ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Member added to your client list");
    }
    public function add_to_client2(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $id = $request->id;
        $affiliate = AffiliateRegistration::where('id', $id)->first();
        $ClientAppointmentList = ClientAppointmentList::create([
            'first_name'            => $affiliate->first_name,
            'last_name'             => $affiliate->last_name,
            'password'              => $affiliate->password,
            'email'                 => $affiliate->email,
            'cell_phone'            => $affiliate->cellphone,
            'home_phone'            => "",
            'work_phone'            => $affiliate->business_telephone,
            'address'               => $affiliate->address,
            'zip_code'              => $affiliate->zip_code,
            'city'                  => $affiliate->city,
            'state'                 => $affiliate->state,
            'country'               => $affiliate->country,
            'company'               => "",
            'comment'               => "",
            'dob'                   => "",
            'religion'              => $affiliate->religion,
            'image'                 => $affiliate->image,
            'uid'                   => $uid
        ]);
        File::copy(public_path('images/affiliates/'.$affiliate->image), public_path('assets/images/client/'.$affiliate->image));
        User::where('email', $affiliate->email)->update(['role2' => 'client']);
          $notification  = getNotificationMessage(69);
         $message = $notification;
        $subject = "Member Added ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Member added to your client list");
    }
    public function add_to_client3(Request $request)
    {
         $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $id = $request->id;
        $affiliate = DB::table('user_access_role')->join('users', 'user_access_role.email', 'users.email')->where('user_access_role.id', $id)->first();
        $ClientAppointmentList = ClientAppointmentList::create([
            'first_name'            => $affiliate->first_name,
            'last_name'             => $affiliate->last_name,
            'password'              => $affiliate->password,
            'email'                 => $affiliate->email,
            'cell_phone'            => $affiliate->cellphone,
            'home_phone'            => "",
            'work_phone'            => "",
            'address'               => $affiliate->address,
            'zip_code'              => $affiliate->zip,
            'city'                  => $affiliate->city,
            'state'                 => $affiliate->state,
            'country'               => $affiliate->country,
            'company'               => "",
            'comment'               => "",
            'dob'                   => "",
            'religion'              => $affiliate->religion,
            'image'                 => "",
            'uid'                   => $uid
        ]);
        // File::copy(public_path('images/affiliates/'.$affiliate->image), public_path('assets/images/client/'.$affiliate->image));
        User::where('email', $affiliate->email)->update(['role2' => 'client']);
          $notification  = getNotificationMessage(69);
         $message = $notification;
        $subject = "Member Added ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Member added to your client list");
    }
    public function member_appointment_step1()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_appointment_step1')->with($data);
    }
    public function member_appointment_step2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $religion = $request->religion;
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $zipcode = $request->zipcode;
        Session::put('religion', $religion);
        Session::put('country', $country);
        Session::put('state', $state);
        Session::put('city', $city);
        Session::put('zipcode', $zipcode);
        return redirect('member_appointment_step2_detail');
    }
    public function member_appointment_step2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $religion = Session::get('religion');
        $country = Session::get('country');
        $state = Session::get('state');
        $city = Session::get('city');
        $zipcode = Session::get('zipcode');
        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['users'] = "";
        if(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city]])->get();

            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['affiliates'] = AffiliateRegistration::get();
            $data['users'] = DB::table('user_access_role')->get();
            $data['searchf'] = "Search for ".$religion;
        }
        // print_r($data['clients']);die();

        $data['chat'] = "off";
        $data['tools'] = "off";

        return view('main.member_appointment_step2')->with($data);
    }
    public function member_appointment_stepp2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company = $request->company;
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('company', $company);
        if(($first_name == "") && ($last_name == "") && ($company == "")){
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Enter Details.");
        }
        return redirect('member_appointment_stepp2_detail');
    }
    public function member_appointment_stepp2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $first_name = Session::get('first_name');
        $last_name = Session::get('last_name');
        $company = Session::get('company');

        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['users'] = "";
        if(($first_name != "") && ($last_name != "") && ($company != "")){
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company != "")){
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name == "") && ($company != "")){
             $data['affiliates'] = AffiliateRegistration::where('company', 'like', '%' .$company. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company == "")){
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$last_name;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company == "")){
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$company;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company == "")){
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name;
        }
        elseif(($first_name != "") && ($last_name != "") && ($company == "")){
            $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name;
        }
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_appointment_step2')->with($data);
    }
    public function member_appointment_steppp2(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $category = $request->category;
        Session::put('category', $category);
        return redirect('member_appointment_steppp2_detail');
    }
    public function member_appointment_steppp2_detail(Request $request)
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $category = Session::get('category');
        $data['affiliates'] = AffiliateRegistration::where('business_category', $category)->get();
        $data['users'] = DB::table('user_access_role')
                ->join('users', 'users.id', '=', 'user_access_role.sponsor_id')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $category_name = BusinessCategory::where('id', $category)->first();
        $data['searchf'] = "Search for ".$category_name->category;
        // print_r($data['clients']);die();

        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_appointment_step2')->with($data);
    }
    public function member_change_appointment()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $client = ClientAppointmentList::where('email', Auth::user()->email)->first();
        $data['appointments'] = DB::table('appointments')
                ->select('*', 'appointments.id AS aid')
                ->join('users', 'users.id', '=', 'appointments.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('appointments.cstatus', "on")
                ->where('appointments.appointment_id', $client->id)
                ->orderBy('appointments.id', 'desc')
                ->get();
        // print_r($data['appointments']);die();

        $data['chat'] = "off";
        $data['tools'] = "off";

        return view('main.member_change_appointment')->with($data);
    }
    public function member_change_appointment_view(Request $request)
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $changeappointmentid = $request->id;
        $data['appointments'] = DB::table('appointments')
                ->select('appointments.appointment_date as appointment_date', 'appointments.appointment_time as appointment_time', 'appointments.appointment_end as appointment_end', 'appointments.appointment_reason as appointment_reason', 'affiliate_registrations.first_name as affiliate_first_name', 'affiliate_registrations.last_name as affiliate_last_name', 'affiliate_registrations.email as affiliate_email', 'affiliate_registrations.image as affiliate_image', 'affiliate_registrations.cellphone as affiliate_phone', 'affiliate_registrations.address as affiliate_address', 'affiliate_registrations.state as affiliate_state', 'affiliate_registrations.country as affiliate_country', 'affiliate_registrations.city as affiliate_city', 'affiliate_registrations.zip_code as affiliate_zip', 'affiliate_registrations.religion as affiliate_religion', 'affiliate_registrations.business_category as affiliate_category', 'affiliate_registrations.company as affiliate_company')
                ->join('users', 'users.id', '=', 'appointments.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('appointments.id', $changeappointmentid)
                ->where('appointments.cstatus', "on")
                ->first();
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.member_change_appointment_view')->with($data);
    }
    public function member_appointmentstepdet(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $now = date('Y-m-d');
        $date = $request->currentyear."-".$request->currentmonth."-".$request->date;
        // $date = '2021-02-02';
        $day =  strtolower(Carbon::parse($date)->format('l'));
        $uemail = Session::get('affemail');
        $details = DB::table('appointment_settings')->where('uemail', $uemail)->first();
        // print_r($details);die();
        $blocks = DB::table('block_appointment_date')->where('uemail', $uemail)->get();
        if(strtotime($date) < strtotime($now)){
            echo "prev_day";
        }
        else{
            if($details->$day == "block"){
                echo "blocked_day";
            }
            else{
                $cnt = 0;
                foreach ($blocks as $value) {
                    if(($date >= $value->startdate) && ($date <= $value->enddate)){
                        $cnt++;
                    }
                }
                if($cnt == 0){
                    echo "on";
                }
                else{
                    echo "blocked_day";
                }
            }
        }
        // echo $date;
    }
    public function member_appointment_date_availabilityy(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uemail = Session::get('affemail');
        $main_date = $request->todaysDate;
        $docid = $request->appn_id;
        $day =  strtolower(Carbon::parse($main_date)->format('l'));
        $details = DB::table('appointment_settings')->where('uemail', $uemail)->get();
        if(count($details) > 0){
            $selecteddate = date('Y-m-d', strtotime($request->todaysDate));
            $nowtime = date('H:i', strtotime(now()));
            $today = date('Y-m-d', strtotime(now()));
            // $today = "2021-01-11";
            $seconds = time();
            $rounded_seconds = "";
            $noww = "";
            $slot = $details[0]->receive_time;
            if($slot == 30){
                $rounded_seconds = ceil($seconds / (30 * 60)) * (30 * 60);
                $noww = date('H:i', $rounded_seconds);
            }
            elseif($slot == 60){
                $rounded_seconds = ceil($seconds / (60 * 60)) * (60 * 60);
                $noww = date('H:i', $rounded_seconds);
            }
            $timing = explode(',', $details[0]->$day);
            // $a = explode(':', $timing[0]);
            // $b = explode(':', $timing[1]);
            // $start_time1 = explode(' ', $a[0]);
            // $start_time2 = explode(' ', $a[1]);
            // $finishtime1 = explode(' ', $b[0]);
            // $finishtime2 = explode(' ', $b[1]);
            $availadoctorstart = $timing[0];
            $availadoctorend = $timing[1];
            // die();
            $now = "";
            $endtime = "";
            if ($selecteddate == $today) {
                if($noww >= $availadoctorstart){
                    $now = $noww;
                    $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                }
                else {
                    $now = $availadoctorstart;
                    $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                }
            }
            else{
                $now = $availadoctorstart;
                $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
            }
            $timings = DB::table('appointments')->select(['appointment_time','appointment_end'])->where([['appointment_id', '=', $docid],['appointment_date', '=', $selecteddate]])->where('appointments.cstatus', "on")->orderBy('appointment_time','ASC')->get();
            // echo $now.", ".$endtime;
            $amarr = [];
            $pmarr = [];
            if(count($timings) > 0){
                $len = count($timings);
                $cnt = 1;
                for($i = 0; $i < 50; $i++)
                {
                    if($cnt <50){
                        $flag = 0;
                        $starttime = '';
                        $end = '';
                        $f = 0;
                         $big = 0;
                        foreach($timings as $value){
                            if(($now <= $value->appointment_time) && ($endtime <= $value->appointment_time)) {
                                $starttime = $now;
                                $end = $endtime;
                                if($flag == 0){
                                    $flag++;
                                }
                                elseif($flag == $f){
                                    $flag++;
                                }
                            }
                            else{
                                if(($now >= $value->appointment_end)){
                                    $starttime = $now;
                                    $end = $endtime;
                                    $flag++;
                                }
                                else{
                                    $starttime = $now;
                                    $end = $endtime;
                                }
                            }
                            $f++;
                            // print_r($flag);
                        }
                        // die();
                        // print_r($end);die();
                        if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                            if (($flag == $f)) {
                               if($starttime < date('h:i', strtotime("12:00")) ){
                                $var = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($amarr, $var);

                               }
                               else{
                                $var2 = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($pmarr, $var2);
                               }
                                $cnt++;
                            }
                            $now = date("H:i", strtotime($end));
                            $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                        }
                    }
                }
                // echo $amarr[0]; die();
                if(count($amarr) > 0){
                    echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">AM </label>
                                    </div>
                                    <div class="col-md-11"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($amarr); $x++)
                    {
                        echo $amarr[$x];
                    }
                    echo '</ul></div></div>';
                }
                if(count($pmarr) > 0){
                     echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">PM </label>
                                    </div>
                                    <div class="col-md-11"><div style="border: 1px solid grey; border-radius: 10px; margin-bottom: 10px;"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($pmarr); $x++)
                    {
                        echo $pmarr[$x];
                    }
                    echo '</ul></div></div></div>';
                }
            }
            else{
                for($i=0; $i <= 50; $i++) {
                    $starttime = $now;
                    $end = $endtime;
                    if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                        if ($endtime == "00:00") {
                            break;
                        }
                        if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                            if($starttime < date('h:i', strtotime("12:00")) ){
                                $var = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($amarr, $var);

                               }
                               else{
                                $var2 = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($pmarr, $var2);
                               }
                        }
                        $now = date("H:i", strtotime($end));
                        $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                    }
                }
                if(count($amarr) > 0){
                    echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">AM </label>
                                    </div>
                                    <div class="col-md-11"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($amarr); $x++)
                    {
                        echo $amarr[$x];
                    }
                    echo '</ul></div></div>';
                }
                if(count($pmarr) > 0){
                     echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">PM </label>
                                    </div>
                                    <div class="col-md-11"><div style="border: 1px solid grey; border-radius: 10px; margin-bottom: 10px;"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($pmarr); $x++)
                    {
                        echo $pmarr[$x];
                    }
                    echo '</ul></div></div></div>';
                }
            }
        }
        else{
            echo "Slot is not available";
        }
    }
    public function account_description_amount(Request $request)
    {
        $description = $request->val;
        $account = DB::table('revenue_account')->where('account_name', $description)->first();
        if($account != ""){
            return $account->amount;
        }
        else{
            return "";
        }
    }
    public function account_description_amount2(Request $request)
    {
        $description = $request->val;
        $account = DB::table('expenses_account')->where('account_name', $description)->first();
        return $account->amount;
    }
    public function quarterrevenue_budget_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $revenue = DB::table('revenue_quaterly_budget')->where($month, ">", 0)->whereYear('created_at', date('Y'))->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Revenue Account</th>
                        <th>Budget</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->name.'</td>
                        <td>'.$value->$month.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function quarterrevenue_actual_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $month_year = $year."-".$month;
        $month = $request->month;
        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('account_description', '!=', 'Other Revenue')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                     <th class="table-checkbox">
                            <input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" />
                        </th>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Tax Collected</th>
                        <th>Shipping Charge</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
            <td><input type="checkbox" class="checkboxes" value="'.$value->id.'" /></td>
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function other_revenue_quarterly_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $revenue = DB::table('revenue_budget')->where('name', "Other Revenue")->where($month, ">", 0)->whereYear('created_at', date('Y'))->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Revenue Account</th>
                        <th>Budget</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->name.'</td>
                        <td>'.$value->$month.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function quarterother_revenue_actual_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $month_year = $year."-".$month;
        $month = $request->month;
        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('account_description', 'Other Revenue')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        // $revenue = DB::table('revenue_record')->where('transaction_date', 'like', '%' . $month_year . '%')->where('account_description', 'Other Revenue')->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function quarterly_expense_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $name = $request->name;
        $expense = DB::table('expense_quaterly_budget')->where($month, ">", 0)->whereYear('created_at', date('Y'))->where('name', $name)->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Expense Account</th>
                        <th>Budget</th>
                    </tr>
                </thead><tbody>';
        foreach ($expense as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->name.'</td>
                        <td>'.$value->$month.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function quarterexpense_actual_details(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = date('Y');
        $month = $request->month;
        $month_year = $year."-".$month;
        $name = $request->name;
        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
        $expense = DB::table('expense_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('account_description', $name)->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($expense as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function user_appointmentstepdet(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $now = date('Y-m-d');
        $date = $request->currentyear."-".$request->currentmonth."-".$request->date;
        // $date = '2021-02-02';
        $day =  strtolower(Carbon::parse($date)->format('l'));
        $uemail =  $request->appn_id;
        $details = DB::table('appointment_settings')->where('uemail', $uemail)->first();
        // print_r($details);die();
        $blocks = DB::table('block_appointment_date')->where('uemail', $uemail)->get();
        if(strtotime($date) < strtotime($now)){
            echo "prev_day";
        }
        else{
            if($details->$day == "block"){
                echo "blocked_day";
            }
            else{
                $cnt = 0;
                foreach ($blocks as $value) {
                    if(($date >= $value->startdate) && ($date <= $value->enddate)){
                        $cnt++;
                    }
                }
                if($cnt == 0){
                    echo "on";
                }
                else{
                    echo "blocked_day";
                }
            }
        }
    }
    public function user_appointment_date_availabilityy(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uemail = $request->appn_id;
        $main_date = $request->todaysDate;
        $docid = $request->appn_id;
        $day =  strtolower(Carbon::parse($main_date)->format('l'));
        $details = DB::table('appointment_settings')->where('uemail', $uemail)->get();
        if(count($details) > 0){
            $selecteddate = date('Y-m-d', strtotime($request->todaysDate));
            $nowtime = date('H:i', strtotime(now()));
            $today = date('Y-m-d', strtotime(now()));
            // $today = "2021-01-11";
            $seconds = time();
            $rounded_seconds = "";
            $noww = "";
            $slot = $details[0]->receive_time;
            if($slot == 30){
                $rounded_seconds = ceil($seconds / (30 * 60)) * (30 * 60);
                $noww = date('H:i', $rounded_seconds);
            }
            elseif($slot == 60){
                $rounded_seconds = ceil($seconds / (60 * 60)) * (60 * 60);
                $noww = date('H:i', $rounded_seconds);
            }
            $timing = explode(',', $details[0]->$day);
            $availadoctorstart = $timing[0];
            $availadoctorend = $timing[1];
            $now = "";
            $endtime = "";
            if ($selecteddate == $today) {
                if($noww >= $availadoctorstart){
                    $now = $noww;
                    $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                }
                else {
                    $now = $availadoctorstart;
                    $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                }
            }
            else{
                $now = $availadoctorstart;
                $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
            }
            $timings = DB::table('appointments')->select(['appointment_time','appointment_end'])->where([['appointment_id', '=', $docid],['appointment_date', '=', $selecteddate]])->where('appointments.cstatus', "on")->orderBy('appointment_time','ASC')->get();
            // echo $now.", ".$endtime;
            $amarr = [];
            $pmarr = [];
            if(count($timings) > 0){
                $len = count($timings);
                $cnt = 1;
                for($i = 0; $i < 50; $i++)
                {
                    if($cnt <50){
                        $flag = 0;
                        $starttime = '';
                        $end = '';
                        $f = 0;
                         $big = 0;
                        foreach($timings as $value){
                            if(($now <= $value->appointment_time) && ($endtime <= $value->appointment_time)) {
                                $starttime = $now;
                                $end = $endtime;
                                if($flag == 0){
                                    $flag++;
                                }
                                elseif($flag == $f){
                                    $flag++;
                                }
                            }
                            else{
                                if(($now >= $value->appointment_end)){
                                    $starttime = $now;
                                    $end = $endtime;
                                    $flag++;
                                }
                                else{
                                    $starttime = $now;
                                    $end = $endtime;
                                }
                            }
                            $f++;
                            // print_r($flag);
                        }
                        // die();
                        // print_r($end);die();
                        if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                            if (($flag == $f)) {
                               if($starttime < date('h:i', strtotime("12:00")) ){
                                $var = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($amarr, $var);

                               }
                               else{
                                $var2 = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($pmarr, $var2);
                               }
                                $cnt++;
                            }
                            $now = date("H:i", strtotime($end));
                            $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                        }
                    }
                }
                // echo $amarr[0]; die();
                if(count($amarr) > 0){
                    echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">AM </label>
                                    </div>
                                    <div class="col-md-11"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($amarr); $x++)
                    {
                        echo $amarr[$x];
                    }
                    echo '</ul></div></div>';
                }
                if(count($pmarr) > 0){
                     echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">PM </label>
                                    </div>
                                    <div class="col-md-11"><div style="border: 1px solid grey; border-radius: 10px; margin-bottom: 10px;"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($pmarr); $x++)
                    {
                        echo $pmarr[$x];
                    }
                    echo '</ul></div></div></div>';
                }
            }
            else{
                for($i=0; $i <= 50; $i++) {
                    $starttime = $now;
                    $end = $endtime;
                    if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                        if ($endtime == "00:00") {
                            break;
                        }
                        if(($starttime >= $availadoctorstart) && ($starttime < $availadoctorend) && ($end < $availadoctorend)){
                            if($starttime < date('h:i', strtotime("12:00")) ){
                                $var = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($amarr, $var);

                               }
                               else{
                                $var2 = "<li class='selecttimee' style='float:left; text-align: center; margin: 3px 3px'><label style='font-size: 12px'>".date('h:i', strtotime($starttime))."</lable><br><input class='slottime' type='checkbox' onclick='myFunction(this.id)' id='selecttimee".$i."' name='slot' value='".$starttime."'></li>";
                                array_push($pmarr, $var2);
                               }
                        }
                        $now = date("H:i", strtotime($end));
                        $endtime = date("H:i", strtotime('+'.$slot.' minutes', strtotime($now)));
                    }
                }
                if(count($amarr) > 0){
                    echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">AM </label>
                                    </div>
                                    <div class="col-md-11"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($amarr); $x++)
                    {
                        echo $amarr[$x];
                    }
                    echo '</ul></div></div>';
                }
                if(count($pmarr) > 0){
                     echo '<div class="row margin-bottom-20">
                                    <div class="col-md-1" style="padding: 8px;">
                                        <label style="margin-top:45px;font-size:24px;">PM </label>
                                    </div>
                                    <div class="col-md-11"><div style="border: 1px solid grey; border-radius: 10px; margin-bottom: 10px;"><ul class="timingul time-table" style="padding: 0; list-style-type: none; width: 100%;">';
                    // foreach($amarr as $value) {
                    //     echo $value;
                    // }
                    for($x = 0; $x < count($pmarr); $x++)
                    {
                        echo $pmarr[$x];
                    }
                    echo '</ul></div></div></div>';
                }
            }
        }
        else{
            echo "Slot is not available";
        }
    }
    public function temp_user_profile()
    {
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
        $data['top_banners'] = ClientManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['client'] = ClientAppointmentList::where('email', Auth::user()->email)->get();
        // print_r($data['client']);die();
        return view('main.user_edit_clientf')->with($data);
    }
    public static function getweekactualexp($name)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $textdt=$year."-".$month."-01";
        // $textdt = "2021-02-02";
        $dt= strtotime( $textdt);
        $currdt=$dt;
        $nextmonth=strtotime($textdt."+1 month");
        // $nextmonth=strtotime(Carbon::parse($currdt)->endOfMonth()->toDateTimeString());
        $total = 0;
        $i=0;
        $weeklycnt = [];
        do
        {
            $weekday= date("w",$currdt);
            $nextday=7-$weekday;
            $endday=abs($weekday-6);
            $startarr[$i]=$currdt;
            $endarr[$i]=strtotime(date("Y-m-d",$currdt)."+$endday day");
            $end = "";
            if($endarr[$i] < $nextmonth){
                $end = $endarr[$i];
            }
            else{
                $end = strtotime(Carbon::now()->endOfMonth()->toDateString());
            }
            $currdt=strtotime(date("Y-m-d",$endarr[$i])."+1 day");
            $countweek = DB::table('expense_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$end))->where('uid', $uid)->where('account_description', $name)->sum('amount_paid');
            array_push($weeklycnt, $countweek);
            $total += $countweek;
            $i++;

        }while($endarr[$i-1]<$nextmonth);
        $weekcnt = $i;
        if($weekcnt == 3){
            echo '<td class="expenseweek" id="'.$name.'eweek0">'.$weeklycnt[0].'</td>
            <td class="expenseweek" id="'.$name.'eweek1">'.$weeklycnt[1].'</td>
            <td class="expenseweek" id="'.$name.'eweek2">'.$weeklycnt[2].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]).'</td>';
        }elseif ($weekcnt == 4) {
            echo '<td class="expenseweek" id="'.$name.'eweek0">'.$weeklycnt[0].'</td>
            <td class="expenseweek" id="'.$name.'eweek1">'.$weeklycnt[1].'</td>
            <td class="expenseweek" id="'.$name.'eweek2">'.$weeklycnt[2].'</td>
            <td class="expenseweek" id="'.$name.'eweek3">'.$weeklycnt[3].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]).'</td>';
        }elseif ($weekcnt == 5) {
            echo '<td class="expenseweek" id="'.$name.'eweek0">'.$weeklycnt[0].'</td>
            <td class="expenseweek" id="'.$name.'eweek1">'.$weeklycnt[1].'</td>
            <td class="expenseweek" id="'.$name.'eweek2">'.$weeklycnt[2].'</td>
            <td class="expenseweek" id="'.$name.'eweek3">'.$weeklycnt[3].'</td>
            <td class="expenseweek" id="'.$name.'eweek4">'.$weeklycnt[4].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]).'</td>';
        }elseif ($weekcnt == 6) {
            echo '<td class="expenseweek" id="'.$name.'eweek0">'.$weeklycnt[0].'</td>
            <td class="expenseweek" id="'.$name.'eweek1">'.$weeklycnt[1].'</td>
            <td class="expenseweek" id="'.$name.'eweek2">'.$weeklycnt[2].'</td>
            <td class="expenseweek" id="'.$name.'eweek3">'.$weeklycnt[3].'</td>
            <td class="expenseweek" id="'.$name.'eweek4">'.$weeklycnt[4].'</td>
            <td class="expenseweek" id="'.$name.'eweek5">'.$weeklycnt[5].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]+$weeklycnt[5]).'</td>';
        }
    }
    public static function getweekactualexptotal()
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $textdt=$year."-".$month."-01";
        // $textdt = "2021-02-02";
        $dt= strtotime( $textdt);
        $currdt=$dt;
        $nextmonth=strtotime($textdt."+1 month");
        // $nextmonth=strtotime(Carbon::parse($currdt)->endOfMonth()->toDateTimeString());
        $total = 0;
        $i=0;
        $weeklycnt = [];
        do
        {
            $weekday= date("w",$currdt);
            $nextday=7-$weekday;
            $endday=abs($weekday-6);
            $startarr[$i]=$currdt;
            $endarr[$i]=strtotime(date("Y-m-d",$currdt)."+$endday day");
            $currdt=strtotime(date("Y-m-d",$endarr[$i])."+1 day");
            $countweek = DB::table('expense_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$endarr[$i]))->where('uid', $uid)->sum('amount_paid');
            array_push($weeklycnt, $countweek);
            $total += $countweek;
            $i++;

        }while($endarr[$i-1]<$nextmonth);
        $weekcnt = $i;
        if($weekcnt == 3){
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]).'</td>';
        }elseif ($weekcnt == 4) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]).'</td>';
        }elseif ($weekcnt == 5) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.$weeklycnt[4].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]).'</td>';
        }elseif ($weekcnt == 6) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.$weeklycnt[4].'</td>
            <td>'.$weeklycnt[5].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]+$weeklycnt[5]).'</td>';
        }
    }
    public static function getweekactualexpdiff()
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $textdt=$year."-".$month."-01";
        // $textdt = "2021-02-02";
        $dt= strtotime( $textdt);
        $currdt=$dt;
        $nextmonth=strtotime($textdt."+1 month");
        // $nextmonth=strtotime(Carbon::parse($currdt)->endOfMonth()->toDateTimeString());
        $total = 0;
        $i=0;
        $weeklycnt = [];
        do
        {
            $weekday= date("w",$currdt);
            $nextday=7-$weekday;
            $endday=abs($weekday-6);
            $startarr[$i]=$currdt;
            $endarr[$i]=strtotime(date("Y-m-d",$currdt)."+$endday day");
            $currdt=strtotime(date("Y-m-d",$endarr[$i])."+1 day");
            $countweek = DB::table('expense_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$endarr[$i]))->where('uid', $uid)->sum('amount_paid');
            $countweek2 = DB::table('revenue_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$endarr[$i]))->where('uid', $uid)->sum('amount_paid');
            array_push($weeklycnt, ($countweek2-$countweek));
            $i++;

        }while($endarr[$i-1]<$nextmonth);
        $weekcnt = $i;
        if($weekcnt == 3){
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]).'</td>';
        }elseif ($weekcnt == 4) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]).'</td>';
        }elseif ($weekcnt == 5) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.$weeklycnt[4].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]).'</td>';
        }elseif ($weekcnt == 6) {
            echo '<td>'.$weeklycnt[0].'</td>
            <td>'.$weeklycnt[1].'</td>
            <td>'.$weeklycnt[2].'</td>
            <td>'.$weeklycnt[3].'</td>
            <td>'.$weeklycnt[4].'</td>
            <td>'.$weeklycnt[5].'</td>
            <td>'.($weeklycnt[0]+$weeklycnt[1]+$weeklycnt[2]+$weeklycnt[3]+$weeklycnt[4]+$weeklycnt[5]).'</td>';
        }
    }
    public function grossweekdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $request->startday)->where('transaction_date', '<=', $request->endday)->where('account_description', '!=', 'Other Revenue')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Tax Collected</th>
                        <th>Shipping Charge</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function otherrweekdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $request->startday)->where('transaction_date', '<=', $request->endday)->where('account_description', 'Other Revenue')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Tax Collected</th>
                        <th>Shipping Charge</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function expenseweekdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $name = $request->name;
        $revenue = DB::table('expense_record')->where('transaction_date', '>=', $request->startday)->where('transaction_date', '<=', $request->endday)->where('account_description', $name)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public static function get_month_count_revenue($month, $name)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        return $count = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->where('account_description', $name)->sum('bill');
    }

    public static function get_month_totall_revenue($month)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        return $count = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->sum('bill');
    }
  public static function get_revenue_by_col($email,$month,$col,$year="")
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        return DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', $month)->where('client_email', $email)->sum($col);
    }

public function get_client_id($email){
    $data=ClientAppointmentList::where('email',$email)->first();
    return $data->id;
}
 public function paymentbalancerevenuemonthdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
         $tatal1=$tatal2=$tatal3=$tatal4=$tatal5=$tatal6=0;
        $revenue = DB::table('revenue_record')->whereMonth('transaction_date', $request->month)->whereYear('transaction_date', date('Y'))->where('client_email', $request->email)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
      echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>

                        <th>Revenue Account</th>
                        <th>Transaction Date</th>
                        <th>Charged / Bill</th>
                        <th>Tax </th>
                        <th>Shipping </th>
                        <th>Total</th>
                        <th> Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';

        foreach ($revenue as $value) {
              $tatal1 +=$value->bill;
              $tatal2 +=$value->tax;
              $tatal3 +=$value->shipping;
              $tatal4 +=$value->total;
              $tatal5 +=$value->amount_paid;
              $tatal6 +=$value->balance;

            echo '<tr class="odd gradeX">

                        <td>'.$value->account_description.'</td>
                        <td style="color: #000">'.date('d M Y',strtotime($value->transaction_date)).'</td>
                        <td>'.$value->bill.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>' ?>
                         <?php if($value->balance >=0)
                         {
                            echo $value->balance;
                         }else{
                            echo "<span style='color:red'>".str_replace('-',' ',round($value->balance,2))."</span>";
                         } ?>
                        <?php '</td>
                    </tr>';
        }
         echo ' <tfoot>
                    <tr>
                        <th colspan="2"> Total</th>

                        <th>'.$tatal1.'</th>
                        <th>'.$tatal2.'</th>
                        <th>'.$tatal3.'</th>
                        <th>'.$tatal4.'</th>
                        <th>'.$tatal5.'</th>
                        <th>'.$tatal6.'</th>
                    </tr>
                </tfoot>';
        echo '</tbody></table>';
    }
 public function get_revenue_by_month(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month=$request->month;
        $year=$request->year;
         $tatal1=$tatal2=$tatal3=$tatal4=$tatal5=$tatal6=0;
         $clients = DB::table('client_appointment_lists')->where('uid', $uid)->orderBy('id', 'desc')->get();
       $html1=ob_start();


        $bill_amount1=0;
        $tax_amount1=0;
        $shipping_amount1=0;
        $total_amount1=0;
        $paid_amount1=0;
        $balance_amount1=0;

 foreach($clients as $value){



        $bill_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'bill',$year);
        $tax_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'tax',$year);
        $shipping_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'shipping',$year);
        $total_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'total',$year);
        $paid_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'amount_paid',$year);
        $balance_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'balance',$year);
    }
    $balance_amount1= str_replace('-',' ', $balance_amount1);
    ?>

        <th colspan="2">Total</th>

        <th><?=$bill_amount1;?></th>
        <th><?=$tax_amount1;?></th>
        <th><?=$shipping_amount1;?></th>
        <th><?=$total_amount1;?></th>
        <th><?=$paid_amount1;?></th>
        <th><?=$balance_amount1;?></th>



<?php
 $html1=ob_get_clean();
 $html=ob_start();
      foreach($clients as $value){


    $bill_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'bill',$year);
    $tax_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'tax',$year);
    $shipping_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'shipping',$year);
    $total_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'total',$year);
    $paid_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'amount_paid',$year);
    $balance_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'balance',$year);
            $total = 0;
        if($paid_amount>0){
             ?>
        <tr class="odd gradeX">
      <td><input type="checkbox" class="checkboxes" value="<?= $value->id;?>" /></td>
        <td class="fixed-side"><?= $value->first_name.' '.$value->last_name?></td>

        <td>
            <?php if($bill_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.$bill_amount.'</a>';
                }
                else{
               echo $bill_amount;
                }
             ?>
        </td>
        <td>
            <?php if($tax_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.$tax_amount.'</a>';
                }
                else{
               echo $tax_amount;
                }
             ?>
        </td>
        <td>
              <?php if($shipping_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.$shipping_amount.'</a>';
                }
                else{
               echo $shipping_amount;
                }
             ?>
        </td>
        <td>
              <?php if($total_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.$total_amount.'</a>';
                }
                else{
               echo $total_amount;
                }
             ?>
        </td>
        <td>
              <?php if($paid_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.$paid_amount.'</a>';
                }
                else{
               echo $paid_amount;
                }
             ?>
        </td>
        <td>
              <?php if($balance_amount > 0){
                 echo '<a class="revenue_month" id="'.$month.'revenue_month'.$value->email.'" style="color:red">'.str_replace('-',' ', $balance_amount).'</a>';
                }
                else{
               echo str_replace('-',' ', $balance_amount);
                }
             ?>
        </td>


        </tr>
    <?php
        }}
       $html=ob_get_clean();

        echo json_encode(array(
         'html' =>$html,
        'html1' =>$html1
         ));
    }

 public function get_revenue_by_quarter(Request $request)
    {

        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
         $month = $request->month;
         $year = $request->year;

        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $clients = DB::table('client_appointment_lists')->where('uid', $uid)->orderBy('id', 'desc')->get();
       $html=ob_start();
       $temp = 0;
       $temp2 = 0;
       $temp3 = 0;
       $temp4 = 0;
       $temp5 = 0;
       $temp6 = 0;
        foreach($clients as $value){
            $month=$month;
            $bill_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'bill',$year);
            $tax_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'tax',$year);
            $shipping_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'shipping',$year);
            $total_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'total',$year);
            $paid_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'amount_paid',$year);
            $balance_amount=\App\Http\Controllers\MainController::get_quarter_paymentbalance_info($value->email,$month,'balance',$year);
                $total = 0;
                if($paid_amount > 0){
                 ?>
                    <tr class="odd gradeX">
                        <td><input type="checkbox" class="checkboxes" value="<?= $value->id;?>" /></td>
                        <td class="fixed-side"><?= $value->first_name.' '.$value->last_name?></td>

                        <td>
                            <?php if($bill_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$bill_amount.'</a>';
                                }
                                else{
                            echo $bill_amount;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($tax_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$tax_amount.'</a>';
                                }
                                else{
                            echo $tax_amount;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($shipping_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$shipping_amount.'</a>';
                                }
                                else{
                            echo $shipping_amount;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($total_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$total_amount.'</a>';
                                }
                                else{
                            echo $total_amount;
                                }
                            ?>
                        </td>
                        <td>
                            <?php if($paid_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$paid_amount.'</a>';
                                }
                                else{
                            echo $paid_amount;
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                            $balance_amount=str_replace('-',' ',$balance_amount);
                            if($balance_amount > 0){
                                echo '<a class="revenue_quarter" id="'.$month.'revenue_quarter'.$value->email.'" style="color:red">'.$balance_amount.' </a>';
                                }
                                else{
                            echo $balance_amount;
                                }

                                $temp += $bill_amount;
                                $temp2 += $tax_amount;
                                $temp3 += $shipping_amount;
                                $temp4 += $total_amount;
                                $temp5 += $paid_amount;
                                $temp6 += $balance_amount;
                            ?>
                        </td>
                    </tr>
                <?php

             }}

             ?>
             <tr style="background: #afedff">
                <td>

                </td>
                <td>
                    Total
                </td>
                <td>
                    <?php
                        echo $temp;
                    ?>
                </td>
                <td>
                    <?php
                        echo $temp2;
                    ?>
                </td>
                <td>
                    <?php
                        echo $temp3;
                    ?>
                </td>
                <td>
                    <?php
                        echo $temp4;
                    ?>
                </td>
                <td>
                    <?php
                        echo $temp5;
                    ?>
                </td>
                <td>
                    <?php
                        echo $temp6;
                    ?>
                </td>

            </tr>
             <?php






       $html=ob_get_clean();

       echo $html;

    }

    public function paymentbalancequaterlyrevenuequarterdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = $request->month;
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $revenue = DB::table('revenue_record')->whereMonth('transaction_date', $month)->whereYear('transaction_date', date('Y'))->where('client_email', $request->email)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue2 = DB::table('revenue_record')->whereMonth('transaction_date', $month2)->whereYear('transaction_date', date('Y'))->where('client_email', $request->email)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue3 = DB::table('revenue_record')->whereMonth('transaction_date', $month3)->whereYear('transaction_date', date('Y'))->where('client_email', $request->email)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
 $tatal1=$tatal2=$tatal3=$tatal4=$tatal5=$tatal6=0;
 $tatal11=$tatal21=$tatal31=$tatal41=$tatal51=$tatal61=0;
 $tatal12=$tatal22=$tatal32=$tatal42=$tatal52=$tatal62=0;
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>

                        <th>Revenue Account</th>
                        <th>Transaction Date</th>
                        <th>Charged / Bill</th>
                        <th>Tax </th>
                        <th>Shipping </th>
                        <th>Total</th>
                        <th> Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue3 as $value) {
              $tatal1 +=$value->bill;
              $tatal2 +=$value->tax;
              $tatal3 +=$value->shipping;
              $tatal4 +=$value->total;
              $tatal5 +=$value->amount_paid;
              $tatal6 +=$value->balance;


            echo '<tr class="odd gradeX">

                        <td>'.$value->account_description.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->bill.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>' ?>
                         <?php if($value->balance >=0)
                         {
                            echo $value->balance;
                         }else{
                            echo "<span style='color:red'>".str_replace('-',' ',round($value->balance,2))."</span>";
                         } ?>
                        <?php '</td>
                    </tr>';
        }
        foreach ($revenue2 as $value) {
              $tatal1 +=$value->bill;
              $tatal2 +=$value->tax;
              $tatal3 +=$value->shipping;
              $tatal4 +=$value->total;
              $tatal5 +=$value->amount_paid;
              $tatal6 +=$value->balance;


            echo '<tr class="odd gradeX">

                        <td>'.$value->account_description.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->bill.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>' ?>
                         <?php if($value->balance >=0)
                         {
                            echo $value->balance;
                         }else{
                            echo "<span style='color:red'>".str_replace('-',' ',round($value->balance,2))."</span>";
                         } ?>
                        <?php '</td>
                    </tr>';
        }
        foreach ($revenue as $value) {
              $tatal1 +=$value->bill;
              $tatal2 +=$value->tax;
              $tatal3 +=$value->shipping;
              $tatal4 +=$value->total;
              $tatal5 +=$value->amount_paid;
              $tatal6 +=$value->balance;

            echo '<tr class="odd gradeX">

                        <td>'.$value->account_description.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->bill.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>' ?>
                         <?php if($value->balance >=0)
                         {
                            echo $value->balance;
                         }else{
                            echo "<span style='color:red'>".str_replace('-',' ',round($value->balance,2))."</span>";
                         } ?>
                        <?php '</td>
                    </tr>';
        }
       echo ' <tfoot>
                    <tr>
                        <th colspan="2"> Total</th>
                        <th>'.($tatal1).'</th>
                        <th>'.($tatal2).'</th>
                        <th>'.($tatal3).'</th>
                        <th>'.($tatal4).'</th>
                        <th>'.($tatal5).'</th>
                        <th>'.($tatal6).'</th>
                    </tr>
                </tfoot>';
        echo '</tbody></table>';
    }
    public function revenuemonthdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $revenue = DB::table('revenue_record')->whereMonth('transaction_date', $request->month)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Tax Collected</th>
                        <th>Shipping Charge</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public static function get_quarter_count_revenue($month, $name)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $count1 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->where('account_description', $name)->sum('bill');
        $count2 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month2)->where('account_description', $name)->sum('bill');
        $count3 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month3)->where('account_description', $name)->sum('bill');
        return $count = $count1+$count2+$count3;
    }
    public static function get_quarter_totall_revenue($month)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $count1 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->sum('bill');
        $count2 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month2)->sum('bill');
        $count3 = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month3)->sum('bill');
        return $count = $count1+$count2+$count3;
    }
    public function revenuequarterdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = $request->month;
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $revenue = DB::table('revenue_record')->whereMonth('transaction_date', $request->month)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue2 = DB::table('revenue_record')->whereMonth('transaction_date', $month2)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue3 = DB::table('revenue_record')->whereMonth('transaction_date', $month3)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Tax Collected</th>
                        <th>Shipping Charge</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue3 as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        foreach ($revenue2 as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.$value->client_name.'</td>
                        <td>'.$value->client_email.'</td>
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public static function get_month_count_expense($month, $name)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        return $count = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->where('account_description', $name)->sum('amount_paid');
    }
    public static function get_month_totall_expense($month)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        return $count = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->sum('amount_paid');
    }
    public static function get_quarter_count_expense($month, $name)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $count1 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->where('account_description', $name)->sum('amount_paid');
        $count2 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month2)->where('account_description', $name)->sum('amount_paid');
        $count3 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month3)->where('account_description', $name)->sum('amount_paid');
        return $count = $count1+$count2+$count3;
    }
    public static function get_quarter_totall_expense($month)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $count1 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->sum('amount_paid');
        $count2 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month2)->sum('amount_paid');
        $count3 = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month3)->sum('amount_paid');
        return $count = $count1+$count2+$count3;
    }
    public function expensemonthdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $revenue = DB::table('expense_record')->whereMonth('transaction_date', $request->month)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public function expensequarterdetails(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month = $request->month;
        $month2 = str_pad(($month +1), 2, '0', STR_PAD_LEFT);
        $month3 = str_pad(($month +2), 2, '0', STR_PAD_LEFT);
        $revenue = DB::table('expense_record')->whereMonth('transaction_date', $request->month)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue2 = DB::table('expense_record')->whereMonth('transaction_date', $month2)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $revenue3 = DB::table('expense_record')->whereMonth('transaction_date', $month3)->whereYear('transaction_date', date('Y'))->where('account_description', $request->description)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample1" style="width: 100%; overflow: auto;">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Account Description</th>
                        <th>Total Bill</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                    </tr>
                </thead><tbody>';
        foreach ($revenue3 as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        foreach ($revenue2 as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        foreach ($revenue as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }
    public static function get_quarter_paymentbalance_info($email,$months,$col,$year="")
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        if($year==""){
        $current_year = date('Y');

        }else{
        $current_year = $year;
    }
        if($months >= 1 && $months < 4)
        {
          $month1='01';
          $month2='02';
          $month3='03';
        }elseif ($months >= 4 && $months < 7) {
             $month1='04';
          $month2='05';
          $month3='06';

        }elseif ($months >= 7 && $months < 10) {
             $month1='07';
          $month2='08';
          $month3='09';
        }elseif ($months >= 10 && $months <= 12) {
             $month1='10';
          $month2='11';
          $month3='12';
        }
$getcount1 = DB::table('revenue_record')->where('client_email', $email)->whereYear('transaction_date', $current_year)->whereMonth('transaction_date', $month1)->where('uid', $uid)->sum($col);
$getcount2 = DB::table('revenue_record')->where('client_email', $email)->whereYear('transaction_date', $current_year)->whereMonth('transaction_date', $month2)->where('uid', $uid)->sum($col);
$getcount3 = DB::table('revenue_record')->where('client_email', $email)->whereYear('transaction_date', $current_year)->whereMonth('transaction_date', $month3)->where('uid', $uid)->sum($col);
        // print_r(DB::getQueryLog());die();
        return $getcount = ($getcount1+$getcount2+$getcount3);

    }
    public static function get_quarter_paymentbalance($months, $email)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $current_year = date('Y');
        $month_year = $current_year."-".$months;
        $month_year1 = $current_year."-".str_pad(($months +1), 2, '0', STR_PAD_LEFT);
        $month_year2 = $current_year."-".str_pad(($months +2), 2, '0', STR_PAD_LEFT);
        // DB::enableQueryLog();
        $getcount1 = DB::table('revenue_record')->where('client_email', $email)->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->sum('amount_paid');
        $getcount2 = DB::table('revenue_record')->where('client_email', $email)->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->sum('amount_paid');
        $getcount3 = DB::table('revenue_record')->where('client_email', $email)->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->sum('amount_paid');
        // print_r(DB::getQueryLog());die();
        return $getcount = ($getcount1+$getcount2+$getcount3);
    }
    public function front_archives()
    {
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
            return redirect('/home')->with('status',"Admin can't access this page.");
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
        $data['top_banners'] = ArchivesBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = CardCategory::orderBy('category','desc')->get();
        $data['cards'] = UploadCard::groupBy('category')->get();
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
        $data['years'] = [];
        for($i = 0; $i < 10; $i++){
            $lastYear = date("Y", strtotime("-$i years"));
            if($lastYear > 2019){
                array_push($data['years'], $lastYear);
            }
        }
        // print_r($data['years']);die();
        return view('main.front_archives')->with($data);
    }

public function monthlylistfinance(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = $request->year;
        $jantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $febtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $martotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $aprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $maytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $juntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $jultotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $augtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $septotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $octtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $novtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $dectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $monthtotal = $jantotal + $febtotal + $martotal + $aprtotal + $maytotal + $juntotal + $jultotal + $augtotal + $septotal + $octtotal + $novtotal + $dectotal;
        $jangrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $febgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $margrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $aprgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $maygrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $jungrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $julgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $auggrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $sepgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $octgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $novgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $decgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $monthgrosstotal2 = $jangrosstotal2 + $febgrosstotal2 + $margrosstotal2 + $aprgrosstotal2 + $maygrosstotal2 + $jungrosstotal2 + $julgrosstotal2 + $auggrosstotal2 + $sepgrosstotal2 + $octgrosstotal2 + $novgrosstotal2 + $decgrosstotal2;
        $jangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $febgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $margrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $aprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $maygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $jungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $julgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $auggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $sepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $octgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $novgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $decgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $monthgrossactual = $jangrossactual + $febgrossactual + $margrossactual + $aprgrossactual + $maygrossactual + $jungrossactual + $julgrossactual + $auggrossactual + $sepgrossactual + $octgrossactual + $novgrossactual + $decgrossactual;
        $jantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $febtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $martotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $aprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $maytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $juntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $jultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $augtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $septotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $octtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $novtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $dectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $monthtotalactual = $jantotalactual + $febtotalactual + $martotalactual + $aprtotalactual + $maytotalactual + $juntotalactual + $jultotalactual + $augtotalactual + $septotalactual + $octtotalactual + $novtotalactual + $dectotalactual;
        $janothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $febothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $marothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $aprothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $mayothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $junothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $julothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $augothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $sepothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $octothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $novothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $decothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $monthothrevenue = $janothrevenue + $febothrevenue + $marothrevenue + $aprothrevenue + $mayothrevenue + $junothrevenue + $julothrevenue + $augothrevenue + $sepothrevenue + $octothrevenue + $novothrevenue + $decothrevenue;
        $janotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $febotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $marotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $aprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $mayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $junotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $julotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $augotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $sepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $octotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $novotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $decotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $monthotherrevenue = $janotherrevenue + $febotherrevenue + $marotherrevenue + $aprotherrevenue + $mayotherrevenue + $junotherrevenue + $julotherrevenue + $augotherrevenue + $sepotherrevenue + $octotherrevenue + $novotherrevenue + $decotherrevenue;
        $expense = DB::table('expense_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('account_description')->get();
        $revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('account_description')->get();
        $jantotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $febtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $martotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $aprtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $maytotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $juntotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $jultotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $augtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $septotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $octtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $novtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $dectotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $monthtotal2 = $jantotal2 + $febtotal2 + $martotal2 + $aprtotal2 + $maytotal2 + $juntotal2 + $jultotal2 + $augtotal2 + $septotal2 + $octtotal2 + $novtotal2 + $dectotal2;
        $jantotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $febtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $martotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $aprtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $maytotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $juntotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $jultotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $augtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $septotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $octtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $novtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $dectotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $monthtotal2actual = $jantotal2actual + $febtotal2actual + $martotal2actual + $aprtotal2actual + $maytotal2actual + $juntotal2actual + $jultotal2actual + $augtotal2actual + $septotal2actual + $octtotal2actual + $novtotal2actual + $dectotal2actual;
        $ejantotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $efebtotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $emartotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $eaprtotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $emaytotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $ejuntotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $ejultotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $eaugtotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $eseptotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $eocttotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $enovtotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $edectotal = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $emonthtotal = $ejantotal + $efebtotal + $emartotal + $eaprtotal + $emaytotal + $ejuntotal + $ejultotal + $eaugtotal + $eseptotal + $eocttotal + $enovtotal + $edectotal;
        $ejangrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $efebgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $emargrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $eaprgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $emaygrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $ejungrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $ejulgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $eauggrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $esepgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $eoctgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $enovgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $edecgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $emonthgrosstotal2 = $ejangrosstotal2 + $efebgrosstotal2 + $emargrosstotal2 + $eaprgrosstotal2 + $emaygrosstotal2 + $ejungrosstotal2 + $ejulgrosstotal2 + $eauggrosstotal2 + $esepgrosstotal2 + $eoctgrosstotal2 + $enovgrosstotal2 + $edecgrosstotal2;
        $ejangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $efebgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $emargrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $eaprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $emaygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $ejungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $ejulgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $eauggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $esepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $eoctgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $enovgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $edecgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $emonthgrossactual = $ejangrossactual + $efebgrossactual + $emargrossactual + $eaprgrossactual + $emaygrossactual + $ejungrossactual + $ejulgrossactual + $eauggrossactual + $esepgrossactual + $eoctgrossactual + $enovgrossactual + $edecgrossactual;
        $ejantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $efebtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $emartotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $eaprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $emaytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $ejuntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $ejultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $eaugtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $eseptotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $eocttotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $enovtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $edectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $emonthtotalactual = $ejantotalactual + $efebtotalactual + $emartotalactual + $eaprtotalactual + $emaytotalactual + $ejuntotalactual + $ejultotalactual + $eaugtotalactual + $eseptotalactual + $eocttotalactual + $enovtotalactual + $edectotalactual;
        $ejanothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $efebothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $emarothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $eaprothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $emayothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $ejunothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $ejulothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $eaugothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $esepothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $eoctothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $enovothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $edecothrevenue = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $emonthothrevenue = $ejanothrevenue + $efebothrevenue + $emarothrevenue + $eaprothrevenue + $emayothrevenue + $ejunothrevenue + $ejulothrevenue + $eaugothrevenue + $esepothrevenue + $eoctothrevenue + $enovothrevenue + $edecothrevenue;
        $ejanotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $efebotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $emarotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $eaprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $emayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $ejunotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $ejulotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $eaugotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $esepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $eoctotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $enovotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $edecotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $emonthotherrevenue = $ejanotherrevenue + $efebotherrevenue + $emarotherrevenue + $eaprotherrevenue + $emayotherrevenue + $ejunotherrevenue + $ejulotherrevenue + $eaugotherrevenue + $esepotherrevenue + $eoctotherrevenue + $enovotherrevenue + $edecotherrevenue;
        $eexpense = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $ejantotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $efebtotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $emartotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $eaprtotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $emaytotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $ejuntotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $ejultotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $eaugtotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $eseptotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $eocttotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $enovtotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $edectotal2 = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $emonthtotal2 = $ejantotal2 + $efebtotal2 + $emartotal2 + $eaprtotal2 + $emaytotal2 + $ejuntotal2 + $ejultotal2 + $eaugtotal2 + $eseptotal2 + $eocttotal2 + $enovtotal2 + $edectotal2;
        $ejantotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $efebtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $emartotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $eaprtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $emaytotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $ejuntotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $ejultotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $eaugtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $eseptotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $eocttotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $enovtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $edectotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $emonthtotal2actual = $ejantotal2actual + $efebtotal2actual + $emartotal2actual + $eaprtotal2actual + $emaytotal2actual + $ejuntotal2actual + $ejultotal2actual + $eaugtotal2actual + $eseptotal2actual + $eocttotal2actual + $enovtotal2actual + $edectotal2actual;
       $value =2;

        echo '<thead >
            <thead>
                <tr class="top-tr">
                    <th class="fixed-side"></th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                    <th>Total</th>
                    <th>Graph</th>
                </tr>
            </thead>
        </thead>
        <tbody id="myTable">
        <tr>
                <td class="fixed-side" style="text-align: left; color: #da291c;">
                  <!--<input type="radio" id="el" name="Off"  value="On" onchange="show2()"> &nbsp; &nbsp; |&nbsp; &nbsp; OFF &nbsp;
                  <input type="radio" name="Off" value="Off" checked onchange="show(this.value)">-->
                  <div class="col-md-3" style="padding-left:0px !important">
                    <label class="switch switch-danger switch-round pull-right" style="padding-bottom:0px !important">
                        <b>Revenue : </b>
                        <input id="rev_chk" type="checkbox" checked="" />
                        <span style="margin-left: 20px;" class="switch-label" data-on="ON" data-off="OFF" onclick="show_rev(this.value)"></span>
                    </label>
                </div>

                <div class="" style="margin-left:auto !important">
                    <label class="" style="padding-bottom:0px !important">
                        <b style="margin-right:10px">CLR : </b>
                        <input id="clr_chk" type="checkbox" name="Off" value="clr" onchange="show_clr()">
                    </label>
                </div>




                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            ';



            if($value== 1){
                echo"$value";
                exit();
            }

        else{
                $temp =1;
                foreach($revenue as $value){
                    $namm = $value->account_description;
                    echo '

                    <tr id="revenue_count_'.$temp.'" class="odd gradeX">
                        <td   class="fixed-side">'.$value->account_description.'   <input type="checkbox" class="form-gorup" checked onClick="onClickRemove(this)"> </td>
                        ';
                        $actual_jan = DB::table('revenue_record')->whereMonth('transaction_date', '01')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jan!= 0){ echo '
                            <td data-count="revenuejan"><a class="actual_monthly_revenue" id="01revactual">'.$actual_jan.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuejan">'.$actual_jan.'</td>
                        '; }
                        $actual_feb = DB::table('revenue_record')->whereMonth('transaction_date', '02')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_feb != 0){ echo '
                            <td data-count="revenuefeb"><a class="actual_monthly_revenue" id="02revactual">'.$actual_feb.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuefeb">'.$actual_feb.'</td>
                        '; }
                        $actual_mar = DB::table('revenue_record')->whereMonth('transaction_date', '03')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_mar != 0){ echo '
                            <td data-count="revenuemar"><a class="actual_monthly_revenue" id="03revactual">'.$actual_mar.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuemar">'.$actual_mar.'</td>
                        '; }
                        $actual_apr = DB::table('revenue_record')->whereMonth('transaction_date', '04')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_apr != 0){ echo '
                            <td data-count="revenueapr"><a class="actual_monthly_revenue" id="04revactual">'.$actual_apr.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenueapr">'.$actual_apr.'</td>
                        '; }
                        $actual_may = DB::table('revenue_record')->whereMonth('transaction_date', '05')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_may != 0){ echo '
                            <td data-count="revenuemay"><a class="actual_monthly_revenue" id="05revactual">'.$actual_may.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuemay">'.$actual_may.'</td>
                        '; }

                        $actual_jun = DB::table('revenue_record')->whereMonth('transaction_date', '06')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jun != 0){ echo '
                            <td data-count="revenuejun"><a class="actual_monthly_revenue" id="06revactual">'.$actual_jun.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuejun">'.$actual_jun.'</td>
                        '; }
                        $actual_jul = DB::table('revenue_record')->whereMonth('transaction_date', '07')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jul != 0){ echo '
                            <td data-count="revenuejul"><a class="actual_monthly_revenue" id="07revactual">'.$actual_jul.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuejul">'.$actual_jul.'</td>
                        '; }
                        $actual_aug = DB::table('revenue_record')->whereMonth('transaction_date', '08')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_aug != 0){ echo '
                            <td data-count="revenueaug" class="actual_monthly_expense_aug"><a class="actual_monthly_revenue " id="08revactual">'.$actual_aug.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenueaug">'.$actual_aug.'</td>
                        '; }
                        $actual_sep = DB::table('revenue_record')->whereMonth('transaction_date', '09')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_sep != 0){ echo '
                            <td data-count="revenuesep"><a class="actual_monthly_revenue" id="09revactual">'.$actual_sep.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuesep">'.$actual_sep.'</td>
                        '; }
                        $actual_oct = DB::table('revenue_record')->whereMonth('transaction_date', '10')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_oct != 0){ echo '
                            <td data-count="revenueoct"><a class="actual_monthly_revenue" id="10revactual">'.$actual_oct.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenueoct">'.$actual_oct.'</td>
                        '; }
                        $actual_nov = DB::table('revenue_record')->whereMonth('transaction_date', '11')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_nov != 0){ echo '
                            <td data-count="revenuenov"><a class="actual_monthly_revenue" id="11revactual">'.$actual_nov.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuenov">'.$actual_nov.'</td>
                        '; }
                        $actual_decem = DB::table('revenue_record')->whereMonth('transaction_date', '12')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_decem != 0){ echo '
                            <td data-count="revenuedec"><a class="actual_monthly_revenue" id="12revactual">'.$actual_decem.'</a></td>
                        '; }else{ echo '
                            <td data-count="revenuedec">'.$actual_decem.'</td>
                        '; }
                        $actual_total2 = DB::table('revenue_record')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_total2 != 0){ echo '
                            <td class="total-clr" data-count="revenuemon"><a class="total_actual_monthly_revenue" ><b>'.$actual_total2.'</b></a></td>
                        '; }else{ echo '
                            <td class="total-clr" data-count="revenuemon"><b>'.$actual_total2.'</b></td>
                        '; }
                        echo'
                            <td>
                                <a href="'.url("revenue_variance_monthly_graph/$namm").'"><i class="fa fa-bar-chart"></i></a>
                            </td>
                        ';
                         echo '

                    </tr>

                ';
                $temp++;
                }

        }





                echo'
                </tbody>

                <tbody>

                <tr class="odd gradeX chang"  id="grevenue1">
                      <td class="fixed-side">Other Revenue  <input type="checkbox" class="form-gorup" checked onClick="onClickRemove(this)"></td>';
                      if($janotherrevenue != 0){ echo '
                <td data-count="revenuejan"><a class="actual_month_revenue" id="01revactual">'.$janotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuejan">'.$janotherrevenue.'</td>
            '; }
            if($febotherrevenue != 0){ echo '
                <td data-count="revenuefeb"><a class="actual_month_revenue" id="02revactual">'.$febotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuefeb">'.$febotherrevenue.'</td>
            '; }
            if($marotherrevenue != 0){ echo '
                <td data-count="revenuemar"><a class="actual_month_revenue" id="03revactual">'.$marotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuemar">'.$marotherrevenue.'</td>
            '; }
            if($aprotherrevenue != 0){ echo '
                <td data-count="revenueapr"><a class="actual_month_revenue" id="04revactual">'.$aprotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenueapr">'.$aprotherrevenue.'</td>
            '; }
            if($mayotherrevenue != 0){ echo '
                <td data-count="revenuemay"><a class="actual_month_revenue" id="05revactual">'.$mayotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuemay">'.$mayotherrevenue.'</td>
            '; }
            if($junotherrevenue != 0){ echo '
                <td data-count="revenuejun"><a class="actual_month_revenue" id="06revactual">'.$junotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuejun">'.$junotherrevenue.'</td>
            '; }
            if($julotherrevenue != 0){ echo '
                <td data-count="revenuejul"><a class="actual_month_revenue" id="07revactual">'.$julotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuejul">'.$julotherrevenue.'</td>
            '; }
            if($augotherrevenue != 0){ echo '
                <td data-count="revenueaug" class="actual_month_revenue_aug"><a class="actual_month_revenue " id="08revactual">'.$augotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenueaug" class="actual_month_revenue_aug">'.$augotherrevenue.'</td>
            '; }
            if($sepotherrevenue != 0){ echo '
                <td data-count="revenuesep"><a class="actual_month_revenue" id="09revactual">'.$sepotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuesep">'.$sepotherrevenue.'</td>
            '; }
            if($octotherrevenue != 0){ echo '
                <td data-count="revenueoct"><a class="actual_month_revenue" id="10revactual">'.$octotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenueoct">'.$octotherrevenue.'</td>
            '; }
            if($novotherrevenue != 0){ echo '
                <td data-count="revenuenov"><a class="actual_month_revenue" id="11revactual">'.$novotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuenov">'.$novotherrevenue.'</td>
            '; }
            if($decotherrevenue != 0){ echo '
                <td data-count="revenuedec"><a class="actual_month_revenue" id="12revactual">'.$decotherrevenue.'</a></td>
            '; }else{ echo '
                <td data-count="revenuedec">'.$decotherrevenue.'</td>
            '; }
            if($monthotherrevenue != 0){ echo '
                <td class="total-clr" data-count="revenuemon"><a class="total_actual_month_revenue" ><b>'.$monthotherrevenue.'<b></a></td>
            '; }else{ echo '
                <td class="total-clr" data-count="revenuemon"><b>'.$monthotherrevenue.'<b></td>
            '; }


            echo'
            <td>
                <a href="'.url("other_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
            </td>
                   </tr>

            ';


            echo'

        </tr>

                </tbody>

                <tbody>

            <tr class="odd gradeX chang" id="grevenue">

                <td class="fixed-side">Gross Revenue  <input type="checkbox" class="form-gorup" checked onchange="uncheck(event)"></td>';
                if($jangrossactual != 0){ echo '
                    <td data-count="revenuejan"><a class="actual_month_revenue" id="01revactual">'.$jangrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuejan">'.$jangrossactual.'</td>
                '; }
                if($febgrossactual != 0){ echo '
                    <td data-count="revenuefeb"><a class="actual_month_revenue" id="02revactual">'.$febgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuefeb">'.$febgrossactual.'</td>
                '; }
                if($margrossactual != 0){ echo '
                    <td data-count="revenuemar"><a class="actual_month_revenue" id="03revactual">'.$margrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuemar">'.$margrossactual.'</td>
                '; }
                if($aprgrossactual != 0){ echo '
                    <td data-count="revenueapr"><a class="actual_month_revenue" id="04revactual">'.$aprgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenueapr">'.$aprgrossactual.'</td>
                '; }
                if($maygrossactual != 0){ echo '
                    <td data-count="revenuemay"><a class="actual_month_revenue" id="05revactual">'.$maygrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuemay">'.$maygrossactual.'</td>
                '; }
                if($jungrossactual != 0){ echo '
                    <td data-count="revenuejun"><a class="actual_month_revenue" id="06revactual">'.$jungrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuejun">'.$jungrossactual.'</td>
                '; }
                if($julgrossactual != 0){ echo '
                    <td data-count="revenuejul"><a class="actual_month_revenue" id="07revactual">'.$julgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuejul">'.$julgrossactual.'</td>
                '; }
                if($auggrossactual != 0){ echo '
                    <td data-count="revenueaug" class="actual_month_revenue_aug"><a class="actual_month_revenue " id="08revactual">'.$auggrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenueaug" class="actual_month_revenue_aug">'.$auggrossactual.'</td>
                '; }
                if($sepgrossactual != 0){ echo '
                    <td data-count="revenuesep"><a class="actual_month_revenue" id="09revactual">'.$sepgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuesep">'.$sepgrossactual.'</td>
                '; }
                if($octgrossactual != 0){ echo '
                    <td data-count="revenueoct"><a class="actual_month_revenue" id="10revactual">'.$octgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenueoct">'.$octgrossactual.'</td>
                '; }
                if($novgrossactual != 0){ echo '
                    <td data-count="revenuenov"><a class="actual_month_revenue" id="11revactual">'.$novgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuenov">'.$novgrossactual.'</td>
                '; }
                if($decgrossactual != 0){ echo '
                    <td data-count="revenuedec"><a class="actual_month_revenue" id="12revactual">'.$decgrossactual.'</a></td>
                '; }else{ echo '
                    <td data-count="revenuedec">'.$decgrossactual.'</td>
                '; }
                if($monthgrossactual != 0){ echo '
                    <td class="total-clr" data-count="revenuemon"><a class="total_actual_month_revenue" ><b>'.$monthgrossactual.'<b></a></td>
                '; }else{ echo '
                    <td class="total-clr" data-count="revenuemon"><b>'.$monthgrossactual.'<b></td>
                '; }


                echo'
                <td>
                    <a href="'.url("gross_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>
                ';





                echo '
                <tbody  id="first_row">

            <tr id="total_r1" class="total-tr">
                <td class="fixed-side" style=""><b>Total Revenue </b></td>
                <td ><a style="font-weight:600" id="jan1" class="revenue_by_month revenue_by_jan"></a></td>
                <td ><a style="font-weight:600" id="feb2" class="revenue_by_month revenue_by_feb"></a></td>
                <td ><a style="font-weight:600" id="mar3" class="revenue_by_month revenue_by_mar"></a></td>
                <td ><a style="font-weight:600" id="apr4" class="revenue_by_month revenue_by_apr"></a></td>
                <td ><a style="font-weight:600" id="may5" class="revenue_by_month revenue_by_may"></a></td>
                <td ><a style="font-weight:600" id="jun6" class="revenue_by_month revenue_by_jun"></a></td>
                <td ><a style="font-weight:600" id="jul7" class="revenue_by_month revenue_by_jul"></a></td>
                <td ><a style="font-weight:600" id="aug8" class="revenue_by_month revenue_by_aug"></a></td>
                <td ><a style="font-weight:600" id="sep9" class="revenue_by_month revenue_by_sep"></a></td>
                <td ><a style="font-weight:600" id="oct10" class="revenue_by_month revenue_by_oct"></a></td>
                <td ><a style="font-weight:600" id="nov11" class="revenue_by_month revenue_by_nov"></a></td>
                <td ><a style="font-weight:600" id="dec12" class="revenue_by_month revenue_by_dec"></a></td>
                <td class="total-clr"><a style="font-weight:600" id="total13" class="total_yearly_revenue" ></a></td>
                <td>
                    <a href="'.url("all_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>
            </tr>

            </tbody>
            </tbody>

            <tbody id="exp_table">

            <tr>
            <td class="fixed-side" style="text-align: left; color: #da291c;">
                <!--<td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses: &nbsp; &nbsp; &nbsp; &nbsp; ON &nbsp;
                <input type="radio" id="el" name="Exp"  value="On" checked onchange="show21()"> &nbsp; &nbsp; |&nbsp; &nbsp; OFF &nbsp;
                <input type="radio" name="Exp" value="Off" onchange="show1(this.value)">-->
                <div class="col-md-3" style="padding-left:0px !important">
                <label class="switch switch-danger switch-round pull-right" style="padding-bottom:0px !important">
                    <b>Expenses : </b>
                    <input id="exp_chk" type="checkbox" checked="" />
                    <span style="margin-left: 20px;" class="switch-label" data-on="ON" data-off="OFF" onclick="show1(this.value)"></span>
                </label>
            </div>
              </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            ';
            $tem = 0;
            foreach($expense as $value){
                    $namm = $value->account_description;
                    echo '

                    <tr class="odd gradeX" id="exp_row_'.$tem.'">
                        <td  class="fixed-side">'.$value->account_description.'   <input type="checkbox" class="form-gorup" checked onClick="onClickRemove1(this)"> </td>
                        ';
                        $actual_jan = DB::table('expense_record')->whereMonth('transaction_date', '01')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jan!= 0){ echo '
                            <td data-count="expensejan"><a class="actual_monthly_expense" id="01actualexpense'.$value->account_description.'">'.$actual_jan.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensejan">'.$actual_jan.'</td>
                        '; }
                        $actual_feb = DB::table('expense_record')->whereMonth('transaction_date', '02')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_feb != 0){ echo '
                            <td data-count="expensefeb"><a class="actual_monthly_expense" id="02actualexpense'.$value->account_description.'">'.$actual_feb.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensefeb">'.$actual_feb.'</td>
                        '; }
                        $actual_mar = DB::table('expense_record')->whereMonth('transaction_date', '03')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_mar != 0){ echo '
                            <td data-count="expensemar"><a class="actual_monthly_expense" id="03actualexpense'.$value->account_description.'">'.$actual_mar.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensemar">'.$actual_mar.'</td>
                        '; }
                        $actual_apr = DB::table('expense_record')->whereMonth('transaction_date', '04')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_apr != 0){ echo '
                            <td data-count="expenseapr"><a class="actual_monthly_expense" id="04actualexpense'.$value->account_description.'">'.$actual_apr.'</a></td>
                        '; }else{ echo '
                            <td data-count="expenseapr">'.$actual_apr.'</td>
                        '; }
                        $actual_may = DB::table('expense_record')->whereMonth('transaction_date', '05')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_may != 0){ echo '
                            <td data-count="expensemay"><a class="actual_monthly_expense" id="05actualexpense'.$value->account_description.'">'.$actual_may.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensemay">'.$actual_may.'</td>
                        '; }

                        $actual_jun = DB::table('expense_record')->whereMonth('transaction_date', '06')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jun != 0){ echo '
                            <td data-count="expensejun"><a class="actual_monthly_expense" id="06actualexpense'.$value->account_description.'">'.$actual_jun.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensejun">'.$actual_jun.'</td>
                        '; }
                        $actual_jul = DB::table('expense_record')->whereMonth('transaction_date', '07')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_jul != 0){ echo '
                            <td data-count="expensejul"><a class="actual_monthly_expense" id="07actualexpense'.$value->account_description.'">'.$actual_jul.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensejul">'.$actual_jul.'</td>
                        '; }
                        $actual_aug = DB::table('expense_record')->whereMonth('transaction_date', '08')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_aug != 0){ echo '
                            <td data-count="expenseaug" class="actual_monthly_expense_aug"><a class="actual_monthly_expense " id="08actualexpense'.$value->account_description.'">'.$actual_aug.'</a></td>
                        '; }else{ echo '
                            <td data-count="expenseaug">'.$actual_aug.'</td>
                        '; }
                        $actual_sep = DB::table('expense_record')->whereMonth('transaction_date', '09')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_sep != 0){ echo '
                            <td data-count="expensesep"><a class="actual_monthly_expense" id="09actualexpense'.$value->account_description.'">'.$actual_sep.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensesep">'.$actual_sep.'</td>
                        '; }
                        $actual_oct = DB::table('expense_record')->whereMonth('transaction_date', '10')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_oct != 0){ echo '
                            <td data-count="expenseoct"><a class="actual_monthly_expense" id="10actualexpense'.$value->account_description.'">'.$actual_oct.'</a></td>
                        '; }else{ echo '
                            <td data-count="expenseoct">'.$actual_oct.'</td>
                        '; }
                        $actual_nov = DB::table('expense_record')->whereMonth('transaction_date', '11')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_nov != 0){ echo '
                            <td data-count="expensenov"><a class="actual_monthly_expense" id="11actualexpense'.$value->account_description.'">'.$actual_nov.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensenov">'.$actual_nov.'</td>
                        '; }
                        $actual_decem = DB::table('expense_record')->whereMonth('transaction_date', '12')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_decem != 0){ echo '
                            <td data-count="expensedec"><a class="actual_monthly_expense" id="12actualexpense'.$value->account_description.'">'.$actual_decem.'</a></td>
                        '; }else{ echo '
                            <td data-count="expensedec">'.$actual_decem.'</td>
                        '; }
                        $actual_total2 = DB::table('expense_record')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                        if($actual_total2 != 0){ echo '
                            <td class="total-clr" data-count="expensemon"><a class="total_actual_monthly_expense" id="12actualexpense'.$value->account_description.'"><b>'.$actual_total2.'<b></a></td>
                        '; }else{ echo '
                            <td class="total-clr" data-count="expensemon"><b>'.$actual_total2.'<b></td>
                        '; }
                        echo'
                            <td>
                                <a href="'.url("expense_variance_monthly_graph/$value->account_description").'"><i class="fa fa-bar-chart"></i></a>
                            </td>
                        ';
                         echo '
                    </tr>
                ';
                $tem++;
            }
            echo '

            </tbody>
            <tbody  id="second_row">


            <tr class="total2-tr total-tr" id="exp_t_r">
                <td class="fixed-side" style=""><b>Total Expenses</b>  </td>
                <td ><a id="exp_1" class="total_expense_by_month total_expanse_jan"></a></td>
                <td ><a id="exp_2" class="total_expense_by_month total_expanse_feb"></a></td>
                <td ><a id="exp_3" class="total_expense_by_month total_expanse_mar"></a></td>
                <td ><a id="exp_4" class="total_expense_by_month total_expanse_apr"></a></td>
                <td ><a id="exp_5" class="total_expense_by_month total_expanse_may"></a></td>
                <td ><a id="exp_6" class="total_expense_by_month total_expanse_jun"></a></td>
                <td ><a id="exp_7" class="total_expense_by_month total_expanse_jul"></a></td>
                <td ><a id="exp_8" class="total_expense_by_month total_expanse_aug"></a></td>
                <td ><a id="exp_9" class="total_expense_by_month total_expanse_sep"></a></td>
                <td ><a id="exp_10" class="total_expense_by_month total_expanse_oct"></a></td>
                <td ><a id="exp_11" class="total_expense_by_month total_expanse_nov"></a></td>
                <td ><a id="exp_12" class="total_expense_by_month total_expanse_dec"></a></td>

                <td><a id="exp_13" class="total_expense_by_month total_yearly_expenses" ></a></td>

                <td>
                    <a href="'.url("expense_monthly_vary_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>

            </tr>
        </tbody>
        </tbody>
        <tfoot>
            <tr style="display:none">
                <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b>  </td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_jan" data-month="01"><b>'.($jantotalactual-$jantotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_feb" data-month="02"><b>'.($febtotalactual-$febtotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_mar" data-month="03"><b>'.($martotalactual-$martotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_apr" data-month="04"><b>'.($aprtotalactual-$aprtotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_may" data-month="05"><b>'.($maytotalactual-$maytotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_jun" data-month="06"><b>'.($juntotalactual-$juntotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_jul" data-month="07"><b>'.($jultotalactual-$jultotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_aug" data-month="08"><b>'.($augtotalactual-$augtotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_sep" data-month="09"><b>'.($septotalactual-$septotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_oct" data-month="10"><b>'.($octtotalactual-$octtotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_nov" data-month="11"><b>'.($novtotalactual-$novtotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month revenue_expense_by_dec" data-month="12"><b>'.($dectotalactual-$dectotal2actual).'</b></a></td>
                <td ><a class="revenue_expense_by_month " data-month="all"><b>'.($monthtotalactual-($jantotal2actual + $febtotal2actual + $martotal2actual + $aprtotal2actual + $maytotal2actual + $juntotal2actual + $jultotal2actual + $augtotal2actual + $septotal2actual + $octtotal2actual + $novtotal2actual + $dectotal2actual)).'<b></a></td>
                <td>
                    <i class="fa fa-bar-chart"></i>
                </td>
            </tr>

            <tr class="" id="tot_est">
                <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b>  </td>
                <td ><a id="profit_1" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_2" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_3" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_4" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_5" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_6" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_7" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_8" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_9" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_10" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_11" class="revenue_expense_by_month "></a></td>
                <td ><a id="profit_12" class="revenue_expense_by_month "></a></td>

                <td><a id="profit_13" class="revenue_expense_by_month total_yearly_expenses" ></a></td>

                <td>
                <i class="fa fa-bar-chart"></i>
                </td>

            </tr>

            <tr style="display:none" id="tot_est1">
                <td class="fixed-side" style=""><b>Estimated Profit & Loss</b></td>
                <td ><a style="font-weight:600" id="jan11" class="revenue_by_month revenue_by_jan"></a></td>
                <td ><a style="font-weight:600" id="feb21" class="revenue_by_month revenue_by_feb"></a></td>
                <td ><a style="font-weight:600" id="mar31" class="revenue_by_month revenue_by_mar"></a></td>
                <td ><a style="font-weight:600" id="apr41" class="revenue_by_month revenue_by_apr"></a></td>
                <td ><a style="font-weight:600" id="may51" class="revenue_by_month revenue_by_may"></a></td>
                <td ><a style="font-weight:600" id="jun61" class="revenue_by_month revenue_by_jun"></a></td>
                <td ><a style="font-weight:600" id="jul71" class="revenue_by_month revenue_by_jul"></a></td>
                <td ><a style="font-weight:600" id="aug81" class="revenue_by_month revenue_by_aug"></a></td>
                <td ><a style="font-weight:600" id="sep91" class="revenue_by_month revenue_by_sep"></a></td>
                <td ><a style="font-weight:600" id="oct101" class="revenue_by_month revenue_by_oct"></a></td>
                <td ><a style="font-weight:600" id="nov111" class="revenue_by_month revenue_by_nov"></a></td>
                <td ><a style="font-weight:600" id="dec121" class="revenue_by_month revenue_by_dec"></a></td>
                <td class=""><a style="font-weight:600" id="total131" class="total_yearly_revenue" ></a></td>
                <td>
                    <a href="'.url("all_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>

            </tr>
        </tfoot>
        <script>
        function value(){
        <?php
        $value ="1";
        ?>
        }
         <script>
        function value2(){
        <?php
        $value ="2";
        ?>
        }

         function uncheck(event){
        event.target.parentNode.parentNode.style.display="none";
        event.target.parentNode.parentNode.setAttribute("data-uncheck",true);
        let td = document.querySelectorAll("#monthlyfinancetable > tbody > tr > td");

        let jantotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuejan" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    jantotal=parseInt(jantotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     jantotal=parseInt(jantotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_jan").innerHTML = jantotal;

        let febtotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuefeb" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    febtotal=parseInt(febtotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     febtotal=parseInt(febtotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_feb").innerHTML = febtotal;

         let martotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuemar" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    martotal=parseInt(martotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     martotal=parseInt(martotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_mar").innerHTML = martotal;

         let aprtotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenueapr" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    aprtotal=parseInt(aprtotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     aprtotal=parseInt(aprtotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_apr").innerHTML = aprtotal;

        let maytotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuemay" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    maytotal=parseInt(maytotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     maytotal=parseInt(maytotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_may").innerHTML = maytotal;

        let juntotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuejun" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    juntotal=parseInt(juntotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     juntotal=parseInt(juntotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_jun").innerHTML = juntotal;

        let jultotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuejul" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    jultotal=parseInt(jultotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     jultotal=parseInt(jultotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_jul").innerHTML = jultotal;


        let augtotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenueaug" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    augtotal=parseInt(augtotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     augtotal=parseInt(augtotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_aug").innerHTML = augtotal;

        let septotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuesep" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    septotal=parseInt(septotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     septotal=parseInt(septotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_sep").innerHTML = septotal;



        let octtotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenueoct" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    octtotal=parseInt(octtotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     octtotal=parseInt(octtotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_oct").innerHTML = octtotal;

         let novtotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuenov" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    novtotal=parseInt(novtotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     novtotal=parseInt(novtotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_nov").innerHTML = novtotal

         let dectotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuedec" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    dectotal=parseInt(dectotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     dectotal=parseInt(dectotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .revenue_by_dec").innerHTML = dectotal;

         let montotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "revenuemon" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    montotal=parseInt(montotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     montotal=parseInt(montotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
        document.querySelector("#monthlyfinancetable > tbody .total_yearly_revenue").innerHTML = montotal;

         let janexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensejan" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    janexptotal=parseInt(janexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     janexptotal=parseInt(janexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_jan").innerHTML = janexptotal;

         let febexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensefeb" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    febexptotal=parseInt(febexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     febexptotal=parseInt(febexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_feb").innerHTML = febexptotal;


         let marexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensemar" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    marexptotal=parseInt(marexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     marexptotal=parseInt(marexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_mar").innerHTML = marexptotal;

         let aprexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expenseapr" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    aprexptotal=parseInt(aprexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     aprexptotal=parseInt(aprexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_apr").innerHTML = aprexptotal;

         let mayexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensemay" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    mayexptotal=parseInt(mayexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     mayexptotal=parseInt(mayexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_may").innerHTML = mayexptotal;

          let junexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensejun" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    junexptotal=parseInt(junexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     junexptotal=parseInt(junexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_jun").innerHTML = junexptotal;

         let julexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensejul" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    julexptotal=parseInt(julexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     julexptotal=parseInt(julexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_jul").innerHTML = julexptotal;

         let augexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expenseaug" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    augexptotal=parseInt(augexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     augexptotal=parseInt(augexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_aug").innerHTML = augexptotal;

         let sepexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensesep" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    sepexptotal=parseInt(sepexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     sepexptotal=parseInt(sepexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_sep").innerHTML = sepexptotal;

          let octexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensesep" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    octexptotal=parseInt(octexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     octexptotal=parseInt(octexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_oct").innerHTML = octexptotal;

           let novexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensenov" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    novexptotal=parseInt(novexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     novexptotal=parseInt(novexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_nov").innerHTML = novexptotal;

           let decexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensedec" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    decexptotal=parseInt(decexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     decexptotal=parseInt(decexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_expanse_dec").innerHTML = decexptotal;

           let monexptotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "expensedec" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a"));
                    monexptotal=parseInt(monexptotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i]);
                     monexptotal=parseInt(monexptotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }
         document.querySelector("#monthlyfinancetable > tbody .total_yearly_expenses").innerHTML = monexptotal;





    //     let totalrevenueaug = 0;
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenueaug = parseInt(totalrevenueaug) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").querySelector("a").innerHTML);
    //         }
    //     }
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenueaug = parseInt(totalrevenueaug) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").innerHTML);
    //         }
    //     }
    //   document.querySelector("#monthlyfinancetable > tbody .revenue_by_aug").innerHTML =   totalrevenueaug ;

            }


                    function hide() {
                    var list = document.querySelectorAll("#revenue_count");
                    for (var i = 0; i < list.length; i++) {
                    list[i].style.visibility = "hidden";
                        };
                    }
                    function show() {
                    var list = document.querySelectorAll("#revenue_count");
                    for (var i = 0; i < list.length; i++) {
                    list[i].style.visibility = "visible";
                            };

                     }




            </script>
        ';
    }

    public function quarterlylistfinance(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = $request->year;
        $expensess = DB::table('expense_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('account_description')->get();
        $jangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $febgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $margrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $aprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $maygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $jungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $julgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $auggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $sepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $octgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $novgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $decgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $janmargrossactual = $jangrossactual + $febgrossactual + $margrossactual;
        $aprjungrossactual = $aprgrossactual + $maygrossactual + $jungrossactual;
        $julsepgrossactual = $julgrossactual + $auggrossactual + $sepgrossactual;
        $octdecgrossactual = $octgrossactual + $novgrossactual + $decgrossactual;
        $monthgrossactual = $janmargrossactual + $aprjungrossactual + $julsepgrossactual + $octdecgrossactual;
        $janotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $febotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $marotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $aprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $mayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $junotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $julotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $augotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $sepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $octotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $novotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $decotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $monthotherrevenue = $janotherrevenue + $febotherrevenue + $marotherrevenue + $aprotherrevenue + $mayotherrevenue + $junotherrevenue + $julotherrevenue + $augotherrevenue + $sepotherrevenue + $octotherrevenue + $novotherrevenue + $decotherrevenue;
        $janmarotherrevenue = $janotherrevenue + $febotherrevenue + $marotherrevenue;
        $aprjunotherrevenue = $aprotherrevenue + $mayotherrevenue + $junotherrevenue;
        $julsepotherrevenue = $julotherrevenue + $augotherrevenue + $sepotherrevenue;
        $octdecotherrevenue = $octotherrevenue + $novotherrevenue + $decotherrevenue;
        $monthotherrevenue = $janmarotherrevenue + $aprjunotherrevenue + $julsepotherrevenue + $octdecotherrevenue;
        $jantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $febtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $martotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $aprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $maytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $juntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $jultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $augtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $septotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $octtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $novtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $dectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $janmartotalactual = $jantotalactual + $febtotalactual + $martotalactual;
        $aprjuntotalactual = $aprtotalactual + $maytotalactual + $juntotalactual;
       // echo " $aprtotalactual + $maytotalactual + $juntotalactual;";die;
        $julseptotalactual = $jultotalactual + $augtotalactual + $septotalactual;
        $octdectotalactual = $octtotalactual + $novtotalactual + $dectotalactual;
        $monthtotalactual = $janmartotalactual + $aprjuntotalactual + $julseptotalactual + $octdectotalactual;
        $jantotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $febtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $martotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $aprtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $maytotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $juntotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $jultotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $augtotal2actual = DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $septotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $octtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $novtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $dectotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $janmartotal2actual = $jantotal2actual + $febtotal2actual + $martotal2actual;
        $aprjuntotal2actual = $aprtotal2actual + $maytotal2actual + $juntotal2actual;
        $julseptotal2actual = $jultotal2actual + $augtotal2actual + $septotal2actual;
        $octdectotal2actual = $octtotal2actual + $novtotal2actual + $dectotal2actual;
        $monthtotal2actual = $janmartotal2actual + $aprjuntotal2actual + $julseptotal2actual + $octdectotal2actual;
        echo '<thead>
                <tr class="top-tr">
                    <th class="fixed-side"></th>
                    <th>Jan-Mar</th>
                    <th>Apr-Jun</th>
                    <th>Jul-Sep</th>
                    <th>Oct-Dec</th>
                    <th>Total</th>
                     <th>Graph</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr class="odd gradeX">
                    <td class="fixed-side">Gross Revenue  <input type="checkbox" class="form-gorup" checked onchange="uncheck(event)"></td>
                    '; if($janmargrossactual != 0){ echo '
                        <td><a class="actual_quarter_revenue" id="01qrevactual">'.$janmargrossactual.'</a></td>
                    '; }else{ echo '
                        <td>'.$janmargrossactual.'</td>
                    '; } echo '
                    '; if($aprjungrossactual != 0){ echo '
                        <td><a class="actual_quarter_revenue" id="04qrevactual">'.$aprjungrossactual.'</a></td>
                    '; }else{ echo '
                        <td>'.$aprjungrossactual.'</td>
                    '; } echo '
                    '; if($julsepgrossactual != 0){ echo '
                        <td><a class="actual_quarter_revenue" id="07qrevactual">'.$julsepgrossactual.'</a></td>
                    '; }else{ echo '
                        <td>'.$julsepgrossactual.'</td>
                    '; } echo '
                    '; if($octdecgrossactual != 0){ echo '
                        <td><a class="actual_quarter_revenue" id="10qrevactual">'.$octdecgrossactual.'</a></td>
                    '; }else{ echo '
                        <td>'.$octdecgrossactual.'</td>
                    '; }
                     echo '
                    '; if($monthgrossactual != 0){ echo '
                        <td><a class="total_actual_month_revenue" >'.$monthgrossactual.'</a></td>
                    '; }else{ echo '
                        <td>'.$monthgrossactual.'</td>
                    '; }
                    echo'
                    <td>
                    <a href="'.url("gross_quarter_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>
                    ';
                    echo '

                </tr>
                <tr class="odd gradeX">
                    <td class="fixed-side">Other Revenue  <input type="checkbox" class="form-gorup" checked onchange="uncheck(event)"></td>
                    '; if($janmarotherrevenue != 0){ echo '
                        <td data-count="true"><a class="quarteractual_other_revenue" id="01qotheractual">'.$janmarotherrevenue.'</a></td>
                    '; }else{ echo '
                        <td>'.$janmarotherrevenue.'</td>
                    '; } echo '
                    '; if($aprjunotherrevenue != 0){ echo '
                        <td data-count="true"><a class="quarteractual_other_revenue" id="04qotheractual">'.$aprjunotherrevenue.'</a></td>
                    '; }else{ echo '
                        <td>'.$aprjunotherrevenue.'</td>
                    '; } echo '
                    '; if($julsepotherrevenue != 0){ echo '
                        <td data-count="true"><a class="quarteractual_other_revenue" id="07qotheractual">'.$julsepotherrevenue.'</a></td>
                    '; }else{ echo '
                        <td>'.$julsepotherrevenue.'</td>
                    '; } echo '
                    '; if($octdecotherrevenue != 0){ echo '
                        <td data-count="true"><a class="quarteractual_other_revenue" id="10qotheractual">'.$octdecotherrevenue.'</a></td>
                    '; }else{ echo '
                        <td>'.$octdecotherrevenue.'</td>
                    '; }
                     echo '
                    '; if($monthotherrevenue != 0){ echo '
                        <td><a class="total_actual_other_revenue" >'.$monthotherrevenue.'</a></td>
                    '; }else{ echo '
                        <td>'.$monthotherrevenue.'</td>
                    '; }
                     echo'
                    <td>
                   <i class="fa fa-bar-chart"></i>
                </td>
                    ';
                    echo '

                </tr>
                <tr class="total-tr">
                    <td class="fixed-side" style=""><b>Total Revenue</b></td>
                    <td data-count="true" data-count="true"><a class="quaterly_total_revenue" data-month="01">'.$janmartotalactual.'</a></td>
                    <td data-count="true" data-count="true"><a class="quaterly_total_revenue" data-month="04">'.$aprjuntotalactual.'</a></td>
                    <td data-count="true" data-count="true"><a class="quaterly_total_revenue" data-month="07">'.$julseptotalactual.'</a></td>
                    <td data-count="true" data-count="true"><a class="quaterly_total_revenue" data-month="10">'.$octdectotalactual.'</a></td>
                    <td data-count="true" data-count="true"><a class="total_yearly_revenue" href="javascript:void(0)">'.$monthtotalactual.'</a></td>

                    <td>
                    <a href="'.url("all_quarter_revenue_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>

                </tr>
                <tr>
                    <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
                foreach($expensess as $value){
                    echo '
                    <tr class="odd gradeX">
                        <td class="fixed-side">'.$value->account_description.'  <input type="checkbox" class="form-gorup" checked onchange="uncheck(event)"></td>';
                        $jantotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', $value->account_description)->sum('amount_paid');
                        $febtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', $value->account_description)->sum('amount_paid');
                        $martotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', $value->account_description)->sum('amount_paid');
                        $actual_janmar = $jantotal2actual + $febtotal2actual + $martotal2actual;
                        if($actual_janmar!= 0){ echo '
                            <td><a class="actual_quarterly_expense" id="01qactualexpense'.$value->account_description.'">'.$actual_janmar.'</a></td>';
                        }else{ echo '
                            <td>'.$actual_janmar.'</td>
                        '; }
                         $aprtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', $value->account_description)->sum('amount_paid');
                        $maytotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', $value->account_description)->sum('amount_paid');
                        $juntotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', $value->account_description)->sum('amount_paid');
                        $actual_aprjun = $aprtotal2actual + $maytotal2actual + $juntotal2actual;
                        if($actual_aprjun!= 0){ echo '
                            <td><a class="actual_quarterly_expense" id="04qactualexpense'.$value->account_description.'">'.$actual_aprjun.'</a></td>
                        '; }else{ echo '
                            <td>'.$actual_aprjun.'</td>
                        '; }
                        $jultotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', $value->account_description)->sum('amount_paid');
                        $augtotal2actual = DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', $value->account_description)->sum('amount_paid');
                        $septotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', $value->account_description)->sum('amount_paid');
                        $actual_julsep = $jultotal2actual + $augtotal2actual + $septotal2actual;
                        if($actual_julsep!= 0){ echo '
                            <td><a class="actual_quarterly_expense" id="07qactualexpense'.$value->account_description.'">'.$actual_julsep.'</a></td>
                        '; }else{ echo '
                            <td>'.$actual_julsep.'</td>
                        '; }
                        $octtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', $value->account_description)->sum('amount_paid');
                        $novtotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', $value->account_description)->sum('amount_paid');
                        $dectotal2actual = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', $value->account_description)->sum('amount_paid');
                        $actual_octdec = $octtotal2actual + $novtotal2actual + $dectotal2actual;
                        if($actual_octdec!= 0){ echo '
                            <td><a class="actual_quarterly_expense" id="10qactualexpense'.$value->account_description.'">'.$actual_octdec.'</a></td>
                        '; }else{ echo '
                            <td>'.$actual_octdec.'</td>
                        '; }
                        $actual_total2 = DB::table('expense_record')->whereYear('transaction_date', $year)->where('account_description', $value->account_description)->where('uid', $uid)->sum('amount_paid');
                         if($actual_total2!= 0){ echo '
                            <td><a class="total_actual_monthly_expense" id="12actualexpense'.$value->account_description.'">'.$actual_total2.'</a></td>
                        '; }else{ echo '
                            <td>'.$actual_total2.'</td>
                        '; }
                      echo'
                            <td>
                                <a href="'.url("expense_variance_quarterly_graph/$value->account_description").'"><i class="fa fa-bar-chart"></i></a>
                            </td>
                        ';

                        echo '

                    </tr>
                '; } echo '
                <tr class="total2-tr">
                    <td class="fixed-side" style=""><b>Total Expenses</b></td>
                    <td data-count="true" data-count="true" data-count="true"><a class="quaterly_total_expense" data-month="01">'.$janmartotal2actual.'</a></td>
                    <td data-count="true" data-count="true" data-count="true"><a class="quaterly_total_expense" data-month="04">'.$aprjuntotal2actual.'</a></td>
                    <td data-count="true" data-count="true" data-count="true"><a class="quaterly_total_expense" data-month="07">'.$julseptotal2actual.'</a></td>
                    <td data-count="true" data-count="true" data-count="true"><a class="quaterly_total_expense" data-month="10">'.$octdectotal2actual.'</a></td>
                    <td data-count="true" data-count="true" data-count="true"><a class="total_yearly_expenses" href="javascript:void(0)">'.($janmartotal2actual + $aprjuntotal2actual + $julseptotal2actual + $octdectotal2actual).'</a></td>
                    </td>
                    <td>
                    <a href="'.url("expense_quarterly_vary_chart").'"><i class="fa fa-bar-chart"></i></a>
                </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                    <td data-count="true"><a class="qly_total_revenue_expense" data-month="01">'.($janmartotalactual-$janmartotal2actual).'</a></td>
                    <td data-count="true"><a class="qly_total_revenue_expense" data-month="04">'.($aprjuntotalactual-$aprjuntotal2actual).'</a></td>
                    <td data-count="true"><a class="qly_total_revenue_expense" data-month="07">'.($julseptotalactual-$julseptotal2actual).'</a></td>
                    <td data-count="true"><a class="qly_total_revenue_expense" data-month="10">'.($octdectotalactual-$octdectotal2actual).'</a></td>
                    <td data-count="true"><a class="qly_total_revenue_expense" data-month="all">'.($monthtotalactual-($janmartotal2actual + $aprjuntotal2actual + $julseptotal2actual + $octdectotal2actual)).'</a></td>
                   <td>
                    <i class="fa fa-bar-chart"></i>
                </td>
                </tr>
            </tfoot>

            <script>
         function uncheck(event){
        event.target.parentNode.parentNode.style.display="none";
        event.target.parentNode.parentNode.setAttribute("data-uncheck",true);
        let td = document.querySelectorAll("#monthlyfinancetable > tbody > tr > td");
        let jultotal = 0 ;
        for(let i = 0; i<td.length; i++ ){
        if(td[i].hasAttribute("data-count")){

            if(td[i].getAttribute("data-count")== "aug" && !td[i].parentNode.hasAttribute("data-uncheck") ){
                if(td[i].querySelector("a")){
                    console.log(td[i].querySelector("a").innerHTML);
                    jultotal=parseInt(jultotal)+parseInt(td[i].querySelector("a").innerHTML);
                }else{
                     console.log(td[i].innerHTML);
                     jultotal=parseInt(jultotal)+parseInt(td[i].innerHTML);
                }
            }
        }


        }

    //     let totalrevenuejul = 0;
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_jul").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_gul").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_gul").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenuejul = parseInt(totalrevenuejul) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_jul").querySelector("a").innerHTML);
    //         }
    //     }
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_jul").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_jul").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_jul").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenuejul = parseInt(totalrevenuejul) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_jul").innerHTML);
    //         }
    //     }
    //   document.querySelector("#monthlyfinancetable > tbody .revenue_by_aug").innerHTML =   totalrevenuejul ;


    //     let totalrevenueaug = 0;
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenueaug = parseInt(totalrevenueaug) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_month_revenue_aug").querySelector("a").innerHTML);
    //         }
    //     }
    //     if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").hasAttribute("data-count")){

    //         if(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").getAttribute("data-count")== "aug" && !document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").parentNode.hasAttribute("data-uncheck") ){
    //           totalrevenueaug = parseInt(totalrevenueaug) + parseInt(document.querySelector("#monthlyfinancetable > tbody .actual_other_revenue_aug").innerHTML);
    //         }
    //     }
    //   document.querySelector("#monthlyfinancetable > tbody .revenue_by_aug").innerHTML =   totalrevenueaug ;

            }
            </script>

            ';

    }
    public function appointmentdashboardcount(Request $request)
    {
        $val = $request->val;
        $uid = "";
        $link = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $appointments = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('appointments')->whereDate('appointment_date', '=', date('Y-m-d'))->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url('manage_appointment?daily=').$date;
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('appointments')->whereMonth('appointment_date', '=', date('m'))->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
            $link=url('manage_appointment?monthly=').date('m');
        }
        elseif($val == "Weekly"){
            $appointments = DB::table('appointments')->whereBetween('appointment_date', [$sunday, $saturday])->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $dd = date('w', strtotime($date));
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_appointment?sdate=$start2&edate=$end2");

        }
        return $arr = [$appointments, $datetitlee,$link];
    }
    public function appointmentdashboardcountbasis(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $count_basis = $request->count_basis;
        $appointments = "";
        $link = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('appointments')->whereDate('appointment_date', '=', $date)->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url("manage_appointment?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $appointments = DB::table('appointments')->whereMonth('appointment_date', '=', $month)->whereYear('appointment_date', '=', $year)->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
            $link=url("manage_appointment?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $appointments = DB::table('appointments')->whereBetween('appointment_date', [$sunday, $saturday])->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));
            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_appointment?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function appointmentdashboardcountbasiss(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $count_basis = $request->count_basis;
        $appointments = "";
        $link = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('appointments')->whereDate('appointment_date', '=', $date)->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url("manage_appointment?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $appointments = DB::table('appointments')->whereMonth('appointment_date', '=', $month)->whereYear('appointment_date', '=', $year)->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
            $link=url("manage_appointment?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $appointments = DB::table('appointments')->whereBetween('appointment_date', [$sunday, $saturday])->where('uid', $uid)->where('appointments.cstatus', "on")->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));
            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_appointment?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function new_client_lists(Request $request)
    {
         $data['mode']='';
       $daily=$request->input('daily');
       $sdate=$request->input('sdate');
       $edate=$request->input('edate');
       $monthly=$request->input('monthly');
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
            }
        $uid = "";
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
        $data['top_banners'] = ClientManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();


if(!empty($daily)){
         $data['mode']='daily';

         $data['clients'] = ClientAppointmentList::where('uid', $uid)->where('uid', $uid)->whereDate('created_at', '=', $daily)->get();
        }elseif(!empty($monthly)){
          $data['mode']='monthly';

          $data['clients'] = ClientAppointmentList::where('uid', $uid)->whereMonth('created_at',$monthly)->whereYear('created_at', date('Y'))->get();
        }elseif (!empty($sdate) && !empty($edate)) {
           $data['mode']='weekly';

           $data['clients'] = ClientAppointmentList::where('uid', $uid)->whereBetween('created_at', [$sdate, $edate])->get();
        }else{
        $data['clients'] = ClientAppointmentList::where('uid', $uid)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();
        }
        $data['category'] = CardCategory::orderBy('category','desc')->get();
        $data['cards'] = UploadCard::groupBy('category')->get();
        //print_r($data['top_banners']);die();
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
        return view('main.new_client_lists')->with($data);
    }
    public function dashboard_revenue_report()
    {
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
            }
        $uid = "";
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
        $data['top_banners'] = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['revenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', date('m'))->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
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
        return view('main.dashboard_revenue_report')->with($data);
    }
    public function dashboard_expenses_report()
    {
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
            }
        $uid = "";
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
        $data['top_banners'] = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        // $data['revenue'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['revenue'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', date('m'))->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();

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
        return view('main.dashboard_expenses_report')->with($data);
    }
    public function dashboard_profit_loss_stmt()
    {
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
            }
        $uid = "";
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
        $data['top_banners'] = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $month = Carbon::now()->format('m');
        $mon = "";
        if($month == "01"){$mon = "jan";}elseif($month == "02"){$mon = "feb";}elseif($month == "03"){$mon = "mar";}elseif($month == "04"){$mon = "apr";}elseif($month == "05"){$mon = "may";}elseif($month == "06"){$mon = "jun";}elseif($month == "07"){$mon = "jul";}elseif($month == "08"){$mon = "aug";}elseif($month == "09"){$mon = "sep";}elseif($month == "10"){$mon = "oct";}elseif($month == "11"){$mon = "nov";}elseif($month == "12"){$mon = "decem";}
        $year = Carbon::now()->format('Y');
        $textdt=$year."-".$month."-01";
        // $textdt = "2021-02-02";
        $dt= strtotime( $textdt);
        $currdt=$dt;
        $nextmonth=strtotime($textdt."+1 month");
        $i=0;
        $weeklycnt = [];
        $weeklycnt2 = [];
        $data['startdates'] = [];
        $data['enddates'] = [];
        do
        {
            $weekday= date("w",$currdt);
            $nextday=7-$weekday;
            $endday=abs($weekday-6);
            $startarr[$i]=$currdt;
            $endarr[$i]=strtotime(date("Y-m-d",$currdt)."+$endday day");
            $currdt=strtotime(date("Y-m-d",$endarr[$i])."+1 day");
            $end = "";
            if($endarr[$i] < $nextmonth){
                $end = $endarr[$i];
            }
            else{
                $end = strtotime(Carbon::now()->endOfMonth()->toDateString());
            }
            $countweek = DB::table('revenue_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$end))->where('uid', $uid)->where('account_description', '!=', 'Other Revenue')->sum('bill');
            $countweek2 = DB::table('revenue_record')->whereDate('transaction_date', '>=', date("Y-m-d",$startarr[$i]))->whereDate('transaction_date', '<=', date("Y-m-d",$end))->where('uid', $uid)->where('account_description', 'Other Revenue')->sum('bill');

            // print_r($countweek);
            array_push($data['startdates'], date('Y-m-d', $startarr[$i]));
            array_push($data['enddates'], date('Y-m-d', $end));
            array_push($weeklycnt, $countweek);
            array_push($weeklycnt2, $countweek2);
            $i++;

        }while($endarr[$i-1]<$nextmonth);
        $data['week1'] = $weeklycnt[0];
        $data['week2'] = $weeklycnt[1];
        $data['week3'] = $weeklycnt[2];
        $data['week4'] = $weeklycnt[3];
        $data['week5'] = $weeklycnt[4];
        $data['week1s'] = $weeklycnt2[0];
        $data['week2s'] = $weeklycnt2[1];
        $data['week3s'] = $weeklycnt2[2];
        $data['week4s'] = $weeklycnt2[3];
        $data['week5s'] = $weeklycnt2[4];
        $data['weekcnt'] = $i;

        $data['revenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['alljantotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['allfebtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['allmartotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['allaprtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['allmaytotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('may');
        $data['alljuntotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['alljultotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['allaugtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['allseptotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['allocttotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['allnovtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['alldectotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['allmonthtotal'] = $data['alljantotal'] + $data['allfebtotal'] + $data['allmartotal'] + $data['allaprtotal'] + $data['allmaytotal'] + $data['alljuntotal'] + $data['alljultotal'] + $data['allaugtotal'] + $data['allseptotal'] + $data['allocttotal'] + $data['allnovtotal'] + $data['alldectotal'];
        $data['otherjantotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('jan');
        $data['otherfebtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('feb');
        $data['othermartotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('mar');
        $data['otheraprtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('apr');
        $data['othermaytotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('may');
        $data['otherjuntotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('jun');
        $data['otherjultotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('jul');
        $data['otheraugtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('aug');
        $data['otherseptotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('sep');
        $data['otherocttotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('oct');
        $data['othernovtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('nov');
        $data['otherdectotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', 'Other Revenue')->sum('decem');
        $data['othermonthtotal'] = $data['otherjantotal'] + $data['otherfebtotal'] + $data['othermartotal'] + $data['otheraprtotal'] + $data['othermaytotal'] + $data['otherjuntotal'] + $data['otherjultotal'] + $data['otheraugtotal'] + $data['otherseptotal'] + $data['otherocttotal'] + $data['othernovtotal'] + $data['otherdectotal'];
        $data['jantotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['febtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['martotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['aprtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['maytotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['juntotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['jultotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['augtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['septotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['octtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['novtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['dectotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['monthtotal'] = $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['revenue_quaterly'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['janmartotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('janmar');
        $data['aprjuntotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aprjun');
        $data['julseptotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('julsep');
        $data['octdectotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('octdec');
        $data['quaterlytotal'] = $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['alljanmartotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','!=','Other Revenue')->sum('janmar');
        $data['allaprjuntotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','!=','Other Revenue')->sum('aprjun');
        $data['alljulseptotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','!=','Other Revenue')->sum('julsep');
        $data['alloctdectotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','!=','Other Revenue')->sum('octdec');
        $data['allquaterlytotal'] = $data['alljanmartotal'] + $data['allaprjuntotal'] + $data['alljulseptotal'] + $data['alloctdectotal'];
        $data['otherjanmartotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','Other Revenue')->sum('janmar');
        $data['otheraprjuntotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','Other Revenue')->sum('aprjun');
        $data['otherjulseptotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','Other Revenue')->sum('julsep');
        $data['otheroctdectotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name','Other Revenue')->sum('octdec');
        $data['otherquaterlytotal'] = $data['otherjanmartotal'] + $data['otheraprjuntotal'] + $data['otherjulseptotal'] + $data['otheroctdectotal'];
        $data['expenses'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['jantotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['febtotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['martotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['aprtotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['maytotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['juntotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['jultotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['augtotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['septotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['octtotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['novtotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['dectotall'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['monthtotall'] = $data['jantotall'] + $data['febtotall'] + $data['martotall'] + $data['aprtotall'] + $data['maytotall'] + $data['juntotall'] + $data['jultotall'] + $data['augtotall'] + $data['septotall'] + $data['octtotall'] + $data['novtotall'] + $data['dectotall'];
        $data['expenses_quaterly'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['janmartotall'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('janmar');
        $data['aprjuntotall'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aprjun');
        $data['julseptotall'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('julsep');
        $data['octdectotall'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('octdec');
        $data['quaterlytotall'] = $data['janmartotall'] + $data['aprjuntotall'] + $data['julseptotall'] + $data['octdectotall'];
        $data['jantotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['febtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['martotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['aprtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['maytotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['juntotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['jultotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['augtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['septotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['octtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['novtotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['dectotal'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['monthtotal'] = $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['jangrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['febgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['margrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['aprgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['maygrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('may');
        $data['jungrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['julgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['auggrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['sepgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['octgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['novgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['decgrosstotal2'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['monthgrosstotal2'] = $data['jangrosstotal2'] + $data['febgrosstotal2'] + $data['margrosstotal2'] + $data['aprgrosstotal2'] + $data['maygrosstotal2'] + $data['jungrosstotal2'] + $data['julgrosstotal2'] + $data['auggrosstotal2'] + $data['sepgrosstotal2'] + $data['octgrosstotal2'] + $data['novgrosstotal2'] + $data['decgrosstotal2'];
        $data['jangrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['febgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['margrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['aprgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['maygrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['jungrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['julgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['auggrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['sepgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['octgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['novgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['decgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['monthgrossactual'] = $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'] + $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'] + $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'] + $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['jantotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->sum('bill');
        $data['febtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->sum('bill');
        $data['martotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->sum('bill');
        $data['aprtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->sum('bill');
        $data['maytotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->sum('bill');
        $data['juntotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->sum('bill');
        $data['jultotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->sum('bill');
        $data['augtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->sum('bill');
        $data['septotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->sum('bill');
        $data['octtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->sum('bill');
        $data['novtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->sum('bill');
        $data['dectotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->sum('bill');
        $data['monthtotalactual'] = $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'] + $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'] + $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'] + $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['janothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jan');
        $data['febothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('feb');
        $data['marothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('mar');
        $data['aprothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('apr');
        $data['mayothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('may');
        $data['junothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jun');
        $data['julothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jul');
        $data['augothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('aug');
        $data['sepothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('sep');
        $data['octothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('oct');
        $data['novothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('nov');
        $data['decothrevenue'] = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('decem');
        $data['monthothrevenue'] = $data['janothrevenue'] + $data['febothrevenue'] + $data['marothrevenue'] + $data['aprothrevenue'] + $data['mayothrevenue'] + $data['junothrevenue'] + $data['julothrevenue'] + $data['augothrevenue'] + $data['sepothrevenue'] + $data['octothrevenue'] + $data['novothrevenue'] + $data['decothrevenue'];
        $data['janotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['febotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['marotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['aprotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['mayotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['junotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['julotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['augotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['sepotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['octotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['novotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['decotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['monthotherrevenue'] = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'] + $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'] + $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'] + $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['expense'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->get();
        $data['jantotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['febtotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['martotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['aprtotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['maytotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['juntotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['jultotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['augtotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['septotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['octtotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['novtotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['dectotal2'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['monthtotal2'] = $data['jantotal2'] + $data['febtotal2'] + $data['martotal2'] + $data['aprtotal2'] + $data['maytotal2'] + $data['juntotal2'] + $data['jultotal2'] + $data['augtotal2'] + $data['septotal2'] + $data['octtotal2'] + $data['novtotal2'] + $data['dectotal2'];
        $data['jantotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['monthtotal2actual'] = $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'] + $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'] + $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'] + $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['ejantotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['efebtotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['emartotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['eaprtotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['emaytotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['ejuntotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['ejultotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['eaugtotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['eseptotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['eocttotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['enovtotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['edectotal'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['emonthtotal'] = $data['ejantotal'] + $data['efebtotal'] + $data['emartotal'] + $data['eaprtotal'] + $data['emaytotal'] + $data['ejuntotal'] + $data['ejultotal'] + $data['eaugtotal'] + $data['eseptotal'] + $data['eocttotal'] + $data['enovtotal'] + $data['edectotal'];
        $data['ejangrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['efebgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['emargrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['eaprgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['emaygrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('may');
        $data['ejungrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['ejulgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['eauggrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['esepgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['eoctgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['enovgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['edecgrosstotal2'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['emonthgrosstotal2'] = $data['ejangrosstotal2'] + $data['efebgrosstotal2'] + $data['emargrosstotal2'] + $data['eaprgrosstotal2'] + $data['emaygrosstotal2'] + $data['ejungrosstotal2'] + $data['ejulgrosstotal2'] + $data['eauggrosstotal2'] + $data['esepgrosstotal2'] + $data['eoctgrosstotal2'] + $data['enovgrosstotal2'] + $data['edecgrosstotal2'];
        $data['ejangrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['efebgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emargrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eaprgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emaygrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejungrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejulgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eauggrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['esepgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eoctgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['enovgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['edecgrossactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emonthgrossactual'] = $data['ejangrossactual'] + $data['efebgrossactual'] + $data['emargrossactual'] + $data['eaprgrossactual'] + $data['emaygrossactual'] + $data['ejungrossactual'] + $data['ejulgrossactual'] + $data['eauggrossactual'] + $data['esepgrossactual'] + $data['eoctgrossactual'] + $data['enovgrossactual'] + $data['edecgrossactual'];
        $data['ejantotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->sum('bill');
        $data['efebtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->sum('bill');
        $data['emartotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->sum('bill');
        $data['eaprtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->sum('bill');
        $data['emaytotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->sum('bill');
        $data['ejuntotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->sum('bill');
        $data['ejultotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->sum('bill');
        $data['eaugtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->sum('bill');
        $data['eseptotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->sum('bill');
        $data['eocttotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->sum('bill');
        $data['enovtotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->sum('bill');
        $data['edectotalactual'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->sum('bill');
        $data['emonthtotalactual'] = $data['ejantotalactual'] + $data['efebtotalactual'] + $data['emartotalactual'] + $data['eaprtotalactual'] + $data['emaytotalactual'] + $data['ejuntotalactual'] + $data['ejultotalactual'] + $data['eaugtotalactual'] + $data['eseptotalactual'] + $data['eocttotalactual'] + $data['enovtotalactual'] + $data['edectotalactual'];
        $data['ejanothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jan');
        $data['efebothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('feb');
        $data['emarothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('mar');
        $data['eaprothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('apr');
        $data['emayothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('may');
        $data['ejunothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jun');
        $data['ejulothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('jul');
        $data['eaugothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('aug');
        $data['esepothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('sep');
        $data['eoctothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('oct');
        $data['enovothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('nov');
        $data['edecothrevenue'] = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('decem');
        $data['emonthothrevenue'] = $data['ejanothrevenue'] + $data['efebothrevenue'] + $data['emarothrevenue'] + $data['eaprothrevenue'] + $data['emayothrevenue'] + $data['ejunothrevenue'] + $data['ejulothrevenue'] + $data['eaugothrevenue'] + $data['esepothrevenue'] + $data['eoctothrevenue'] + $data['enovothrevenue'] + $data['edecothrevenue'];
        $data['ejanotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['efebotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emarotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaprotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emayotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejunotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejulotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaugotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['esepotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eoctotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['enovotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['edecotherrevenue'] = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emonthotherrevenue'] = $data['ejanotherrevenue'] + $data['efebotherrevenue'] + $data['emarotherrevenue'] + $data['eaprotherrevenue'] + $data['emayotherrevenue'] + $data['ejunotherrevenue'] + $data['ejulotherrevenue'] + $data['eaugotherrevenue'] + $data['esepotherrevenue'] + $data['eoctotherrevenue'] + $data['enovotherrevenue'] + $data['edecotherrevenue'];
        $data['eexpense'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->get();
        $data['ejantotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jan');
        $data['efebtotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('feb');
        $data['emartotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('mar');
        $data['eaprtotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('apr');
        $data['emaytotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('may');
        $data['ejuntotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jun');
        $data['ejultotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('jul');
        $data['eaugtotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aug');
        $data['eseptotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('sep');
        $data['eocttotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('oct');
        $data['enovtotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('nov');
        $data['edectotal2'] = DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('decem');
        $data['emonthtotal2'] = $data['ejantotal2'] + $data['efebtotal2'] + $data['emartotal2'] + $data['eaprtotal2'] + $data['emaytotal2'] + $data['ejuntotal2'] + $data['ejultotal2'] + $data['eaugtotal2'] + $data['eseptotal2'] + $data['eocttotal2'] + $data['enovtotal2'] + $data['edectotal2'];
        $data['ejantotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['efebtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['emartotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['eaprtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['emaytotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['ejuntotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['ejultotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['eaugtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['eseptotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['eocttotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['enovtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['edectotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['emonthtotal2actual'] = $data['ejantotal2actual'] + $data['efebtotal2actual'] + $data['emartotal2actual'] + $data['eaprtotal2actual'] + $data['emaytotal2actual'] + $data['ejuntotal2actual'] + $data['ejultotal2actual'] + $data['eaugtotal2actual'] + $data['eseptotal2actual'] + $data['eocttotal2actual'] + $data['enovtotal2actual'] + $data['edectotal2actual'];
        $data['janmartotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('janmar');
        $data['aprjuntotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aprjun');
        $data['julseptotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('julsep');
        $data['octdectotal'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('octdec');
        $data['monthtotal'] = $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['janmargrosstotal2'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('janmar');
        $data['aprjungrosstotal2'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('aprjun');
        $data['julsepgrosstotal2'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('julsep');
        $data['octdecgrosstotal2'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '!=', 'Other Revenue')->sum('octdec');
        $data['monthgrosstotal2'] = $data['janmargrosstotal2'] + $data['aprjungrosstotal2'] + $data['julsepgrosstotal2'] + $data['octdecgrosstotal2'];
         $data['janmargrossactual'] = $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'];
        $data['aprjungrossactual'] = $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'];
        $data['julsepgrossactual'] = $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'];
        $data['octdecgrossactual'] = $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['monthgrossactual'] = $data['janmargrossactual'] + $data['aprjungrossactual'] + $data['julsepgrossactual'] + $data['octdecgrossactual'];
        $data['janmarothrevenue'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('janmar');
        $data['aprjunothrevenue'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('aprjun');
        $data['julsepothrevenue'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('julsep');
        $data['octdecothrevenue'] = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->where('name', '==', 'Other Revenue')->sum('octdec');
        $data['monthothrevenue'] = $data['janmarothrevenue'] + $data['aprjunothrevenue'] + $data['julsepothrevenue'] + $data['octdecothrevenue'];
        $data['janmarotherrevenue'] = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'];
        $data['aprjunotherrevenue'] = $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'];
        $data['julsepotherrevenue'] = $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'];
        $data['octdecotherrevenue'] = $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['monthotherrevenue'] = $data['janmarotherrevenue'] + $data['aprjunotherrevenue'] + $data['julsepotherrevenue'] + $data['octdecotherrevenue'];
        $data['janmartotalactual'] = $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'];
        $data['aprjuntotalactual'] = $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'];
        $data['julseptotalactual'] = $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'];
        $data['octdectotalactual'] = $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['monthtotalactual'] = $data['janmartotalactual'] + $data['aprjuntotalactual'] + $data['julseptotalactual'] + $data['octdectotalactual'];
        $data['expensess'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->get();
        $data['janmartotal2'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('janmar');
        $data['aprjuntotal2'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('aprjun');
        $data['julseptotal2'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('julsep');
        $data['octdectotal2'] = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->sum('octdec');
        $data['monthtotal2'] = $data['janmartotal2'] + $data['aprjuntotal2'] + $data['julseptotal2'] + $data['octdectotal2'];
        $data['jantotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] = DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['janmartotal2actual'] = $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'];
        $data['aprjuntotal2actual'] = $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'];
        $data['julseptotal2actual'] = $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'];
        $data['octdectotal2actual'] = $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['monthtotal2actual'] = $data['janmartotal2actual'] + $data['aprjuntotal2actual'] + $data['julseptotal2actual'] + $data['octdectotal2actual'];
        $data['assets'] = DB::table('asset_record')->where('uid', $uid)->whereYear('created_at', date('Y'))->groupBy('description')->orderBy('id', 'desc')->get();
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
        return view('main.dashboard_profit_loss_stmt')->with($data);
    }
    public function dashboard_manage_appointment()
    {
        if(Auth::id() == NULL){
            return redirect('/home')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/home')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){

                return redirect('/home')->with('status',"Admin can't access this page.");
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
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = CardCategory::orderBy('category','desc')->get();
        $data['cards'] = UploadCard::groupBy('category')->get();
        // $data['appointments'] = DB::table('appointments')->select('*', 'appointments.id AS aid')->join('client_appointment_lists', 'appointments.appointment_id', 'client_appointment_lists.id')->where('appointments.uid', Auth::id())->orderBy('appointments.id', 'desc')->get();
        $data['appointments'] = DB::table('appointments')
                        ->select('appointments.id AS aid', 'appointments.appointment_date AS appointment_date', 'appointments.appointment_time AS appointment_time', 'appointments.cstatus AS cstatus', 'appointments.appointment_reason as appointment_reason',  'client_appointment_lists.first_name as client_first_name', 'client_appointment_lists.last_name as client_last_name', 'client_appointment_lists.email as client_email', 'client_appointment_lists.company as client_company', 'client_appointment_lists.address as client_address', 'client_appointment_lists.state as client_state','client_appointment_lists.country as client_country', 'client_appointment_lists.zip_code as client_zip', 'client_appointment_lists.city as client_city', 'client_appointment_lists.cell_phone as client_phone', 'client_appointment_lists.id as cid', 'appointments.appointment_date as appointment_date', 'appointments.appointment_time as appointment_time', 'appointments.appointment_end as appointment_end', 'appointments.appointment_reason as appointment_reason', 'affiliate_registrations.first_name as affiliate_first_name', 'affiliate_registrations.last_name as affiliate_last_name', 'affiliate_registrations.email as affiliate_email', 'affiliate_registrations.image as affiliate_image', 'affiliate_registrations.cellphone as affiliate_phone', 'affiliate_registrations.address as affiliate_address', 'affiliate_registrations.state as affiliate_state', 'affiliate_registrations.country as affiliate_country', 'affiliate_registrations.city as affiliate_city', 'affiliate_registrations.zip_code as affiliate_zip', 'affiliate_registrations.religion as affiliate_religion', 'affiliate_registrations.business_category as affiliate_category', 'affiliate_registrations.company as affiliate_company')
                        ->join('users', 'users.id', '=', 'appointments.uid')
                        ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                        ->join('client_appointment_lists', 'appointments.appointment_id', '=', 'client_appointment_lists.id')
                        ->where('appointments.uid', Auth::id())
                        ->whereMonth('appointments.appointment_date', date('m'))
                        ->whereYear('appointments.appointment_date', date('Y'))
                        ->orderBy('appointments.id', 'desc')
                        ->get();
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
        return view('main.dashboard_manage_appointment')->with($data);
    }
    public function sales_tax_account(Request $request)
    {
        $val = $request->val;
        if($val == 1){
            //\LogActivity::addToLog('visited profile','view',Auth::user());
            $uid = "";
            if((Auth::user()->role) == "affiliate"){
                $uid = Auth::id();
            }
            else{
                $uid = Auth::user()->affiliate_user_id;
            }
            $values2 = array(
                'name'      => "Sales Tax Collected",
                'jan'       => 0,
                'feb'       => 0,
                'mar'       => 0,
                'apr'       => 0,
                'may'       => 0,
                'jun'       => 0,
                'jul'       => 0,
                'aug'       => 0,
                'sep'       => 0,
                'oct'       => 0,
                'nov'       => 0,
                'decem'     => 0,
                'uid'       => $uid
            );
            $exist1 = DB::table('revenue_budget')->where('name', "Sales Tax Collected")->get();
            if(count($exist1) == 0){
                DB::table('revenue_budget')->insert($values2);
                DB::table('revenue_projection')->insert($values2);
            }
            $values3 = array(
                'name'          => "Sales Tax Collected",
                'janmar'        => 0,
                'aprjun'        => 0,
                'julsep'        => 0,
                'octdec'        => 0,
                'uid'           => $uid
            );
            $exist2 = DB::table('revenue_quaterly_budget')->where('name', "Sales Tax Collected")->get();
            if(count($exist2) == 0){
                DB::table('revenue_quaterly_budget')->insert($values3);
                DB::table('revenue_quaterly_projection')->insert($values3);
            }

            $values = array(
                'account_name'  => "Sales Tax Collected",
                'amount'        => "",
                'date'          => date('Y-m-d'),
                'uid'           => $uid
            );
            $exist3 = DB::table('revenue_account')->where('account_name', "Sales Tax Collected")->get();
            if(count($exist3) == 0){
                DB::table('revenue_account')->insert($values);
            }

            $vvalues2 = array(
                'name'      => "Sales Tax Paid",
                'jan'       => 0,
                'feb'       => 0,
                'mar'       => 0,
                'apr'       => 0,
                'may'       => 0,
                'jun'       => 0,
                'jul'       => 0,
                'aug'       => 0,
                'sep'       => 0,
                'oct'       => 0,
                'nov'       => 0,
                'decem'     => 0,
                'uid'       => $uid
            );
            $exist4 = DB::table('expense_budget')->where('name', "Sales Tax Paid")->get();
            if(count($exist4) == 0){
                DB::table('expense_budget')->insert($vvalues2);
                DB::table('expense_projection')->insert($vvalues2);
            }

            $vvalues3 = array(
                'name'          => "Sales Tax Paid",
                'janmar'        => 0,
                'aprjun'        => 0,
                'julsep'        => 0,
                'octdec'        => 0,
                'uid'           => $uid
            );
            $exist4 = DB::table('expense_quaterly_budget')->where('name', "Sales Tax Paid")->get();
            if(count($exist4) == 0){
                DB::table('expense_quaterly_budget')->insert($vvalues3);
                DB::table('expense_quaterly_projection')->insert($vvalues3);
            }

            $vvalues = array(
                'account_name'  => "Sales Tax Paid",
                'amount'        => "",
                'date'          => date('Y-m-d'),
                'uid'           => $uid
            );
            $exist4 = DB::table('expenses_account')->where('account_name', "Sales Tax Paid")->get();
            if(count($exist4) == 0){
                DB::table('expenses_account')->insert($vvalues);
            }

        }
        else{
            DB::table('revenue_account')->where('account_name', "Sales Tax Collected")->delete();
            DB::table('expenses_account')->where('account_name', "Sales Tax Paid")->delete();
        }
        $notification  = getNotificationMessage(70);
         $message = $notification;
        $subject = "Sales tax account created ";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function shipping_collected(Request $request)
    {
        $val = $request->val;
        if($val == 1){
            //\LogActivity::addToLog('visited profile','view',Auth::user());
            $uid = "";
            if((Auth::user()->role) == "affiliate"){
                $uid = Auth::id();
            }
            else{
                $uid = Auth::user()->affiliate_user_id;
            }
            $values2 = array(
                'name'      => "Shipping Collected",
                'jan'       => 0,
                'feb'       => 0,
                'mar'       => 0,
                'apr'       => 0,
                'may'       => 0,
                'jun'       => 0,
                'jul'       => 0,
                'aug'       => 0,
                'sep'       => 0,
                'oct'       => 0,
                'nov'       => 0,
                'decem'     => 0,
                'uid'       => $uid
            );
            $exst2 = DB::table('revenue_budget')->where('name', "Shipping Collected")->get();
            if(count($exist) == 0){
                DB::table('revenue_budget')->insert($values2);
                DB::table('revenue_projection')->insert($values2);
            }

            $values3 = array(
                'name'          => "Shipping Collected",
                'janmar'        => 0,
                'aprjun'        => 0,
                'julsep'        => 0,
                'octdec'        => 0,
                'uid'           => $uid
            );
            $exst1 = DB::table('revenue_quaterly_budget')->where('name', "Shipping Collected")->get();
            if(count($exist) == 0){
                DB::table('revenue_quaterly_budget')->insert($values3);
                DB::table('revenue_quaterly_projection')->insert($values3);
            }

            $values = array(
                'account_name'  => "Shipping Collected",
                'amount'        => "",
                'date'          => date('Y-m-d'),
                'uid'           => $uid
            );
            $exst = DB::table('revenue_account')->where('account_name', "Shipping Collected")->get();
            if(count($exst) == 0){
                DB::table('revenue_account')->insert($values);
            }
            $vvalues2 = array(
                'name'      => "Shipping Paid",
                'jan'       => 0,
                'feb'       => 0,
                'mar'       => 0,
                'apr'       => 0,
                'may'       => 0,
                'jun'       => 0,
                'jul'       => 0,
                'aug'       => 0,
                'sep'       => 0,
                'oct'       => 0,
                'nov'       => 0,
                'decem'     => 0,
                'uid'       => $uid
            );
            $exist = DB::table('expense_budget')->where('name', "Shipping Paid")->get();
            if(count($exist) == 0){
                DB::table('expense_budget')->insert($vvalues2);
                DB::table('expense_projection')->insert($vvalues2);
            }

            $vvalues3 = array(
                'name'          => "Shipping Paid",
                'janmar'        => 0,
                'aprjun'        => 0,
                'julsep'        => 0,
                'octdec'        => 0,
                'uid'           => $uid
            );
            $existt = DB::table('expense_quaterly_budget')->where('name', "Shipping Paid")->get();
            if(count($existt) == 0){
                DB::table('expense_quaterly_budget')->insert($vvalues3);
                DB::table('expense_quaterly_projection')->insert($vvalues3);
            }


            $vvalues = array(
                'account_name'  => "Shipping Paid",
                'amount'        => "",
                'date'          => date('Y-m-d'),
                'uid'           => $uid
            );
            $exist = DB::table('expenses_account')->where('account_name', "Shipping Paid")->get();
            if(count($exist) == 0){
                DB::table('expenses_account')->insert($vvalues);
            }
        }
        else{
            DB::table('revenue_account')->where('account_name', "Shipping Collected")->delete();
            DB::table('expenses_account')->where('account_name', "Shipping Paid")->delete();
        }
         $notification  = getNotificationMessage(71);
         $message = $notification;
         $subject = "Shipping  Collected ";
         addUserActivity($subject,'add',$notification,$message);
    }
    public static function notification_count()
    {
        return $count = LogActivity::where('user_id', Auth::id())->where('status', 0)->count();
    }
    public function notifications()
    {

        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "off";
        $data['tools'] = "off";
        $data['notifications'] = LogActivity::where('user_id', Auth::id())
                                //->whereDate('created_at', date('Y-m-d'))
                               ->orderBy('id','desc')
                               ->get();
          $da['status']=1;
         LogActivity::where('user_id', Auth::id())->where('status','0')->update($da);
        return view('main.notifications')->with($data);
    }
    public function deactive_user_access_rights(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $email = base64_decode($request->email);
        DB::table('user_access_role')->where('email', $email)->update(['status' => 0]);
        DB::table('users')->where('email', $email)->delete();
          $notification  = getNotificationMessage(72);
         $message = $notification;
         $subject = "User Access Rights Deativated ";
         addUserActivity($subject,'delete',$notification,$message);
        return redirect('user_access_rights')->with('status',"Deactivated successfully");
    }
    public function active_user_access_rights(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
    $total_registered1=DB::table('user_access_role')->where('status',1)->where('sponsor_id',Auth::id())->get();
    $total_registered=60;$total_registered1->count();
    $registration_limit=total_access_user();
    if($registration_limit >$total_registered )
    {
        $email = base64_decode($request->email);
        DB::table('user_access_role')->where('email', $email)->update(['status' => 1]);
        DB::table('users')->where('email', $email)->delete();
         $notification  = getNotificationMessage(73);
         $message = $notification;
         $subject = "User Access Rights Ativated ";
         addUserActivity($subject,'delete',$notification,$message);
        return redirect('user_access_rights')->with('status',"Activated successfully");
    }else{

        return redirect('user_access_rights')->with('status',"Your have cross maximum assign users limits!");
    }
    }

        public function comparisontemplate1()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
        return view('main.comparisontemplate1')->with($data);
    }
    public function comparisontemplate2()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
            if((Auth::user()->role) == "affiliate"){
                $aaid = Auth::user()->email;
            }
            else{
                $aaid = Auth::user()->affiliate_user_email;
            }
            $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
        $data['years'] = [];
        for($i = 0; $i < 10; $i++){
            $lastYear = date("Y", strtotime("-$i years"));
            if($lastYear > 2019){
                array_push($data['years'], $lastYear);
            }
        }
        return view('main.comparisontemplate2')->with($data);
    }
    public function monthlyyearlycomprofitloss(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $allyearmonth = explode(',', $request->allyearmonth);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $email_campaigns = DB::table('revenue_record')->where('uid', $uid)->groupBy('account_description')->get();
        $expense_record = DB::table('expense_record')->where('uid', $uid)->groupBy('account_description')->get();
        if((count($email_campaigns) > 0) || (count($expense_record) > 0)){
            echo '<table class="table table-striped table-hover" style="overflow-x: auto;display: block;margin-top: 10px;"><tr><td style="padding: 0"><table class="table table-striped table-bordered" style="margin-bottom: 0;"><thead><tr><th>Year</th></tr><tr><th>Month</th></tr></thead><tbody>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td></tr><tr><td class="fixed-side">Gross Revenue</td></tr><tr><td class="fixed-side">Other Revenue</td></tr><tr class="total-tr"><td class="fixed-side" style=""><b>Total Revenue</b></td></tr>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td></tr>';
            foreach($expense_record as $value){
                echo '<tr><td class="fixed-side">'.$value->account_description.'</td></tr>';
            }
            echo '<tr class="total-tr"><td class="fixed-side" style=""><b>Total Expenses</b></td></tr><tr></tr>';
            echo '</tbody><tfoot><tr class="text-left"><td class="fixed-side" style="text-align: left;"><b>Estimated Profit &amp; Loss</b></td></tr></tfoot></table></td>';
            foreach($allyearmonth as $details){
                $det = explode('nqd', $details);
                $year = $det[0];
                $mnt = $det[1];
                $month = "";
                if($mnt == 'Jan'){ $month = '01'; }elseif($mnt == 'Feb'){ $month = '02'; }elseif($mnt == 'Mar'){ $month = '03'; }elseif($mnt == 'Apr'){ $month = '04'; }elseif($mnt == 'May'){ $month = '05'; }elseif($mnt == 'Jun'){ $month = '06'; }elseif($mnt == 'Jul'){ $month = '07'; }elseif($mnt == 'Aug'){ $month = '08'; }elseif($mnt == 'Sep'){ $month = '09'; }elseif($mnt == 'Oct'){ $month = '10'; }elseif($mnt == 'Nov'){ $month = '11'; }elseif($mnt == 'Dec'){ $month = '12'; }

                $month_year = $year."-".$month;
                echo '<td style="padding: 0;"><table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; min-width: 150px;"><thead><tr><th colspan="2">'.$year.'</th></tr><tr><th colspan="2">'.$mnt.'</th></tr></thead><tbody><tr><td style="padding: 18px;"></td></tr>';
                $gross_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', '!=', "Other Revenue")->sum('bill');
                $other_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', "Other Revenue")->sum('bill');
                $total_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->sum('bill');
                $total_expense = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->sum('amount_paid');
                if($gross_revenue != 0){
                    echo '<tr><td><a class="actual_month_revenue" id="'.$month.'revactual">'.$gross_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$gross_revenue.'</td></tr>';
                }
                if($other_revenue != 0){
                    echo '<tr><td><a class="actual_other_revenue" id="'.$month.'otheractual">'.$other_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$other_revenue.'</td></tr>';
                }
                echo '<tr class="total-tr"><td>'.($gross_revenue + $other_revenue).'</td></tr><tr><td style="padding: 18px;"></td></tr>';
                foreach($expense_record as $value){
                    $mailcount = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', $value->account_description)->sum('amount_paid');
                    if($mailcount > 0){
                        echo '<tr><td><a class="actual_monthly_expense" id="'.$month.'actualexpense'.$value->account_description.'">'.$mailcount.'</a></td></tr>';
                    }
                    else{
                        echo '<tr><td>'.$mailcount.'</td></tr>';
                    }
                }
                echo '<tr class="total-tr"><td>'.$total_expense.'</td></tr>';
                echo '</tbody><tfoot><tr class="text-left"><td>'.($total_revenue - $total_expense).'</td></tr></tfoot></table></td>';
            }
            echo '<td style="padding: 0;"><table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; min-width: 50px;"><thead><tr><th>Graph</th></tr><tr><th style="padding: 18px;"></th></tr></thead><tbody>';
            echo '<tr><td style="padding: 18px;"></td></tr>';
            echo '<tr><td><a href="'.url("gross_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr><td><a href="'.url("other_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr class="total-tr"><td><a href="'.url("all_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr><td style="padding: 18px;"></td></tr>';
            foreach($expense_record as $value){
                echo '<tr><td><a href="'.url("expense_variance_monthly_graph").'/'.$value->account_description.'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            }
            echo '<tr class="total-tr"><td><a href="'.url("expense_monthly_vary_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '</tbody><tfoot><tr class="text-left"><td style="padding: 18px;"></td></tr></tfoot></table></td></tr></table>';
        }
        else{
            echo '<table class="table table-striped table-bordered table-hover" style="min-width: 300px; margin-top: 10px; text-align: center"><tbody><tr><td style="text-align: center !important;">No Records Found.</tr></tbody></table>';
        }
    }
    public function quarterlyyearlycomprofitloss(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $allyearmonth = explode(',', $request->allyearmonth);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $email_campaigns = DB::table('revenue_record')->where('uid', $uid)->groupBy('account_description')->get();
        $expense_record = DB::table('expense_record')->where('uid', $uid)->groupBy('account_description')->get();
        if((count($email_campaigns) > 0) || (count($expense_record) > 0)){
            echo '<table class="table table-striped table-hover" style="overflow-x: auto;display: block;margin-top: 10px;"><tr><td style="padding: 0"><table class="table table-striped table-bordered" style="margin-bottom: 0;"><thead><tr><th>Year</th></tr><tr><th>Month</th></tr></thead><tbody>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td></tr><tr><td class="fixed-side">Gross Revenue</td></tr><tr><td class="fixed-side">Other Revenue</td></tr><tr class="total-tr"><td class="fixed-side" style=""><b>Total Revenue</b></td></tr>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td></tr>';
            foreach($expense_record as $value){
                echo '<tr><td class="fixed-side">'.$value->account_description.'</td></tr>';
            }
            echo '<tr class="total-tr"><td class="fixed-side" style=""><b>Total Expenses</b></td></tr><tr></tr>';
            echo '</tbody><tfoot class="text-left"><tr><td class="fixed-side" style="text-align: left;"><b>Estimated Profit &amp; Loss</b></td></tr></tfoot></table></td>';
            foreach($allyearmonth as $details){
                $det = explode('nqd', $details);
                $year = $det[0];
                $month = "";
                $mnt = $det[1];
                if($mnt == 'Jan'){ $month = '01';$mon = "January - March"; }elseif($mnt == 'Apr'){ $month = '04';$mon = "April - June"; }elseif($mnt == 'Jul'){ $month = '07';$mon = "July - September"; }elseif($mnt == 'Oct'){ $month = '10';$mon = "October - December"; }
                $month_year = $year."-".$month;
                $month_year1 = $year."-".str_pad((intval($month) +1), 2, '0', STR_PAD_LEFT);
                $month_year2 = $year."-".str_pad((intval($month) +2), 2, '0', STR_PAD_LEFT);
                echo '<td style="padding: 0;"><table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; min-width: 150px;"><thead><tr><th colspan="2">'.$year.'</th></tr><tr><th colspan="2">'.$mon.'</th></tr></thead><tbody><tr><td style="padding: 18px;"></td></tr>';
                $gross_revenue1 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', '!=', "Other Revenue")->sum('bill');
                $gross_revenue2 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->where('account_description', '!=', "Other Revenue")->sum('bill');
                $gross_revenue3 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->where('account_description', '!=', "Other Revenue")->sum('bill');
                $gross_revenue = $gross_revenue1 + $gross_revenue2 + $gross_revenue3;
                $other_revenue1 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', "Other Revenue")->sum('bill');
                $other_revenue2 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->where('account_description', "Other Revenue")->sum('bill');
                $other_revenue3 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->where('account_description', "Other Revenue")->sum('bill');
                $other_revenue = $other_revenue1 + $other_revenue2 + $other_revenue3;
                $total_revenue1 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->sum('bill');
                $total_revenue2 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->sum('bill');
                $total_revenue3 = DB::table('revenue_record')->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->sum('bill');
                $total_revenue = $total_revenue1 + $total_revenue2 + $total_revenue3;
                $total_expense1 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->sum('amount_paid');
                $total_expense2 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->sum('amount_paid');
                $total_expense3 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->sum('amount_paid');
                $total_expense = $total_expense1 + $total_expense2 + $total_expense3;
                if($gross_revenue != 0){
                    echo '<tr><td><a class="actual_month_revenue" id="'.$month.'revactual">'.$gross_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$gross_revenue.'</td></tr>';
                }
                if($other_revenue != 0){
                    echo '<tr><td><a class="actual_other_revenue" id="'.$month.'otheractual">'.$other_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$other_revenue.'</td></tr>';
                }
                echo '<tr class="total-tr"><td>'.($gross_revenue + $other_revenue).'</td></tr><tr><td style="padding: 18px;"></td></tr>';
                foreach($expense_record as $value){
                    $mailcount1 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year . '%')->where('uid', $uid)->where('account_description', $value->account_description)->sum('amount_paid');
                    $mailcount2 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year1 . '%')->where('uid', $uid)->where('account_description', $value->account_description)->sum('amount_paid');
                    $mailcount3 = DB::table('expense_record')->where('created_at', 'like', '%' . $month_year2 . '%')->where('uid', $uid)->where('account_description', $value->account_description)->sum('amount_paid');
                    $mailcount = $mailcount1 + $mailcount2 + $mailcount3;
                    if($mailcount > 0){
                        echo '<tr><td><a class="actual_monthly_expense" id="'.$month.'actualexpense'.$value->account_description.'">'.$mailcount.'</a></td></tr>';
                    }
                    else{
                        echo '<tr><td>'.$mailcount.'</td></tr>';
                    }
                }
                echo '<tr class="total-tr"><td>'.$total_expense.'</td></tr>';
                echo '</tbody><tfoot class="text-left"><tr><td>'.($total_revenue - $total_expense).'</td></tr></tfoot></table></td>';
            }
            echo '<td style="padding: 0;"><table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; min-width: 50px;"><thead><tr><th>Graph</th></tr><tr><th style="padding: 18px;"></th></tr></thead><tbody>';
            echo '<tr><td style="padding: 18px;"></td></tr>';
            echo '<tr><td><a href="'.url("gross_quarter_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr><td><a href="'.url("other_quarter_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr class="total-tr"><td><a href="'.url("all_quarter_revenue_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '<tr><td style="padding: 18px;"></td></tr>';
            foreach($expense_record as $value){
                echo '<tr><td><a href="'.url("expense_variance_quarterly_graph").'/'.$value->account_description.'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            }
            echo '<tr class="total-tr"><td><a href="'.url("expense_quarterly_vary_chart").'"><i class="fa fa-bar-chart"></i></a></td></tr>';
            echo '</tbody><tfoot class="text-left"><tr><td style="padding: 18px;"></td></tr></tfoot></table></td></tr></table>';
        }
        else{
            echo '<table class="table table-striped table-bordered table-hover" style="min-width: 300px; margin-top: 10px; text-align: center"><tbody><tr><td style="text-align: center !important;">No Records Found.</tr></tbody></table>';
        }
    }
    public function yearlycomprofitloss(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $allyearmonth = explode(',', $request->allyearmonth);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $email_campaigns = DB::table('revenue_record')->where('uid', $uid)->groupBy('account_description')->get();
        $expense_record = DB::table('expense_record')->where('uid', $uid)->groupBy('account_description')->get();
        if((count($email_campaigns) > 0) || (count($expense_record) > 0)){
            echo '<table class="table table-striped table-hover" style="overflow-x: auto;display: block;margin-top: 10px;"><tr><td style="padding: 0"><table class="table table-striped table-bordered" style="margin-bottom: 0;"><thead><tr><th>Year</th></tr></thead><tbody>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td></tr><tr><td class="fixed-side">Gross Revenue</td></tr><tr><td class="fixed-side">Other Revenue</td></tr><tr class="total-tr"><td class="fixed-side" style=""><b>Total Revenue</b></td></tr>';
            echo '<tr><td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td></tr>';
            foreach($expense_record as $value){
                echo '<tr><td class="fixed-side">'.$value->account_description.'</td></tr>';
            }
            echo '<tr class="total-tr"><td class="fixed-side" style=""><b>Total Expenses</b></td></tr><tr></tr>';
            echo '</tbody><tfoot><tr class="text-left"><td class="fixed-side" style="text-align: left;"><b>Estimated Profit &amp; Loss</b></td></tr></tfoot></table></td>';
            foreach($allyearmonth as $details){
                echo '<td style="padding: 0;"><table class="table table-striped table-bordered table-hover" style="margin-bottom: 0; min-width: 150px;"><thead><tr><th colspan="2">'.$details.'</th></tr></thead><tbody><tr><td style="padding: 18px;"></td></tr>';
                $gross_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $details . '%')->where('uid', $uid)->where('account_description', '!=', "Other Revenue")->sum('bill');
                $other_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $details . '%')->where('uid', $uid)->where('account_description', "Other Revenue")->sum('bill');
                $total_revenue = DB::table('revenue_record')->where('created_at', 'like', '%' . $details . '%')->where('uid', $uid)->sum('bill');
                $total_expense = DB::table('expense_record')->where('created_at', 'like', '%' . $details . '%')->where('uid', $uid)->sum('amount_paid');
                if($gross_revenue != 0){
                    echo '<tr><td><a class="actual_month_revenue" id="revactual">'.$gross_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$gross_revenue.'</td></tr>';
                }
                if($other_revenue != 0){
                    echo '<tr><td><a class="actual_other_revenue" id="otheractual">'.$other_revenue.'</a></td></tr>';
                }
                else{
                    echo '<tr><td>'.$other_revenue.'</td></tr>';
                }
                echo '<tr class="total-tr"><td>'.($gross_revenue + $other_revenue).'</td></tr><tr><td style="padding: 18px;"></td></tr>';
                foreach($expense_record as $value){
                    $mailcount = DB::table('expense_record')->where('created_at', 'like', '%' . $details . '%')->where('uid', $uid)->where('account_description', $value->account_description)->sum('amount_paid');
                    if($mailcount > 0){
                        echo '<tr><td><a class="actual_monthly_expense" id="actualexpense'.$value->account_description.'">'.$mailcount.'</a></td></tr>';
                    }
                    else{
                        echo '<tr><td>'.$mailcount.'</td></tr>';
                    }
                }
                echo '<tr class="total-tr"><td>'.$total_expense.'</td></tr>';
                echo '</tbody><tfoot><tr class="text-left"><td>'.($total_revenue - $total_expense).'</td></tr></tfoot></table></td>';
            }
            echo '</tr></table>';
        }
        else{
            echo '<table class="table table-striped table-bordered table-hover" style="min-width: 300px; margin-top: 10px; text-align: center"><tbody><tr><td style="text-align: center !important;">No Records Found.</tr></tbody></table>';
        }
    }
    public function member_change_appointment_step(Request $request)
    {
        $changeappointmentid = $request->id;
        Session::put('changeappointmentid', $changeappointmentid);
        $data = DB::table('appointments')->join('client_appointment_lists', 'appointments.appointment_id', 'client_appointment_lists.id')->where('appointments.id', $request->id)->where('appointments.cstatus', "on")->first();
        $first_name = $data->first_name;
        $last_name = $data->last_name;
        $company = $data->company;
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('company', $company);
        Session::put('clientid', $data->appointment_id);
        return redirect('member_appointment_step3');
    }
    public function member_cancel_appointment()
    {
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
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $client = ClientAppointmentList::where('email', Auth::user()->email)->first();

        $data['appointments'] = DB::table('appointments')
                    ->select('*', 'appointments.id AS aid')
                    ->join('client_appointment_lists', 'appointments.appointment_id', 'client_appointment_lists.id')
                    ->where('appointments.appointment_id', $client->id)
                    ->orderBy('appointments.id', 'desc')
                    ->get();
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
        return view('main.member_cancel_appointment')->with($data);
    }
    public function member_delete_appointment(Request $request)
    {
        $id = explode('delete', $request->id);
        $det = DB::table('appointments')->where('id', $id[1])->first();
        $values = array(
                'appointment_id' => $det->appointment_id,
                'appointment_date' => $det->appointment_date,
                'appointment_time' => $det->appointment_time,
                'appointment_end' => $det->appointment_end,
                'appointment_reason' => $det->appointment_reason,
                'additional_comment' => $det->additional_comment,
                'name1' => $det->name1,
                'name2' => $det->name2,
                'name3' => $det->name3,
                'email1' => $det->email1,
                'email2' => $det->email2,
                'email3' => $det->email3,
                'cancel_reason' => $request->delete_reason,
                'uid'   => $det->uid
            );
        $values2 = array('cstatus'  => "off");
        DB::table('cancel_appointment')->insert($values);
            $prevdate = date('d F Y', strtotime($det->appointment_date));
            $prevtime = date('H:i a', strtotime($det->appointment_time));


           $notification  = getNotificationMessage(74);
            $message = $notification;
            $subject = "Appointment Cancellation";

         addUserActivity($subject,'delete',$notification,$message);

        DB::table('appointments')->where('appointments.cstatus', "on")->where('id', $id[1])->update($values2);
    }
    public function member_library_form()
    {
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
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
         if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{

            $client=DB::table('client_appointment_lists')->where('email',Auth::user()->email)->first();
            //$uid = Auth::user()->affiliate_user_id;
            $uid=$client->uid;
        }
       // echo $uid.'=='. Auth::user()->email;die;


       $data['general_forms']= DB::table('affiliate_library_form')->select('library_forms.*')
            ->join('library_forms', 'library_forms.id', '=', 'affiliate_library_form.form_id')
            ->where('affiliate_library_form.form_cat_id', 1)
            ->where('library_forms.status', 1)
            ->where('affiliate_library_form.uid', $uid)
            ->get();
         $data['dentist_forms']=DB::table('affiliate_library_form')->select('library_forms.*')
            ->join('library_forms', 'library_forms.id', '=', 'affiliate_library_form.form_id')
            ->where('affiliate_library_form.form_cat_id', 2)
            ->where('library_forms.status', 1)
            ->where('affiliate_library_form.uid', $uid)
            ->get();
         $data['medical_forms']=DB::table('affiliate_library_form')->select('library_forms.*')
            ->join('library_forms', 'library_forms.id', '=', 'affiliate_library_form.form_id')
            ->where('affiliate_library_form.form_cat_id', 3)
            ->where('library_forms.status', 1)
            ->where('affiliate_library_form.uid', $uid)
            ->get();
         $data['pedriatric_forms']=DB::table('affiliate_library_form')->select('library_forms.*')
            ->join('library_forms', 'library_forms.id', '=', 'affiliate_library_form.form_id')
            ->where('affiliate_library_form.form_cat_id', 4)
            ->where('library_forms.status', 1)
            ->where('affiliate_library_form.uid', $uid)
            ->get();
        return view('main.member_library_form')->with($data);
    }
    public function member_library_form_view($id)
    {
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
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
         if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $client=DB::table('client_appointment_lists')->where('email',Auth::user()->email)->first();
            //$uid = Auth::user()->affiliate_user_id;
            $uid=$client->uid;
        }
     $check= DB::table('affiliate_member_form')->where(['form_id'=>$id,'uid'=>Auth::id()])->first();
     $data['old_form']='';
     if(!empty($check)){
      $data['old_form']=$check->form_data;
     }


       $data['form']=LibraryForm::where(['id'=>$id])->first();
        return view('main.member_library_form_view')->with($data);
    }
 public function download_pdf($id) {
      $data=LibraryForm::where(['id'=>$id])->first();
    $file_path = public_path('files/'.$data->file_path);
    return response()->download($file_path);
  }
public function update_client_forms_library(Request $request)
{

    $data=$request->all();
    $form_data=$request->form_data;
    unset($data['form_data']);
    unset($data['_token']);
     $form_value=json_encode($data);
$check= DB::table('affiliate_member_form')->where(['form_id'=>$request->form_id,'uid'=>Auth::id()])->first();
     if(!empty($check)){
     $values = array(
                    'form_data'  => $form_data,
                    'form_value'  => $form_value,
                    'updated_at' => date('Y-m-d H:i:s'),

                );
        DB::table('affiliate_member_form')->where(['form_id'=>$request->form_id,'uid'=>Auth::id()])->update($values);
          $notification  = getNotificationMessage(75);
            $message = $notification;
         $subject = "Form library updated ";
         addUserActivity($subject,'update',$notification,$message);
     }else{
          $values = array(
                    'form_data'  => $form_data,
                    'form_value'  => $form_value,
                    'form_id'  => $request->form_id,
                    'uid'        => Auth::id(),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),

                );
        DB::table('affiliate_member_form')->insert($values);
            $notification  = getNotificationMessage(68);
            $message = $notification;
         $subject = "Form library added ";
         addUserActivity($subject,'add',$notification,$message);
     }

      //return redirect()->back()->with('status',"Inserted successfully");
      return redirect('/member_library_form')->with('status',"Inserted successfully");
}
    public function member_profile_info()
    {
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
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
        $data['reports'] = ClientReport::where('client_id', Auth::id())->orderBy('id', 'desc')->first();
        $data['diagonostic'] = ClientDiagnosticReport::where('client_id', Auth::id())->orderBy('id', 'desc')->first();
        $data['recommendation'] = ClientRecommendation::where('client_id', Auth::id())->orderBy('id', 'desc')->first();
        $data['medication'] = ClientMedication::where('client_id', Auth::id())->orderBy('id', 'desc')->first();
        return view('main.member_profile_info')->with($data);
    }
    public function client_report_submit(Request $request)
    {
        $report = ClientReport::where('client_id', Auth::id())->where('status', '1')->get();
        if(count($report) > 0){
            $details = ClientReport::where('client_id', Auth::id())->orderBy('id', 'desc')->first();
            ClientReport::where('client_id', Auth::id())->where('id', $details->id)->update([
                'report'    => $request->report,
            ]);
        }
        else{
            ClientReport::create([
                'client_id' => Auth::id(),
                'report'    => $request->report,
                'status'    => '1'
            ]);
        }
            $notification  = getNotificationMessage(76);
            $message = $notification;
         $subject = "Report Submitted ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Reported successfully");
    }
    public function client_diagnostic_report_submit(Request $request)
    {
        $report = ClientDiagnosticReport::where('client_id', Auth::id())->where('status', '1')->get();
        if(count($report) > 0){
            ClientDiagnosticReport::where('client_id', Auth::id())->where('status', '1')->update([
                'report'    => $request->report,
            ]);
        }
        else{
            ClientDiagnosticReport::create([
                'client_id' => Auth::id(),
                'report'    => $request->report,
                'status'    => '1'
            ]);
        }
         $notification  = getNotificationMessage(77);
            $message = $notification;
         $subject = "Diagnostic Report Submitted ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Reported successfully");
    }
    public function client_recommendation_submit(Request $request)
    {
        $report = ClientRecommendation::where('client_id', Auth::id())->where('status', '1')->get();
        if(count($report) > 0){
            ClientRecommendation::where('client_id', Auth::id())->where('status', '1')->update([
                'report'    => $request->report,
            ]);
        }
        else{
            ClientRecommendation::create([
                'client_id' => Auth::id(),
                'report'    => $request->report,
                'status'    => '1'
            ]);
        }
        $notification  = getNotificationMessage(67);
        $message = $notification;
         $subject = "Recommendation  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Reported successfully");
    }
    public function client_medication_submit(Request $request)
    {
        $report = ClientMedication::where('client_id', Auth::id())->where('status', '1')->get();
        if(count($report) > 0){
            ClientMedication::where('client_id', Auth::id())->where('status', '1')->update([
                'report'    => $request->report,
            ]);
        }
        else{
            ClientMedication::create([
                'client_id' => Auth::id(),
                'report'    => $request->report,
                'status'    => '1'
            ]);
        }
        $notification  = getNotificationMessage(38);
        $message = $notification;
         $subject = "Medication  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Reported successfully");
    }
    public static function getclientreport($id)
    {
        $client = ClientAppointmentList::where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
        if(empty($user))
        {
          return '';
        }else{
          return  ClientReport::where('client_id', $user->id)->orderBy('id', 'desc')->get();
        }

    }
    public static function getclientdiagnosticreport($id)
    {
        $client = ClientAppointmentList::where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
        if(empty($user))
        {
          return '';
        }else{
        return $report = ClientDiagnosticReport::where('client_id', $user->id)->orderBy('id', 'desc')->get();
    }
    }
    public static function getclientrecommendation($id)
    {
        $client = ClientAppointmentList::where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
        if(empty($user))
        {
          return '';
        }else{
        return $report = ClientRecommendation::where('client_id', $user->id)->orderBy('id', 'desc')->get();
    }
    }
    public static function getstatusreport($id)
    {
        $client = ClientAppointmentList::where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
        if(empty($user))
        {
          return '';
        }else{
        return $report = StatusReport::where('client_id', $user->id)->first();
    }
    }
    public static function getclientmedication($id)
    {
        $client = ClientAppointmentList::where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
        if(empty($user))
        {
          return '';
        }else{
        return $report = ClientMedication::where('client_id', $user->id)->orderBy('id', 'desc')->get();
    }
    }
    public function affiliate_client_report_submit(Request $request)
    {
        $array1 = json_decode($request->sub_arr);
        $array2 = json_decode($request->sub_arr3);
        foreach($array1 as $arr1){

            ClientReport::where('id', $arr1->id)->update([
                'report'    => $arr1->report,
            ]);
        }
        foreach ($array2 as $arr2) {
            $client = ClientAppointmentList::where('id', $arr2->client_id)->first();
            $user = User::where('email', $client->email)->first();
            ClientReport::create([
                'client_id' => $user->id,
                'report'    => $arr2->report,
                'status'    => '1'
            ]);
        }
        $notification  = getNotificationMessage(76);
        $message = $notification;
         $subject = "Report  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Reported successfully");
    }
    public function affiliate_client_diagnostic_report_submit(Request $request)
    {
        $array1 = json_decode($request->sub_arr);
        $array2 = json_decode($request->sub_arr3);
        foreach($array1 as $arr1){

            ClientDiagnosticReport::where('id', $arr1->id)->update([
                'report'    => $arr1->report,
            ]);
        }
        foreach ($array2 as $arr2) {
            $client = ClientAppointmentList::where('id', $arr2->client_id)->first();
            $user = User::where('email', $client->email)->first();
            ClientDiagnosticReport::create([
                'client_id' => $user->id,
                'report'    => $arr2->report,
                'status'    => '1'
            ]);
        }

       $notification  = getNotificationMessage(77);
        $message = $notification;
         $subject = "Diagnostic  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function affiliate_client_recommendation_submit(Request $request)
    {
        $array1 = json_decode($request->sub_arr);
        $array2 = json_decode($request->sub_arr3);
        foreach($array1 as $arr1){

        ClientRecommendation::where('id', $arr1->id)->update([
                'report'    => $arr1->report,
            ]);
        }
        foreach ($array2 as $arr2) {
            $client = ClientAppointmentList::where('id', $arr2->client_id)->first();
            $user = User::where('email', $client->email)->first();
            ClientRecommendation::create([
                'client_id' => $user->id,
                'report'    => $arr2->report,
                'status'    => '1'
            ]);
        }
        $notification  = getNotificationMessage(67);
        $message = $notification;
         $subject = "Recommendation  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function affiliate_client_medication_submit(Request $request)
    {
        $array1 = json_decode($request->sub_arr);
        $array2 = json_decode($request->sub_arr3);
        foreach($array1 as $arr1){

            ClientMedication::where('id', $arr1->id)->update([
                'report'    => $arr1->report,
            ]);
        }
        foreach ($array2 as $arr2) {
            $client = ClientAppointmentList::where('id', $arr2->client_id)->first();
            $user = User::where('email', $client->email)->first();
            ClientMedication::create([
                'client_id' => $user->id,
                'report'    => $arr2->report,
                'status'    => '1'
            ]);
        }

         $notification  = getNotificationMessage(38);
        $message = $notification;
         $subject = "Medication  Submitted ";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function reportstatuschange(Request $request)
    {
        $client = ClientAppointmentList::where('id', $request->id)->first();
        $user = User::where('email', $client->email)->first();
        $type = $request->type;
        if($type == "diagnostic"){
            $report = ClientDiagnosticReport::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientDiagnosticReport::where('client_id', $user->id)->update([
                    'status'    => '0'
                ]);
            }
            else{
                ClientDiagnosticReport::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '0'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'diagnostic'    => '0'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'diagnostic'    => '0'
                ]);
            }
        }
        elseif($type == "recommendation"){
            $report = ClientRecommendation::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientRecommendation::where('client_id', $user->id)->update([
                    'status'    => '0'
                ]);
            }
            else{
                ClientRecommendation::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '0'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'recommendation'    => '0'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'recommendation'    => '0'
                ]);
            }
        }
        elseif($type == "medication"){
            $report = ClientMedication::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientMedication::where('client_id', $user->id)->update([
                    'status'    => '0'
                ]);
            }
            else{
                ClientMedication::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '0'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'medication'    => '0'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'medication'    => '0'
                ]);
            }
        }

        $notification  = getNotificationMessage(78);
        $message = $notification;
         $subject = "Report Status Changed";
         addUserActivity($subject,'add',$notification,$message);
        echo "Status Changed successfully";
    }
    public function reportstatuschange2(Request $request)
    {
        $client = ClientAppointmentList::where('id', $request->id)->first();
        $user = User::where('email', $client->email)->first();
        $type = $request->type;
        if($type == "diagnostic"){
            $report = ClientDiagnosticReport::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientDiagnosticReport::where('client_id', $user->id)->update([
                    'status'    => '1'
                ]);
            }
            else{
                ClientDiagnosticReport::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '1'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'diagnostic'    => '1'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'diagnostic'    => '1'
                ]);
            }
        }
        elseif($type == "recommendation"){
            $report = ClientRecommendation::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientRecommendation::where('client_id', $user->id)->update([
                    'status'    => '1'
                ]);
            }
            else{
                ClientRecommendation::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '1'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'recommendation'    => '1'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'recommendation'    => '1'
                ]);
            }
        }
        elseif($type == "medication"){
            $report = ClientMedication::where('client_id', $user->id)->get();
            if(count($report) > 0){
                ClientMedication::where('client_id', $user->id)->update([
                    'status'    => '1'
                ]);
            }
            else{
                ClientMedication::create([
                    'client_id' => $user->id,
                    'report'    => "",
                    'status'    => '1'
                ]);
            }
            $statusreport = StatusReport::where('client_id', $user->id)->get();
            if(count($statusreport) > 0){
                StatusReport::where('client_id', $user->id)->update([
                    'medication'    => '1'
                ]);
            }
            else{
                StatusReport::create([
                    'client_id' => $user->id,
                    'medication'    => '1'
                ]);
            }
        }
       $notification  = getNotificationMessage(78);
        $message = $notification;
         $subject = "Report Status Changed";
         addUserActivity($subject,'add',$notification,$message);
        echo "Status Changed successfully";
    }
    public static function getclienttask($id)
    {
        $client = DB::table('user_access_role')->where('id', $id)->first();
        $user = User::where('email', $client->email)->first();
          if(!empty($user)){
            $task = ClientTask::where('client_id', $user->id)->orderBy('id', 'desc')->get();
            return $task;
          }else{
            return array();
          }
    }
    public function affiliate_client_task_submit(Request $request)
    {
        $array1 = json_decode($request->sub_arr);
        $array2 = json_decode($request->sub_arr3);
        foreach($array1 as $arr1){

            ClientTask::where('id', $arr1->id)->update([
                'task'      => $arr1->task,
                'outcome'   => $arr1->outcome,
                'message'   => $arr1->message
            ]);
        }
        foreach ($array2 as $arr2) {
            $client = ClientAppointmentList::where('id', $arr2->client_id)->first();
            $user = User::where('email', $client->email)->first();
            ClientTask::create([
                'client_id' => $user->id,
                'task'      => $arr2->task,
                'outcome'   => $arr2->outcome,
                'message'   => $arr2->message
            ]);
        }
       $notification  = getNotificationMessage(79);
        $message = $notification;
         $subject = "Client task added";
         addUserActivity($subject,'add',$notification,$message);
        echo "Reported successfully";
    }
    public function affiliate_client_task_delete(Request $request)
    {
        ClientTask::where('id', $request->id)->delete();
    }
    public function member_tasks()
    {
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
        //print_r($data['top_banners']);die();
        $data['chat'] = "";
        $data['tools'] = "";
        $data['tasks'] = ClientTask::where('client_id', Auth::id())->where('status', '0')->orderBy('id', 'desc')->first();
        return view('main.member_tasks')->with($data);
    }
    public function client_task_submit(Request $request)
    {
        $subt = ClientTask::where('id', $request->id)->first();
        if($subt->client_submit == ""){
            ClientTask::where('id', $request->id)->update([
                'client_submit' => date('Y-m-d H:i:s')
            ]);
        }
        ClientTask::where('id', $request->id)->update([
            'outcome' => $request->outcome,
            'message' => $request->message,
        ]);
          $notification  = getNotificationMessage(79);
        $message = $notification;
         $subject = "Client Task Submitted";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Task submitted successfully.");
    }
    public function affiliate_client_task_confirm(Request $request)
    {
        ClientTask::where('id', $request->id)->update([
            'status' => '1',
        ]);
       $notification  = getNotificationMessage(80);
        $message = $notification;
         $subject = "Client task confirm";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function survey_polls()
    {
         if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        // if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
        //     return redirect('/')->with('status', "You can't access this page.");
        // }
        if(Auth::user()->role == "admin"){
         return redirect('/')->with('status',"Admin can't access this page.");
            }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";

        $data['aabanner'] = DB::table('affiliate_banner')->get();
        $data['top_banners'] = SettingBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();

        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        //print_r($data['top_banners']);die();
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }else if((Auth::user()->role) == "client"){
            //$uid = Auth::id();

          $da= DB::table('client_appointment_lists')->where('email',Auth::user()->email)->first();
           $uid=$da->uid;
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $i=0;
       // echo $uid;die;
        $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
        $data['chat'] = "";
        $data['tools'] = "";
        $data['survey'] = DB::table('admin_survey')->where('category_id',$affiliate->business_category)->get();

        return view('main.survey_polls')->with($data);
    }
    public function search_a_business(Request $request)
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $business_search = $request->business_search;
        $data['affiliates'] = "";
        $data['searchf'] = "";
        if($business_search == ""){
            $data['affiliates'] = AffiliateRegistration::get();
        }
        else{
            $data['affiliates'] = AffiliateRegistration::where('state', $business_search)->orWhere('city', '=', $business_search)->orWhere('zip_code', $business_search)->orWhere('religion', $business_search)->orWhere('country',$business_search)->orWhere('first_name', 'like', '%' .$business_search. '%')->orWhere('last_name', 'like', '%' .$business_search. '%')->orWhereRaw("concat(first_name, last_name) like '%{$business_search}%' ")->orWhereRaw("concat(first_name, ' ', last_name) like '%{$business_search}%' ")->orWhere('company', 'like', '%' .$business_search. '%')->orWhere('business_category', $business_search)->get();
            $data['searchf'] = "Search for ".$business_search;
        }
        $data['category'] = BusinessCategory::get();
        $data['religion'] = Religion::get();
        $data['chat'] = "off";
        $data['tools'] = "off";

        return view('main.search_a_business')->with($data);
    }
    public function revenue_template_submit(Request $request)
    {
        $amount_arr = json_decode($request->amount_arr);
        $array = json_decode($request->sub_arr);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $i=0;
         $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
      //  echo $affiliate->business_category;die;
        foreach ($array as $value) {
            $revenue_account = DB::table('revenue_account')->where('id', $value)->first();
            $exist = DB::table('revenue_account')->where(['uid'=> $uid,'account_name'=>$revenue_account->account_name])->first();
            $amount= $amount_arr[$i++];
            if($exist == ""){
                $values = array(
                    'account_name'  => $revenue_account->account_name,
                    'amount'        => $amount,
                    'category'        => $affiliate->business_category,
                    'date'          => date('Y-m-d'),
                    'uid'           => $uid
                );
                $inst = DB::table('revenue_account')->insert($values);
                if($inst){
                    $values = array(
                     'uid'  => $uid,
                    'name'  => $revenue_account->account_name,
                    'jan'        => 0,
                    'feb'        => 0,
                    'mar'          =>0,
                    'apr'           => 0,
                    'may'           => 0,
                    'jun'           => 0,
                    'jul'           => 0,
                    'aug'           => 0,
                    'sep'           => 0,
                    'oct'           => 0,
                    'nov'           => 0,
                    'decem'           => 0
                );
                $ins = DB::table('revenue_budget')->insert($values);
                }
            }else{
                $values = array('amount' => $amount);
                DB::table('revenue_account')->where(['uid'=> $uid,'account_name'=>$revenue_account->account_name])->update($values);
            }

        }

        $notification  = getNotificationMessage(81);
        $message = $notification;
         $subject = "Revenue Account Created";
         addUserActivity($subject,'add',$notification,$message);

         return redirect()->back()->with('status', "Account(s) Activated");
    }
 public static function balance_account_existance($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('balancesheet_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = "";
        if($exist != ""){
            $val = "exist";
        }
        else{
            $val = "not exist";
        }
        return $val;
    }
public static function account_revenue_exits($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('revenue_record')->where('uid', $uid)->where('account_description', $account)->first();

        if(!empty($exist)){
            $val = 1;
        }
        else{
            $val = 0;
        }
        return $val;
    }
    public static function account_revenue_deleteId($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('revenue_account')->where('uid', $uid)->where('account_name', $account)->first();

        if(!empty($exist)){
            $val = $exist->id;
        }
        else{
            $val = 0;
        }
        return $val;
    }
    public static function expense_revenue_exits($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('expense_record')->where('uid', $uid)->where('account_description', $account)->first();

        if(!empty($exist)){
            $val = 1;
        }
        else{
            $val = 0;
        }
        return $val;
    }
    public static function expense_revenue_deleteId($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('expenses_account')->where('uid', $uid)->where('account_name', $account)->first();

        if(!empty($exist)){
            $val = $exist->id;
        }
        else{
            $val = 0;
        }
        return $val;
    }
    public static function account_existance($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('revenue_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = "";
        if($exist != ""){
            $val = "exist";
        }
        else{
            $val = "not exist";
        }
        return $val;
    }
    public static function asset_account_price($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('balancesheet_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = '';
        if(!empty($exist)){
            $val=$exist->amount;
        }

        return $val;
    }
    public static function balance_account_price($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('balancesheet_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = 0;
        if(!empty($exist)){
            $val=isset($exist->amount) && $exist->amount!='' ?$exist->amount:0;
        }

        return $val;
    }
    public static function account_price($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('revenue_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = '';
        if(!empty($exist)){
            $val=$exist->amount;
        }

        return $val;
    }
    public static function account_price2($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('expenses_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = '';
        if(!empty($exist)){
            $val=$exist->amount;
        }

        return $val;
    }
    public static function account_existance2($account)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('expenses_account')->where('uid', $uid)->where('account_name', $account)->first();
        $val = "";
        if($exist != ""){
            $val = "exist";
        }
        else{
            $val = "not exist";
        }
        return $val;
    }
 public function balancesheet_template_submit(Request $request)
    {
        $amount_arr = json_decode($request->amount_arr);
        $array = json_decode($request->sub_arr);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
         $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
        $i=0;
        foreach ($array as $value) {
            $balancesheet_account = DB::table('balancesheet_account')->where('id', $value)->first();
            $exist = DB::table('balancesheet_account')->where('uid', $uid)->where('account_name', $balancesheet_account->account_name)->first();
            $amount= $amount_arr[$i++];
            if($exist == ""){
                $values = array(
                    'account_name'  => $balancesheet_account->account_name,
                    'amount'        =>  $amount,
                     'category'        => $affiliate->business_category,
                    'main_category'  => $request->main_cat,
                    'date'          => date('Y-m-d'),
                    'uid'           => $uid
                );
                DB::table('balancesheet_account')->insert($values);
            }else{
                $values = array('amount' => $amount);
                DB::table('balancesheet_account')->where(['uid'=> $uid,'account_name'=>$balancesheet_account->account_name])->update($values);
            }
        }

         $notification  = getNotificationMessage(82);
        $message = $notification;
         $subject = "Balancesheet Account Created";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function expenses_template_submit(Request $request)
    {
        $amount_arr = json_decode($request->amount_arr);
       //print_r($amount_arr);die;
        $array = json_decode($request->sub_arr);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $i=0;
         $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
        foreach ($array as $value) {
            $expenses_account = DB::table('expenses_account')->where('id', $value)->first();
            $exist = DB::table('expenses_account')->where('uid', $uid)->where('account_name', $expenses_account->account_name)->first();
            $amount= $amount_arr[$i++];
            if($exist == ""){
                $values = array(
                    'account_name'  => $expenses_account->account_name,
                    'amount'        => $amount,
                    'category'        => $affiliate->business_category,
                    'date'          => date('Y-m-d'),
                    'uid'           => $uid
                );
                DB::table('expenses_account')->insert($values);
            }else{
                $values = array('amount' => $amount);
                DB::table('expenses_account')->where(['uid'=>$uid,'account_name'=>$expenses_account->account_name])->update($values);
            }
        }

          $notification  = getNotificationMessage(83);
          $message = $notification;
         $subject = "Expense Account Created";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function revenue_account_check(Request $request)
    {
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();
        $business_category = BusinessCategory::where('id', $category->business_category)->first();
        $fcategory = FinancialTemplateCategory::where('category', $business_category->category)->first();
        if($fcategory != ""){
            $account = DB::table('revenue_account')->where('uid', $user->id)->where('account_name', $request->val)->where('category', $fcategory->id)->first();
            if($account == "")
            {
                echo "doesn't exist";
            }
            else
            {
                echo "exist";
            }
        }
        else{
            echo "doesn't exist";
        }
    }
     public function balancesheet_account_check(Request $request)
    {
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();
        $business_category = BusinessCategory::where('id', $category->business_category)->first();
        $fcategory = FinancialTemplateCategory::where('category', $business_category->category)->first();
        if($fcategory != ""){
            $account = DB::table('balancesheet_account')->where('uid', $user->id)->where('account_name', $request->val)->where('category', $fcategory->id)->first();
            if($account == "")
            {
                echo "doesn't exist";
            }
            else
            {
                echo "exist";
            }
        }
        else{
            echo "doesn't exist";
        }
    }
 public function balancesheet_new_account_submit(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();

        $values = array(
            'account_name'  => $request->account_name,
            'main_category'  => $request->main_category,
            'amount'        =>  $request->amount,
            'category'      => $category->business_category,
            'date'          => date('Y-m-d'),
            'uid'           => $uid
        );
        $values2 = array(
            'account_name'  => $request->account_name,
            'main_category'  => $request->main_category,
            'amount'        => '',
            'date'          => date('Y-m-d'),
            'uid'           => $user->id,
            'category'      => $category->business_category,
        );
        $ext = DB::table('balancesheet_account')->where('uid', $uid)->where('account_name', $request->account_name)->first();
        if($ext == ''){
            DB::table('balancesheet_account')->insert($values);
        }
        DB::table('balancesheet_account')->insert($values2);
         $notification  = getNotificationMessage(82);
          $message = $notification;
         $subject = "Balancesheet Account Created";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function revenue_new_account_submit(Request $request)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();
        $business_category = BusinessCategory::where('id', $category->business_category)->first();
        $fcategory = FinancialTemplateCategory::where('category', $business_category->category)->first();
        if($fcategory == ""){
            FinancialTemplateCategory::create(['category'   =>  $business_category->category]);
        }
        $categoryid = FinancialTemplateCategory::where('category', $business_category->category)->first();
        $values = array(
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'category'      => $category->business_category,
            'date'          => date('Y-m-d'),
            'uid'           => $uid
        );
        $values2 = array(
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'date'          => date('Y-m-d'),
            'uid'           => $user->id,
            'category'      => $category->business_category,
        );

        $ext = DB::table('revenue_account')->where('uid', $uid)->where('account_name', $request->account_name)->first();
        if($ext == ''){
            DB::table('revenue_account')->insert($values);
        }
        DB::table('revenue_account')->insert($values2);
         $values21 = array(
            'name'      => $request->account_name,
            'jan'       => 0,
            'feb'       => 0,
            'mar'       => 0,
            'apr'       => 0,
            'may'       => 0,
            'jun'       => 0,
            'jul'       => 0,
            'aug'       => 0,
            'sep'       => 0,
            'oct'       => 0,
            'nov'       => 0,
            'decem'     => 0,
            'uid'       => $uid
        );
        DB::table('revenue_budget')->insert($values21);
        DB::table('revenue_projection')->insert($values21);
        $values3 = array(
            'name'          => $request->account_name,
            'janmar'        => 0,
            'aprjun'        => 0,
            'julsep'        => 0,
            'octdec'        => 0,
            'uid'           => $uid
        );
        DB::table('revenue_quaterly_budget')->insert($values3);
        DB::table('revenue_quaterly_projection')->insert($values3);
         $notification  = getNotificationMessage(81);
          $message = $notification;
         $subject = "Revenue Account Created";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function expense_account_check(Request $request)
    {
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();
        $business_category = BusinessCategory::where('id', $category->business_category)->first();
        $fcategory = FinancialTemplateCategory::where('category', $business_category->category)->first();
        if($fcategory != ""){
            $account = DB::table('expenses_account')->where('uid', $user->id)->where('account_name', $request->val)->where('category', $fcategory->id)->first();
            if($account == "")
            {
                echo "doesn't exist";
            }
            else
            {
                echo "exist";
            }
        }
        else{
            echo "doesn't exist";
        }
    }
    public function expense_new_account_submit(Request $request)
   {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $user = User::where('role', 'admin')->first();
        $category = AffiliateRegistration::where('email', Auth::user()->email)->first();
        $business_category = BusinessCategory::where('id', $category->business_category)->first();
        $fcategory = FinancialTemplateCategory::where('category', $business_category->category)->first();
        if($fcategory == ""){
            FinancialTemplateCategory::create(['category'   =>  $business_category->category]);
        }
        $categoryid = FinancialTemplateCategory::where('category', $business_category->category)->first();
        $values = array(
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'category'      => $category->business_category,
            'date'          => date('Y-m-d'),
            'uid'           => $uid
        );
        $values2 = array(
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'date'          => date('Y-m-d'),
            'uid'           => $user->id,
            'category'      => $category->business_category,
        );
        $ext = DB::table('expenses_account')->where('uid', $uid)->where('account_name', $request->account_name)->first();
        if($ext == ''){
            DB::table('expenses_account')->insert($values);
        }
        DB::table('expenses_account')->insert($values2);
 $values21 = array(
            'name'      => $request->account_name,
            'jan'       => 0,
            'feb'       => 0,
            'mar'       => 0,
            'apr'       => 0,
            'may'       => 0,
            'jun'       => 0,
            'jul'       => 0,
            'aug'       => 0,
            'sep'       => 0,
            'oct'       => 0,
            'nov'       => 0,
            'decem'     => 0,
            'uid'       => $uid
        );
        DB::table('expense_budget')->insert($values21);
        DB::table('expense_projection')->insert($values21);
        $values3 = array(
            'name'          => $request->account_name,
            'janmar'        => 0,
            'aprjun'        => 0,
            'julsep'        => 0,
            'octdec'        => 0,
            'uid'           => $uid
        );
        DB::table('expense_quaterly_budget')->insert($values3);
        DB::table('expense_quaterly_projection')->insert($values3);
          $notification  = getNotificationMessage(83);
          $message = $notification;
         $subject = "Expense Account Created";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Inserted successfully");
    }

    // Marina
    public function select_department(Request $request){
        $haiti=$request->haiti;
        $data=DB::table('departments')->where('country', $haiti)->get();
        ob_start();
        ?>
        <select name="selectdepartment" id="department">
            <option></option>
            <?php
            foreach($data as $d){
                ?>
                <option value="<?php echo $d->id ?>"><?php echo $d->department; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
        $html=ob_get_clean();
        echo $html;
    }

    public function select_arr(Request $request){
        $dep=$request->dep;
        $data=DB::table('arrondissements')->where('department_id', $dep)->get();
        ob_start();
        ?>
        <select name="selectarr" id="arr">
            <option></option>
            <?php
            foreach($data as $d){
                ?>
                <option value="<?php echo $d->id ?>"><?php echo $d->arrondissement; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
        $html=ob_get_clean();
        echo $html;
    }
    // Marina
    public function business_registration()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['communes'] = Comune::get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $data['lead_cats'] = LeadsCategory::orderBy('category','asc')->get();
        $data['terms'] = DB::table('register_terms')->find(1)->terms;
        $data['plans'] = Plan::where('status',1)->whereNotIn('id',[1])->orderBy('monthly_fee','asc')->get();
        $data["grid"]=4;
        $data["offset"]='';
        return view('main.business_registration')->with($data);
    }
    public function free_affiliate_entry(Request $request)
    {
        $fileNameToStore="";
        $email=$request->email;
        $u1=User::where(['email'=>$email])->count();
        $u2=AffiliateRegistration::where(['email'=>$email])->count();
         $this->validate($request, [
           // 'password'     => 'required|min:5',
            'confirm_password' => 'required|same:password',
            ]);

        if(empty($request->plan_id)) {
          return redirect()->back()->with('status',"Please select any plan first");
                exit;
        }
         elseif(empty($request->fees)) {
          return redirect()->back()->with('status',"Please select any plan first");
                exit;
        }
         elseif(empty($request->terms)) {
          return redirect()->back()->with('status',"Please agree terms and conditions first");
                exit;
        }
        elseif($u1>0) {
          return redirect()->back()->with('status',"Email already exists.");
                exit;
        }elseif($u2>0){
            return redirect()->back()->with('status',"Email already exists.");
                exit;
        }else{
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images/affiliates';
            $file->move($destinationPath,$fileNameToStore);
        }

        return  $this->add_business_entry($request->all(),$fileNameToStore);
      }
    }
public function add_business_entry($request,$fileNameToStore)
{
  // print_r($request);die;
            $AffiliateRegistration      = TempAffiliateRegistration::create([
                'code'                  => '',
                'joining_date'          => date('Y-m-d'),
                'password'              => Hash::make($request['password']),
                'show_pass'             => $request['password'],
                'first_name'            => $request['first_name'],
                'last_name'             => $request['last_name'],
                'religion'              => $request['religion'],
                'otherreligion'         => $request['religionother'],
                'email'                 => $request['email'],
                'cellphone'             => $request['cellphone'],
                'business_telephone'    => $request['business_telephone'],
                'business_category'     => $request['business_category'],
                'otherbusiness'         => $request['businessother'],
                'lead_category'         => $request['lead_category'],
                'address'               => $request['address'],
                'zip_code'              => $request['zip_code'],
                'city'                  => $request['city'],
                'state'                 => $request['state'],
                'country'               => $request['country'],
                'commune'               => $request['commune'],
                'department'            => $request['selectdepartment'],
                'arrondissement'        => $request['selectarr'],
                'billing_address'       => $request['billing_address'],
                'billing_zip_code'      => $request['billing_zip_code'],
                'billing_city'          => $request['billing_city'],
                'billing_state'         => $request['billing_state'],
                'billing_country'       => $request['billing_country'],
                'fees'                  => $request['fees'],
                'plan_id'                => $request['plan_id'],
                'sponsor_id'            => '',
                'image'                 => $fileNameToStore,
                'company'               => $request['company']

            ]);
        if($AffiliateRegistration)
         {
            $last_id=$AffiliateRegistration->id;
            session()->put('user_id',$last_id);
            Session::flash('success', "Inserted successfully");
            return redirect('/business-preview/'.$last_id);
        }
        else {
            return redirect()->back()->with('status',"Something went wrong!!!");
        }
   }
   public  function business_preview($user_id)
   {
     if(!empty(session()->get('user_id')))
     {

    $data['user'] = DB::table('temp_affiliate_registrations')->where('id',$user_id)->first();
     $data['fees'] = Setting::general_setting()->registration_fee;
      $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::find($data['user']->business_category)->category;
        $data['lead_category'] = LeadsCategory::find($data['user']->lead_category)->category;

         $data['plans'] = Plan::where(['id'=>$data['user']->plan_id])->get();
         $data["grid"]=4;
         $data["offset"]=4;



       //print_r( $data['user']->code );die;
       return view('main.business_registration_preview')->with($data);
     }else{
        return  redirect('business_registration');
     }
   }
public function business_redirect_paypal(Request $request)
    {
        // print_r($request->all());
        if(!empty($request->user_id) && !empty($request->plan_id))
        {
             $data= array(
                      'fees'               => $request->fees,
                      'plan_id'            => $request->plan_id,
                       );
          //  TempAffiliateRegistration::where('id',$request->user_id)->update($data);
             session()->put('user_id',$request->user_id);
           return   $this->postPaymentWithpaypal($request->fees,$request->user_id);
        }
        else{
        return redirect()->back()->with('status',"Something went wrong!!!");
        }

    }
    public function postPaymentWithpaypal($price,$order_no)
    {
       $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Registration Fees')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($price);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order_no);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('paypal_status'))
            ->setCancelUrl(URL::route('paypal_status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');
                return Redirect::route('paypal_payment');
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('paypal_payment');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }
        \Session::put('error','Unknown error occurred');
        return Redirect::route('paypal_payment');
    }
  public function getPaymentStatus(Request $request)
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();

        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paypal_payment');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
          //  echo "<pre>";
          //  print_r($result);die;
         $payment_id=$result->getId();
        // $order_no=$result->getDescription();
         $transaction_id=$result->transactions[0]->related_resources[0]->sale->id;
         $order_no=$result->transactions[0]->description;

         $data['payment_id'] =  $payment_id;
         $data['transaction_id'] =  $transaction_id;
         $data['state'] =  $result->transactions[0]->related_resources[0]->sale->state;
        $data['amount'] =  $result->transactions[0]->related_resources[0]->sale->amount->total;
        $data['currency'] =  $result->transactions[0]->related_resources[0]->sale->amount->currency;
        $data1= array(
                      'user_id'          => $order_no,
                      'amount'           => $data['amount'],
                      'currency'         => $data['currency'],
                      'payment_id'       => $data['payment_id'],
                      'transaction_id'   => $data['transaction_id'],
                      'description'      => 'Registration Fee',
                      'payment_status'   => $data['state'],
                      'status'           => 1,
                       );
            $query = Transactionhistory::create($data1);
             $data['order_no'] =  $query->id;
            \Session::put('success','Payment success !!');

            return $this->add_business_affiliate_final_data($order_no);
        }
        \Session::put('error','Payment failed !!');
             return Redirect::route('paypal_payment');

    }
public function add_business_affiliate_final_data($user_id)
{
         $request=TempAffiliateRegistration::where('id',$user_id)->first();

           $sponsor_id='';
            $level='';
            $role="affiliate";
            $code=$request->code;
          $check_sponsor=Contacts::where('email',$request->email)->first();

         if(!empty($check_sponsor))
         {
          $sponsor_id=$check_sponsor->uid;
          $user=User::where('id',$sponsor_id)->first();
          $affiliate=AffiliateRegistration::where('email',$user->email)->first();

          $code=AffiliateRegistration::get_user_affiliate_code($affiliate->code);
          $level=AffiliateRegistration::get_user_level($code);
         }

         $username=substr($request->email, 0, strpos($request->email, '@'));
         $plan_id=$request->plan_id;
         $AffiliateRegistration      = AffiliateRegistration::create([
                'code'                  => $code,
                'joining_date'          => $request->joining_date,
                'password'              => $request->password,
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
                'religion'              => $request->religion,
                'otherreligion'         => $request->otherreligion,
                'email'                 => $request->email,
                'username'              => $username,
                'cellphone'             => $request->cellphone,
                'business_telephone'    => $request->business_telephone,
                'business_category'     => $request->business_category,
                'otherbusiness'         => $request->otherbusiness,
                'lead_category'         => $request->lead_category,
                'address'               => $request->address,
                'zip_code'              => $request->zip_code,
                'city'                  => $request->city,
                'state'                 => $request->state,
                'country'               => $request->country,
                'commune'               => $request->commune,
                'department'            => $request->department,
                'arrondissement'        => $request->arrondissement,
                'billing_address'       => $request->billing_address,
                'billing_zip_code'      => $request->billing_zip_code,
                'billing_city'          => $request->billing_city,
                'billing_state'         => $request->billing_state,
                'billing_country'       => $request->billing_country,
                'sponsor_id'            => $sponsor_id,
                'plan_id'               => $plan_id,
                'image'                 => $request->image,
                'type'                  => $role,
                'status'                => 1,
                'company'               => $request->company,
                 'type'                  => "free_affiliate",

            ]);
        if($AffiliateRegistration)
         {
             $full_address=$request->address.' '.$request->city.' '.$request->zip.' '.$request->state.' '.$request->country;
                     $loc=getLatLong($full_address);
                     $latitute=$loc['latitute'];
                     $longitude=$loc['longitude'];
              $User = User::create([
                 'name'         => $request->first_name." ".$request->last_name,
                 'username'     => $username,
                 'email'        => $request->email,
                 'password'     => $request->password,
                 'show_pass'    => $request->show_pass,
                 'sponsor_id'   => $sponsor_id,
                 'plan_id'      => $plan_id,
                 'latitute'     => $latitute,
                 'longitude'    => $longitude,
                 'level'        => $level,
                 'role'         => $role,
                 'status'       => 1,
             ]);

            if(!empty($sponsor_id))
            {
                $u_id=$User->id;
                 $da=array(
                       'user_id'     =>$u_id,
                       'sponsor_id'  =>$sponsor_id,
                       'status'      =>1
                       );
                 $data= Network::create($da);
            $update_team=User::update_total_team_members($sponsor_id);
            $u2=AffiliateRegistration::where('email',$request->email)->first();
            if(!empty($u2->code))
            {
             $affiliate_income=Balance_info::update_affiliate_bonus_income($u_id,$plan_id);
            }
            $add_plan=Balance_info::add_user_subscription($u_id,$plan_id);
            }
            if(!empty($plan_id))
            {
             $u_id=$User->id;
             ActivePlan::update_user_plan($u_id,$plan_id);
            }
            DB::table('affiliate_banner')->insert(array('affiliate_email' => $request->email));

             $profile_photo=Balance_info::get_affiliate_profile_pic($request->email);
             $admin_email=Setting::get_admin_email();
             $fullname=$request->first_name.' '.$request->last_name;
             $email=$request->email;
             $password1=$request->show_pass;

             $link=url('/');
             $website_url="<a href='".$link."' target='_blank'>click here to login</a>";
             $temp=DB::table('business_registration_email_template')->where('id',1)->first();
             $email_message=$temp->email_body;
             $email_subject=$temp->email_subject;
             $email_message=str_replace('{fullname}',$fullname,$email_message);
             $email_message=str_replace('{profile_photo}',$profile_photo,$email_message);
             $email_message=str_replace('{email}',$email,$email_message);
             $email_message=str_replace('{password}',$password1,$email_message);
             $email_message=str_replace('{website_url}',$website_url,$email_message);
              $data2 = array(
                      'admin_email'       =>   $admin_email,
                      'template'          =>  'email_template',
                      'webtitle'          =>  'MAFAMA',
                      'subject'           =>  $email_subject,
                      'email_message'     =>  $email_message,
                  );
                \Mail::to($email)->send(new SendMail($data2));
           TempAffiliateRegistration::where('id',$request->id)->delete();
            $last_id=$User->id;
            session()->put('user_id',$last_id);
            Session::flash('success', "Registration completed successfully");
            return redirect('paypal_payment');
        }
        else {
            return redirect()->back()->with('status',"Something went wrong!!!");
        }
}
 public function payWithPaypal()
    {
       $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $data['video'] = SettingTutorial::first();
        return view('main.paypal_payment')->with($data);
    }
    public function business_search_step2(Request $request)
    {
        $religion = $request->religion;        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $zipcode = $request->zipcode;
        Session::put('religion', $religion);
        Session::put('country', $country);
        Session::put('state', $state);
        Session::put('city', $city);
        Session::put('zipcode', $zipcode);
        return redirect('business_search_step2_detail');
    }
    public function business_search_step2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";

        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $religion = Session::get('religion');
        $country = Session::get('country');
        $state = Session::get('state');
        $city = Session::get('city');
        $zipcode = Session::get('zipcode');
        $data['clients'] = "";
        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['clients2'] = "";
        $data['users'] = "";
        if(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion != "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['religion', '=', $religion],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country != "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state;
        }
        elseif(($religion == "all") && ($country != "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country != "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['country', '=', $country]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['country', '=', $country]])->get();
            $data['users'] = DB::table('user_access_role')->where([['country', '=', $country]])->get();
            $data['clients2'] = ClientAppointmentList::where([['country', '=', $country]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion != "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion != "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion != "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['religion', '=', $religion]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['religion', '=', $religion]])->get();
            $data['users'] = DB::table('user_access_role')->where([['religion', '=', $religion]])->get();
            $data['clients2'] = ClientAppointmentList::where([['religion', '=', $religion]])->get();
            $data['searchf'] = "Search for ".$religion;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city],['zip', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city],['zip', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$city.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode != "")) {
            $data['clients'] = ClientAppointmentList::where([['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['zip', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$zipcode;
        }
        elseif (($religion == "all") && ($country == "") && ($state == "") && ($city != "") && ($zipcode == "")) {
            $data['clients'] = ClientAppointmentList::where([['city', '=', $city]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['city', '=', $city]])->get();
            $data['clients2'] = ClientAppointmentList::where([['city', '=', $city]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$country.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode != "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['zip', '=', $zipcode]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['zip_code', '=', $zipcode]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$zipcode;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state;
        }
        elseif(($religion == "all") && ($country == "") && ($state != "") && ($city != "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['affiliates'] = AffiliateRegistration::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['users'] = DB::table('user_access_role')->where([['state', '=', $state],['city', '=', $city]])->get();
            $data['clients2'] = ClientAppointmentList::where([['state', '=', $state],['city', '=', $city]])->get();
            $data['searchf'] = "Search for ".$religion.", ".$state.", ".$city;
        }
        elseif(($religion == "all") && ($country == "") && ($state == "") && ($city == "") && ($zipcode == "")){
            $data['clients'] = ClientAppointmentList::get();
            $data['affiliates'] = AffiliateRegistration::get();
            $data['users'] = DB::table('user_access_role')->get();
            $data['clients2'] = ClientAppointmentList::get();
            $data['searchf'] = "Search for ".$religion;
        }
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.business_search_step2')->with($data);
    }
    public function business_search_stepp2(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company = $request->company;
        Session::put('first_name', $first_name);
        Session::put('last_name', $last_name);
        Session::put('company', $company);
        if(($first_name == "") && ($last_name == "") && ($company == "")){
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Enter Details.");
        }
        return redirect('business_search_stepp2_detail');
    }
    public function business_search_stepp2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $first_name = Session::get('first_name');
        $last_name = Session::get('last_name');
        $company = Session::get('company');

        $data['clients'] = "";
        $data['searchf'] = "";
        $data['affiliates'] = "";
        $data['clients2'] = "";
        $data['users'] = "";
        if(($first_name != "") && ($last_name != "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$last_name.", ".$company;
        }
        elseif(($first_name == "") && ($last_name == "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = "";
            $data['users'] = "";
            $data['clients2'] = ClientAppointmentList::where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$company;
        }
        elseif(($first_name == "") && ($last_name != "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$last_name;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company != "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('company', 'like', '%' .$company. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('company', 'like', '%' .$company. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$company;
        }
        elseif(($first_name != "") && ($last_name == "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name;
        }
        elseif(($first_name != "") && ($last_name != "") && ($company == "")){
            $data['clients'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
             $data['affiliates'] = AffiliateRegistration::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['users'] = DB::table('user_access_role')->where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['clients2'] = ClientAppointmentList::where('first_name', 'like', '%' .$first_name. '%')->where('last_name', 'like', '%' .$last_name. '%')->get();
            $data['searchf'] = "Search for ".$first_name.", ".$last_name;
        }

        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.business_search_step2')->with($data);
    }
    public function business_search_steppp2(Request $request)
    {
        $category = $request->category;
        Session::put('category', $category);
        return redirect('business_search_steppp2_detail');
    }
    public function business_search_steppp2_detail()
    {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $aaid = "";
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = AppointmentBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $category = Session::get('category');
        $data['clients'] = ClientAppointmentList::select('client_appointment_lists.first_name as first_name', 'client_appointment_lists.last_name as last_name', 'client_appointment_lists.email as email', 'client_appointment_lists.company as company', 'client_appointment_lists.address as address', 'client_appointment_lists.state as state','client_appointment_lists.country as country', 'client_appointment_lists.zip_code as zip', 'client_appointment_lists.city as city', 'client_appointment_lists.cell_phone as phone', 'client_appointment_lists.image as image')
                ->join('users', 'users.id', '=', 'client_appointment_lists.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $data['affiliates'] = AffiliateRegistration::where('business_category', $category)->get();
        $data['clients2'] = ClientAppointmentList::select('client_appointment_lists.first_name as first_name', 'client_appointment_lists.last_name as last_name', 'client_appointment_lists.email as email', 'client_appointment_lists.company as company', 'client_appointment_lists.address as address', 'client_appointment_lists.state as state','client_appointment_lists.country as country', 'client_appointment_lists.zip_code as zip', 'client_appointment_lists.city as city', 'client_appointment_lists.cell_phone as phone', 'client_appointment_lists.image as image')
                ->join('users', 'users.id', '=', 'client_appointment_lists.uid')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $data['users'] = DB::table('user_access_role')
                ->join('users', 'users.id', '=', 'user_access_role.sponsor_id')
                ->join('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
                ->where('affiliate_registrations.business_category', $category)
                ->get();
        $category_name = BusinessCategory::where('id', $category)->first();
        $data['searchf'] = "Search for ".$category_name->category;
        $data['chat'] = "off";
        $data['tools'] = "off";
        return view('main.business_search_step2')->with($data);
    }
public function submit_form_servey_data(Request $request)
{
   //  echo "<pre>";
   // print_r($request->all());
   // die;
    $data['user_id']=Auth::id();
    $data['role']=Auth::user()->role;
    $data['questions']=json_encode($request->question);
    $data['survey_data']=json_encode($request->option);
    $data['feedback_msg']=$request->feedback_msg;
    $data['created_at']=date('Y-m-d H:i:s');
    $data['updated_at']=date('Y-m-d H:i:s');
    DB::table('user_survey_records')->insert($data);
    $notification  = getNotificationMessage(84);
          $message = $notification;
     $subject = "Survey Submitted";
     addUserActivity($subject,'add',$notification,$message);
    return redirect()->back()->with('status',"Survey submitted successfully.");
}
public function get_survey_result(Request $request)
{
    $html='';
    ob_start();
      $value=DB::table('user_survey_records')->where('user_survey_records.id',$request->id)
    ->leftJoin('users', 'users.id', '=', 'user_survey_records.user_id')
    ->select('user_survey_records.*','users.name','users.email')
                        ->first();
      $question=json_decode($value->questions,true);
      $data=json_decode($value->survey_data,true);
      ?>
      <style type="text/css">
       .tbl2 tr,.tbl2 td,.tbl2 th {
    text-align: left;
}
      </style>
     <table class="table table-bordered tbl2">
        <tr>
            <th>Question</th>
            <th>Answer</th>
        </tr>
      <?php
      if(!empty($data)){
        foreach($data as $key=>$val){
       ?>
      <tr>
          <td><?= $question[$key];?></td>
          <td style="color: green"><?=$val;?></td>
      </tr>

     <?php
        }
      }
      ?>

      </table>
      <div class="col-md-12">
        <div class="form-group">
                <label class="form-label"><b>Feedback Message :</b></label>
        <p><?=$value->feedback_msg;?></p>
    </div>
</div>
      <?php
 $html=ob_get_clean();
    echo $html;
}





// folder count


 public function dashboardfoldercount(Request $request)
    {

        $val = $request->val;
        $folder = $request->folder;
        $uid =Auth::id();

        $appointments = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('contacts')->whereDate('created_at', '=', date('Y-m-d'))->where('folder',$folder)->where('uid', $uid)->where('status',1)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('contacts')->whereMonth('created_at', '=', date('m'))->where('folder',$folder)->where('uid', $uid)->where('status', 1)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('contacts')->whereBetween('created_at', [$start1, $end1])->where('folder',$folder)->where('uid', $uid)->where('status', 1)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $datetitlee];
    }




public function dashboardfoldercount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $folder=$request->folder;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('contacts')->whereDate('created_at', '=', $date)->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));
            $appointmentsww = DB::table('contacts')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();

             $appointments = DB::table('contacts')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('contacts')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }
    public function dashboardfoldercount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $folder=$request->folder;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('contacts')->whereDate('created_at', '=', $date)->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('contacts')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('contacts')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->where('status',1)->where('folder',$folder)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }



// client count
  public function dashboardnewclientcount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', date('Y-m-d'))->where('uid', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url("new_client_lists?daily=$date");
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', date('m'))->where('uid', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
             $link=url("new_client_lists?monthly=").date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;

            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("new_client_lists?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }

    public function dashboardnewclientcount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $folder=$request->folder;
        $appointments = "";
        $prevdate = "";
          $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("new_client_lists?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));
            $appointmentsww = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();

             $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
             $link=url("new_client_lists?monthly=$month");
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("new_client_lists?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardnewclientcount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $folder=$request->folder;
        $appointments = "";
        $prevdate = "";
          $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("new_client_lists?daily=$date");
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
              $link=url("new_client_lists?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("new_client_lists?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }





// client management count
  public function dashboardclientmgtcount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', date('Y-m-d'))->where('uid', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url("manage_clients?daily=$date");
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', date('m'))->where('uid', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
            $link=url("manage_clients?monthly=").date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_clients?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }
    public function dashboardclientmgtcount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $link = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("manage_clients?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));
            $appointmentsww = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();

             $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
             $link=url("manage_clients?monthly=$month");
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_clients?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardclientmgtcount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('client_appointment_lists')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("manage_clients?daily=$date");
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('client_appointment_lists')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
             $link=url("manage_clients?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('client_appointment_lists')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("manage_clients?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }



// dashbaord events count

  public function dashboardeventscount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('meeting_task')->whereDate('date', '=', date('Y-m-d'))->where('affiliate_id', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('meeting_task')->whereMonth('date', '=', date('m'))->where('affiliate_id', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('meeting_task')->whereBetween('date', [$start1, $end1])->where('affiliate_id', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $datetitlee];
    }
    public function dashboardeventscount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('meeting_task')->whereDate('date', '=', $date)->where('affiliate_id', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));
            $appointmentsww = DB::table('meeting_task')->whereMonth('date', '=', $month)->whereYear('date', '=', $year)->where('affiliate_id', $uid)->count();
             $appointments = DB::table('meeting_task')->whereMonth('date', '=', $month)->whereYear('date', '=', $year)->where('affiliate_id', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('meeting_task')->whereBetween('date', [$start1, $end1])->where('affiliate_id', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }
    public function dashboardeventscount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('meeting_task')->whereDate('date', '=', $date)->where('affiliate_id', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('meeting_task')->whereMonth('date', '=', $month)->whereYear('date', '=', $year)->where('affiliate_id', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('meeting_task')->whereBetween('date', [$start1, $end1])->where('affiliate_id', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }





// dashbaord birthday count

  public function dashboardbirthdaycount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('client_appointment_lists')->where('dob', '=', date('m/d/Y'))->where('uid', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
        }
        elseif ($val == "Monthly") {
            $month1=date('m',strtotime($date));
            $appointments = DB::table('client_appointment_lists')->where('dob', 'like', '%' .$month1. '%')->where('uid', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('m/d/Y', strtotime($date . '-'.$dd.' days'));
            $end1 = date('m/d/Y', strtotime($date. '+'.(6-$dd).' days'));
            $appointments = DB::table('client_appointment_lists')->whereBetween('dob', [$start1, $end1])->where('uid', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $datetitlee];
    }
    public function dashboardbirthdaycount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){

            $date1=date('m/d/Y',strtotime($date));
            $appointments = DB::table('client_appointment_lists')->where('dob', '=', $date1)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));
            $appointments = DB::table('client_appointment_lists')->where('dob', 'like', '%' .$month1. '%')->where('uid', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));

            $start1 = date('m/d/Y', strtotime($date . '-'.$dd.' days'));
            $end1 = date('m/d/Y', strtotime($date. '+'.(6-$dd).' days'));
            $appointments = DB::table('client_appointment_lists')->whereBetween('dob', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }
    public function dashboardbirthdaycount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
             $date1=date('m/d/Y',strtotime($date));
            $appointments = DB::table('client_appointment_lists')->where('dob', '=', $date1)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {

            $month1 = date('m', strtotime($request->date));
            $appointments = DB::table('client_appointment_lists')->where('dob', 'like', '%' .$month1. '%')->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('m/d/Y', strtotime($date . '-'.$dd.' days'));
            $end1 = date('m/d/Y', strtotime($date. '+'.(6-$dd).' days'));
            $appointments = DB::table('client_appointment_lists')->whereBetween('dob', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }






// dashbaord payment/balance count

  public function dashboardbalancecount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){



       $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=', date('Y-m-d'))->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereDate('transaction_date', '=', date('Y-m-d'))->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=', date('Y-m-d'))->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;
        $appointments="$payment/$balance ";
         $datetitlee = "For ".date('d F Y', strtotime($date));
        }
        elseif ($val == "Monthly") {


        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', date('m'))->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', date('m'))->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', date('m'))->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;

        $appointments="$payment/$balance ";
            $datetitlee = "For month of ".date('F', strtotime($date));
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";

        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;

            $appointments="$payment/$balance ";
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $datetitlee];
    }
    public function dashboardbalancecount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){


         $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;

        $appointments="$payment/$balance ";
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {

        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;
        $appointments="$payment/$balance ";
        $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
        $datetitlee = "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";


        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;

        $appointments="$payment/$balance ";
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }
    public function dashboardbalancecount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){


        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereDate('transaction_date', '=',$date)->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;
        $appointments="$payment/$balance ";
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
        }
        elseif ($count_basis == "Monthly") {

        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;
        $appointments="$payment/$balance ";
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";

        $payment1=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $payment2=DB::table('expense_record')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('amount_paid');
        $bal=DB::table('revenue_record')->where('client_email','!=','')->where(['uid'=>$uid])->whereBetween('transaction_date', [$start1, $end1])->sum('balance');
        $bal=str_replace('-',' ',$bal);
        $balance='$'.$bal;
        $payment=$payment1;
        $appointments="$payment/$balance ";
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
        }
        return $arr = [$appointments, $prevdate, $datetitlee];
    }






// dashbaord revenue recrods count

  public function dashboardrevenue_recordscount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $link = "";
        $datetitlee = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('revenue_record')->whereDate('transaction_date', '=', date('Y-m-d'))->where('uid', $uid)->sum('bill');
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url('revenue_records?daily=').$date;
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('revenue_record')->whereMonth('transaction_date', '=', date('m'))->where('uid', $uid)->sum('bill');
            $datetitlee = "For month of ".date('F', strtotime($date));
             $link=url('revenue_records?monthly=').date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
           //  $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
           // $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
           //  $appointments = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("revenue_records?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }

    public function dashboardrevenue_recordscount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
          $link = "";
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('revenue_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('bill');
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('revenue_records?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));

             $appointments = DB::table('revenue_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('bill');
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
             $link=url('revenue_records?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("revenue_records?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardrevenue_recordscount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
         $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('revenue_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('bill');
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('revenue_records?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('revenue_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('bill');
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
             $link=url('revenue_records?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("revenue_records?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }






// dashbaord revenue recrods count

  public function dashboardexpense_recordscount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('expense_record')->whereDate('transaction_date', '=', date('Y-m-d'))->where('uid', $uid)->sum('amount_paid');
            $datetitlee = "For ".date('d F Y', strtotime($date));
             $link=url('expenses_reord?daily=').$date;
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('expense_record')->whereMonth('transaction_date', '=', date('m'))->where('uid', $uid)->sum('amount_paid');
            $datetitlee = "For month of ".date('F', strtotime($date));
             $link=url('expenses_reord?monthly=').date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("expenses_reord?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }
    public function dashboardexpense_recordscount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('expense_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('amount_paid');
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('expenses_reord?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));

             $appointments = DB::table('expense_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('amount_paid');
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
             $link=url('expenses_reord?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("expenses_reord?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardexpense_recordscount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('expense_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('amount_paid');
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('expenses_reord?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('expense_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('amount_paid');
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
            $link=url('expenses_reord?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("expenses_reord?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }




// dashbaord profit loss recrods count

  public function dashboardprofitlossscount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments1 = DB::table('revenue_record')->whereDate('transaction_date', '=', date('Y-m-d'))->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereDate('transaction_date', '=', date('Y-m-d'))->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url('profit_loss_stmt?daily=').$date;
        }
        elseif ($val == "Monthly") {
            $appointments1 = DB::table('revenue_record')->whereMonth('transaction_date', '=', date('m'))->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereMonth('transaction_date', '=', date('m'))->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $datetitlee = "For month of ".date('F', strtotime($date));
            $link=url('profit_loss_stmt?monthly=').date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments1 = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;

            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("profit_loss_stmt?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee, $link];
    }
    public function dashboardprofitlossscount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments1 = DB::table('revenue_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('amount_paid');
             $appointments=$appointments1-$appointments2;
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('profit_loss_stmt?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));

             $appointments1 = DB::table('revenue_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('bill');
             $appointments2 = DB::table('expense_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('amount_paid');
             $appointments=$appointments1-$appointments2;
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
            $link=url('profit_loss_stmt?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments1 = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');

            $appointments=$appointments1-$appointments2;
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("profit_loss_stmt?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardprofitlossscount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments1 = DB::table('revenue_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereDate('transaction_date', '=', $date)->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url('profit_loss_stmt?daily=').$date;
        }
        elseif ($count_basis == "Monthly") {

            $appointments1 = DB::table('revenue_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereMonth('transaction_date', '=', $month)->whereYear('transaction_date', '=', $year)->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
            $link=url('profit_loss_stmt?monthly=').$month;
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments1 = DB::table('revenue_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('bill');
            $appointments2 = DB::table('expense_record')->whereBetween('transaction_date', [$start1, $end1])->where('uid', $uid)->sum('amount_paid');
            $appointments=$appointments1-$appointments2;
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("profit_loss_stmt?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }






// lab test count
  public function dashboardlabscount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('lab_tests')->whereDate('created_at', '=', date('Y-m-d'))->where('uid', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
            $link=url("lab/lab-test?daily=$date");
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('lab_tests')->whereMonth('created_at', '=', date('m'))->where('uid', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
            $link=url("lab/lab-test?monthly=").date('m');
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('lab_tests')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/lab-test?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }
    public function dashboardlabscount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $link = "";
        $prevdate = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('lab_tests')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url("lab/lab-test?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));

             $appointments = DB::table('lab_tests')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
            $link=url("lab/lab-test?monthly=$month");
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('lab_tests')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/lab-test?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee, $link];
    }
    public function dashboardlabscount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('lab_tests')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
            $link=url("lab/lab-test?daily=$date");
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('lab_tests')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
            $link=url("lab/lab-test?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('lab_tests')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
            $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/lab-test?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee, $link];
    }









// pharmacy count
  public function dashboardpharmacycount(Request $request)
    {

        $val = $request->val;
        $uid =Auth::id();
        $appointments = "";
        $datetitlee = "";
        $link = "";
        $date = date('Y-m-d');
        $sunday = date('Y-m-d', strtotime('sunday this week'));
        $saturday = date('Y-m-d', strtotime('saturday this week'));
        if($val == "Daily"){
            $appointments = DB::table('pharmacy_details')->whereDate('created_at', '=', date('Y-m-d'))->where('uid', $uid)->count();
            $datetitlee = "For ".date('d F Y', strtotime($date));
             $link=url("lab/pharmacy?daily=$date");
        }
        elseif ($val == "Monthly") {
            $appointments = DB::table('pharmacy_details')->whereMonth('created_at', '=', date('m'))->where('uid', $uid)->count();
            $datetitlee = "For month of ".date('F', strtotime($date));
            $month= date('m');
            $link=url("lab/pharmacy?monthly=$month");
        }
        elseif($val == "Weekly"){
            $dd = date('w', strtotime($date));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('pharmacy_details')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $start = date('d F Y', strtotime($date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($date. '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/pharmacy?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $datetitlee,$link];
    }
    public function dashboardpharmacycount_pre(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;

        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' -1 day'));
        $month = date('m', strtotime($request->date . ' -1 month'));
        $year = date('Y', strtotime($request->date . ' -1 month'));
        $day = date('w', strtotime($request->date . ' -1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('pharmacy_details')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("lab/pharmacy?daily=$date");
        }
        elseif ($count_basis == "Monthly") {
            $month1 = date('m', strtotime($request->date));

             $appointments = DB::table('pharmacy_details')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
           $prevdate = date('Y-m-d', strtotime($date . ' -1 month'));
            $datetitlee = "For month of ".date('F', strtotime($prevdate));
            $link=url("lab/pharmacy?monthly=$month");
        }
        elseif($count_basis == "Weekly"){

            $dd = date('w', strtotime($request->date . ' +1 week'));
            $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('pharmacy_details')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' -1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/pharmacy?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }
    public function dashboardpharmacycount_next(Request $request)
    {
        $uid = Auth::id();
        $count_basis = $request->count_basis;
        $appointments = "";
        $prevdate = "";
        $link = "";
        $date = date('Y-m-d', strtotime($request->date . ' +1 day'));
        $month = date('m', strtotime($request->date . ' +1 month'));
        $year = date('Y', strtotime($request->date . ' +1 month'));
        $day = date('w', strtotime($request->date . ' +1 week'));
        $datetitlee = "";
        $sunday = date('Y-m-d', strtotime($request->date . '-'.$day.' days'));
        $saturday = date('Y-m-d', strtotime($request->date . '+'.(6-$day).' days'));
        if($count_basis == "Daily"){
            $appointments = DB::table('pharmacy_details')->whereDate('created_at', '=', $date)->where('uid', $uid)->count();
            $prevdate = $date;
            $datetitlee = "For ".date('d F Y', strtotime($prevdate));
             $link=url("lab/pharmacy?daily=$date");
        }
        elseif ($count_basis == "Monthly") {

            $appointments = DB::table('pharmacy_details')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($date . ' +1 month'));
            $datetitlee =  "For month of ".date('F', strtotime($prevdate));
             $link=url("lab/pharmacy?monthly=$month");
        }
        elseif($count_basis == "Weekly"){
            $dd = date('w', strtotime($request->date . ' +1 week'));
           $start1 = date('Y-m-d', strtotime($date . '-'.$dd.' days'))." 00:00:00";
            $end1 = date('Y-m-d', strtotime($date. '+'.(6-$dd).' days'))." 23:59:59";
            $appointments = DB::table('pharmacy_details')->whereBetween('created_at', [$start1, $end1])->where('uid', $uid)->count();
            $prevdate = date('Y-m-d', strtotime($request->date . ' +1 week'));

            $start = date('d F Y', strtotime($request->date . '-'.$dd.' days'));
            $end = date('d F Y', strtotime($request->date . '+'.(6-$dd).' days'));
            $datetitlee = $start." - ".$end;
             $start2=date('Y-m-d',strtotime($start));
            $end2=date('Y-m-d',strtotime($end));
            $link=url("lab/pharmacy?sdate=$start2&edate=$end2");
        }
        return $arr = [$appointments, $prevdate, $datetitlee,$link];
    }





   public function setGeoLocation(Request $request)
    {
     $data=$request->all();
    // print_r($data);
       Session::put('latitute', $data['latitude']);
       Session::put('longitude', $data['longitude']);
     echo "location set";

    }



 public function get_revenue_by_month_page(Request $request)
    {

        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $month=$request->month;
        $email = $request->client_id;
        $year=$request->year;

        // $revenue_records = DB::table('revenue_record')->where('client_email', $email)->whereMonth('transaction_date',$month)->whereYear('transaction_date',date('Y'))->get();

        if ($email != null || $email != "") {
            $revenue_records = DB::table('revenue_record')->where('client_email', $email)->whereMonth('transaction_date',$month)->whereYear('transaction_date',date('Y'))->get();
        } else {
            $revenue_records = DB::table('revenue_record')->whereMonth('transaction_date',$month)->whereYear('transaction_date',date('Y'))->get();
        }

        $charge=0;
        $tax=0;
        $shipping=0;
        $total=0;
        $amount_paid=0;
        $balance=0;

        foreach($revenue_records as $value){

                $charge +=$value->bill;
                $tax +=$value->tax;
                $shipping +=$value->shipping;
                $amount_paid +=$value->amount_paid;
                $total +=$value->total;
                $balance +=str_replace('-', '', $value->balance);
        }


        ?>

 <table class="table table-striped table-borde#da291c table-hover" id="datatable_sample">
    <thead>

            <tr class="bg-purple">
                <th >Total</th>
                <th></th>
                <th><?=$charge;?></th>
                <th><?=$tax;?></th>
                <th><?=$shipping;?></th>
                <th><?=$total;?></th>
                <th><?=$amount_paid;?></th>
                <th><?=$balance;?></th>
                <th></th>
            </tr>

        <tr>
            <th>Transaction Date</th>
            <th>Accounts / Desc</th>
            <th>Charged / Bill</th>
            <th>Tax</th>
            <th>Shipping</th>
            <th>Total</th>
            <th>Amount Paid</th>
            <th>Balance</th>
            <th>Action</th>
        </tr>
    </thead>
        <tbody id="listid">
            <?php
            if($revenue_records->count()>0)
            {
            foreach ($revenue_records as $value) {
            ?>
                <tr>
                    <td>
                        <label class="checkbox chk-sm">
                            <input class="tran_check" type="checkbox" value="<?= $value->id ?>" onchange="tran_check()" />
                            <i></i> <?= date('d F Y', strtotime($value->transaction_date)); ?>
                        </label>
                    </td>
                    <td><?= $value->account_description ?></td>
                    <td><?= $value->bill ?></td>
                    <td><?= $value->tax ?></td>
                    <td><?= $value->shipping ?></td>
                    <td><?= $value->total ?></td>
                    <td><?= $value->amount_paid ?></td>
                    <td>
                        <?php
                        if($value->balance >=0)
                        {
                         echo $value->balance;
                        }else{
                         echo "<span style='color:red'>".str_replace('-', '', $value->balance)."</sapn>";
                        }

                        ?>
                    </td>
                    <td>
                        <?php
                        if(($value->account_description != "Sales Tax Collected") && ($value->account_description != "Shipping Collected")){ ?>
                        <a href="<?=url('edit_revenue_record');?>/<?= $value->id ?>" class="btn btn-xs btn-info">Edit</a>
                        <a id="<?= $value->id ?>" class="btn btn-xs btn-info delete">Delete</a>
                       <?php } ?>
                    </td>
                </tr>

            <?php
            }
        }else{ ?>
          <tr>
              <td colspan="9" class="text-center">No data available</td>
          </tr>
         <?php } ?>
        </tbody>
        <tr class="" style="background-color:#FFCCCB">
                <th >Total</th>
                <th></th>
                <th><?=$charge;?></th>
                <th><?=$tax;?></th>
                <th><?=$shipping;?></th>
                <th><?=$total;?></th>
                <th><?=$amount_paid;?></th>
                <th><?=$balance;?></th>
                <th></th>
            </tr>
    </table>

    <?php

       $html=ob_get_clean();
       echo $html;

    }






 public function get_expense_by_month_page(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
         $month=$request->month;
       $expense_record = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', date('Y'))->whereMonth('transaction_date', $month)->orderBy('transaction_date', 'desc')->get();

        $charge=0;
        $tax=0;
        $shipping=0;
        $total=0;
        $amount_paid=0;
        $balance=0;

        foreach($expense_record as $value){

               $charge +=$value->total;

                $amount_paid +=$value->amount_paid;
                $total +=$value->total;
                $balance +=str_replace('-', '', $value->balance);
        }


        ?>

 <table class="table table-striped table-borde#da291c table-hover" id="datatable_sample">
    <thead>

            <tr class="bg-purple">
                <th>Total</th>
                <th></th>
                <th><?=$charge;?></th>
                <th><?=$amount_paid;?></th>
                <th><?=$balance;?></th>
                <th></th>
            </tr>

        <tr>
            <th style="text-align: center !important;">Transaction Date</th>
            <th>Accounts / Desc</th>
            <th>Charged / Bill</th>
            <th>Amount paid</th>
            <th>Balance</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($expense_record->count()>0)
        {
           foreach ($expense_record as $value) {
        ?>
            <tr>
                <td><?= date('d F Y', strtotime($value->transaction_date)); ?></td>
                <td><?= $value->account_description ?></td>
                <td><?= $value->total ?></td>
                <td><?= $value->amount_paid ?></td>
                <td> <?php
                        if($value->balance >=0)
                        {
                         echo $value->balance;
                        }else{
                         echo "<span style='color:red'>".str_replace('-', '', $value->balance)."</sapn>";
                        }
                        ?>
                </td>
                <td>
                    <a href="{{ url('edit_expense_record') }}/<?= $value->id ?>" class="btn btn-xs btn-info">Edit</a>
                    <a id="<?= $value->id ?>" class="btn btn-xs btn-info delete">Delete</a>
                </td>
            </tr>
        <?php
    }
        }else{ ?>
          <tr>
              <td colspan="6" class="text-center">No data available</td>
          </tr>
         <?php } ?>
        </tbody>
    </table>

    <?php

       $html=ob_get_clean();
       echo $html;




}





}
