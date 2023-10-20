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


class FrontReportController extends Controller
{
  public function profit_loss_stmt_weekly(Request $request){

    $year=$request->year;

    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
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
        $data['week1'] =$week1= $weeklycnt[0];
        $data['week2'] =$week2= $weeklycnt[1];
        $data['week3'] =$week3= $weeklycnt[2];
        $data['week4'] =$week4= $weeklycnt[3];
        $data['week5'] =$week5= $weeklycnt[4];
        //$data['week6'] = $weeklycnt[5];
        $data['week1s'] =$week1s= $weeklycnt2[0];
        $data['week2s'] =$week2s= $weeklycnt2[1];
        $data['week3s'] =$week3s= $weeklycnt2[2];
        $data['week4s'] =$week4s= $weeklycnt2[3];
        $data['week5s'] =$week5s= $weeklycnt2[4];
      //  $data['week6s'] = $weeklycnt2[5];
        $data['weekcnt'] =$weekcnt= $i;
        $data['revenue'] =$revenue= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['alljantotal'] =$alljantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['allfebtotal'] =$allfebtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['allmartotal'] =$allmartotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['allaprtotal'] =$allaprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['allmaytotal'] =$allmaytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['alljuntotal'] =$alljuntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['alljultotal'] =$alljultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['allaugtotal'] =$allaugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['allseptotal'] =$allseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['allocttotal'] =$allocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['allnovtotal'] =$allnovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['alldectotal']=$alldectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['allmonthtotal']=$allmonthtotal = $data['alljantotal'] + $data['allfebtotal'] + $data['allmartotal'] + $data['allaprtotal'] + $data['allmaytotal'] + $data['alljuntotal'] + $data['alljultotal'] + $data['allaugtotal'] + $data['allseptotal'] + $data['allocttotal'] + $data['allnovtotal'] + $data['alldectotal'];
        $data['otherjantotal']=$otherjantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jan');
        $data['otherfebtotal']=$otherfebtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('feb');
        $data['othermartotal']=$othermartotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('mar');
        $data['otheraprtotal']=$otheraprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('apr');
        $data['othermaytotal']=$othermaytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('may');
        $data['otherjuntotal']=$otherjuntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jun');
        $data['otherjultotal'] =$otherjultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jul');
        $data['otheraugtotal'] =$otheraugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('aug');
        $data['otherseptotal'] =$otherseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('sep');
        $data['otherocttotal'] =$otherocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('oct');
        $data['othernovtotal'] =$othernovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('nov');
        $data['otherdectotal'] =$otherdectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('decem');
        $data['othermonthtotal'] =$othermonthtotal= $data['otherjantotal'] + $data['otherfebtotal'] + $data['othermartotal'] + $data['otheraprtotal'] + $data['othermaytotal'] + $data['otherjuntotal'] + $data['otherjultotal'] + $data['otheraugtotal'] + $data['otherseptotal'] + $data['otherocttotal'] + $data['othernovtotal'] + $data['otherdectotal'];
        $data['jantotal'] =$jantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal'] =$febtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal'] =$martotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal'] =$aprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal'] =$maytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal'] =$juntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal'] =$jultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal'] =$augtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal'] =$septotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal'] =$octtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal'] =$novtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal'] =$dectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal'] =$monthtotal= $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['revenue_quaterly'] =$revenue_quaterly= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotal'] =$quaterlytotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['alljanmartotal'] =$alljanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('janmar');
        $data['allaprjuntotal'] =$allaprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('aprjun');
        $data['alljulseptotal'] =$alljulseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('julsep');
        $data['alloctdectotal'] =$alloctdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('octdec');
        $data['allquaterlytotal'] =$allquaterlytotal= $data['alljanmartotal'] + $data['allaprjuntotal'] + $data['alljulseptotal'] + $data['alloctdectotal'];
        $data['otherjanmartotal'] =$otherjanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('janmar');
        $data['otheraprjuntotal']=$otheraprjuntotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('aprjun');
        $data['otherjulseptotal']=$otherjulseptotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('julsep');
        $data['otheroctdectotal']=$otheroctdectotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('octdec');
        $data['otherquaterlytotal']=$otherquaterlytotal = $data['otherjanmartotal'] + $data['otheraprjuntotal'] + $data['otherjulseptotal'] + $data['otheroctdectotal'];
        $data['expenses']=$expenses = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['jantotall']=$jantotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotall']=$febtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotall']=$martotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotall']=$aprtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotall']=$maytotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotall']=$juntotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotall']=$jultotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotall']=$augtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotall']=$septotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotall']=$octtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotall']=$novtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotall']=$dectotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotall']=$monthtotall = $data['jantotall'] + $data['febtotall'] + $data['martotall'] + $data['aprtotall'] + $data['maytotall'] + $data['juntotall'] + $data['jultotall'] + $data['augtotall'] + $data['septotall'] + $data['octtotall'] + $data['novtotall'] + $data['dectotall'];
        $data['expenses_quaterly']=$expenses_quaterly = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotall']=$janmartotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotall']=$aprjuntotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotall']=$julseptotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotall']=$octdectotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotall']=$quaterlytotall = $data['janmartotall'] + $data['aprjuntotall'] + $data['julseptotall'] + $data['octdectotall'];
        $data['jantotal']=$jantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal']=$febtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal']=$martotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal']=$aprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal']=$maytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal']=$juntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal']=$jultotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal']=$augtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal']=$septotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal']=$octtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal']=$novtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal']=$dectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal']=$monthtotal = $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['jangrosstotal2']=$jangrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['febgrosstotal2']=$febgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['margrosstotal2']=$margrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['aprgrosstotal2']=$aprgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['maygrosstotal2']=$maygrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['jungrosstotal2']=$jungrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['julgrosstotal2']=$julgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['auggrosstotal2'] =$auggrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['sepgrosstotal2'] =$sepgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['octgrosstotal2'] =$octgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['novgrosstotal2'] =$novgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['decgrosstotal2'] =$decgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['jangrosstotal2'] + $data['febgrosstotal2'] + $data['margrosstotal2'] + $data['aprgrosstotal2'] + $data['maygrosstotal2'] + $data['jungrosstotal2'] + $data['julgrosstotal2'] + $data['auggrosstotal2'] + $data['sepgrosstotal2'] + $data['octgrosstotal2'] + $data['novgrosstotal2'] + $data['decgrosstotal2'];
        $data['jangrossactual'] =$jangrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['febgrossactual'] =$febgrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['margrossactual']=$margrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['aprgrossactual']=$aprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['maygrossactual']=$maygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['jungrossactual']=$jungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['julgrossactual']=$julgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['auggrossactual']=$auggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['sepgrossactual']=$sepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['octgrossactual']=$octgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['novgrossactual']=$novgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['decgrossactual']=$decgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['monthgrossactual']=$monthgrossactual = $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'] + $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'] + $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'] + $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['jantotalactual']=$jantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['febtotalactual']=$febtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['martotalactual']=$martotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['aprtotalactual']=$aprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['maytotalactual']=$maytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['juntotalactual']=$juntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['jultotalactual']=$jultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['augtotalactual']=$augtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['septotalactual']=$septotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['octtotalactual']=$octtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['novtotalactual']=$novtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['dectotalactual']=$dectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['monthtotalactual']=$monthtotalactual = $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'] + $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'] + $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'] + $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['janothrevenue']=$janothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['febothrevenue']=$febothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['marothrevenue']=$marothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['aprothrevenue']=$aprothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['mayothrevenue']=$mayothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['junothrevenue']=$junothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['julothrevenue']=$julothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['augothrevenue']=$augothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['sepothrevenue']=$sepothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['octothrevenue']=$octothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['novothrevenue']=$novothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['decothrevenue']=$decothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['monthothrevenue']=$monthothrevenue = $data['janothrevenue'] + $data['febothrevenue'] + $data['marothrevenue'] + $data['aprothrevenue'] + $data['mayothrevenue'] + $data['junothrevenue'] + $data['julothrevenue'] + $data['augothrevenue'] + $data['sepothrevenue'] + $data['octothrevenue'] + $data['novothrevenue'] + $data['decothrevenue'];
        $data['janotherrevenue']=$janotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['febotherrevenue']=$febotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['marotherrevenue']=$marotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['aprotherrevenue']=$aprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['mayotherrevenue']=$mayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['junotherrevenue']=$junotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['julotherrevenue']=$julotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['augotherrevenue']=$augotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['sepotherrevenue']=$sepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['octotherrevenue']=$octotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['novotherrevenue']=$novotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['decotherrevenue']=$decotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['monthotherrevenue']=$monthotherrevenue = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'] + $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'] + $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'] + $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['expense']=$expense = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['jantotal2']=$jantotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal2']=$febtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal2']=$martotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal2']=$aprtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal2']=$maytotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal2']=$juntotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal2']=$jultotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal2']=$augtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal2']=$septotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal2']=$octtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal2'] =$novtotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal2'] =$dectotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal2'] =$monthtotal2= $data['jantotal2'] + $data['febtotal2'] + $data['martotal2'] + $data['aprtotal2'] + $data['maytotal2'] + $data['juntotal2'] + $data['jultotal2'] + $data['augtotal2'] + $data['septotal2'] + $data['octtotal2'] + $data['novtotal2'] + $data['dectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['monthtotal2actual'] =$monthtotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'] + $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'] + $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'] + $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['ejantotal'] =$ejantotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal'] =$efebtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal'] =$emartotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal'] =$eaprtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal'] =$emaytotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal'] =$ejuntotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal'] =$ejultotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal'] =$eaugtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal'] =$eseptotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal'] =$eocttotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal'] =$enovtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal'] =$edectotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal'] =$emonthtotal= $data['ejantotal'] + $data['efebtotal'] + $data['emartotal'] + $data['eaprtotal'] + $data['emaytotal'] + $data['ejuntotal'] + $data['ejultotal'] + $data['eaugtotal'] + $data['eseptotal'] + $data['eocttotal'] + $data['enovtotal'] + $data['edectotal'];
        $data['ejangrosstotal2'] =$ejangrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['efebgrosstotal2'] =$efebgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['emargrosstotal2'] =$emargrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['eaprgrosstotal2'] =$eaprgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['emaygrosstotal2'] =$emaygrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['ejungrosstotal2'] =$ejungrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['ejulgrosstotal2'] =$ejulgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['eauggrosstotal2'] =$eauggrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['esepgrosstotal2']=$esepgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['eoctgrosstotal2']=$eoctgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['enovgrosstotal2']=$enovgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['edecgrosstotal2']=$edecgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['emonthgrosstotal2']=$emonthgrosstotal2 = $data['ejangrosstotal2'] + $data['efebgrosstotal2'] + $data['emargrosstotal2'] + $data['eaprgrosstotal2'] + $data['emaygrosstotal2'] + $data['ejungrosstotal2'] + $data['ejulgrosstotal2'] + $data['eauggrosstotal2'] + $data['esepgrosstotal2'] + $data['eoctgrosstotal2'] + $data['enovgrosstotal2'] + $data['edecgrosstotal2'];
        $data['ejangrossactual']=$ejangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['efebgrossactual']=$efebgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emargrossactual']=$emargrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eaprgrossactual']=$eaprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emaygrossactual']=$emaygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejungrossactual']=$ejungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejulgrossactual']=$ejulgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eauggrossactual']=$eauggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['esepgrossactual']=$esepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eoctgrossactual']=$eoctgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['enovgrossactual']=$enovgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['edecgrossactual']=$edecgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emonthgrossactual']=$emonthgrossactual = $data['ejangrossactual'] + $data['efebgrossactual'] + $data['emargrossactual'] + $data['eaprgrossactual'] + $data['emaygrossactual'] + $data['ejungrossactual'] + $data['ejulgrossactual'] + $data['eauggrossactual'] + $data['esepgrossactual'] + $data['eoctgrossactual'] + $data['enovgrossactual'] + $data['edecgrossactual'];
        $data['ejantotalactual']=$ejantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['efebtotalactual']=$efebtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['emartotalactual']=$emartotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['eaprtotalactual']=$eaprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['emaytotalactual']=$emaytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['ejuntotalactual']=$ejuntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['ejultotalactual'] =$ejultotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['eaugtotalactual'] =$eaugtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['eseptotalactual'] =$eseptotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['eocttotalactual'] =$eocttotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['enovtotalactual'] =$enovtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['edectotalactual'] =$edectotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['emonthtotalactual'] =$emonthtotalactual= $data['ejantotalactual'] + $data['efebtotalactual'] + $data['emartotalactual'] + $data['eaprtotalactual'] + $data['emaytotalactual'] + $data['ejuntotalactual'] + $data['ejultotalactual'] + $data['eaugtotalactual'] + $data['eseptotalactual'] + $data['eocttotalactual'] + $data['enovtotalactual'] + $data['edectotalactual'];
        $data['ejanothrevenue'] =$ejanothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['efebothrevenue'] =$efebothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['emarothrevenue'] =$emarothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['eaprothrevenue'] =$eaprothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['emayothrevenue'] =$emayothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['ejunothrevenue'] =$ejunothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['ejulothrevenue'] =$ejulothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['eaugothrevenue'] =$eaugothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['esepothrevenue'] =$esepothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['eoctothrevenue'] =$eoctothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['enovothrevenue'] =$enovothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['edecothrevenue'] =$edecothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['emonthothrevenue'] =$emonthothrevenue= $data['ejanothrevenue'] + $data['efebothrevenue'] + $data['emarothrevenue'] + $data['eaprothrevenue'] + $data['emayothrevenue'] + $data['ejunothrevenue'] + $data['ejulothrevenue'] + $data['eaugothrevenue'] + $data['esepothrevenue'] + $data['eoctothrevenue'] + $data['enovothrevenue'] + $data['edecothrevenue'];
        $data['ejanotherrevenue'] =$ejanotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['efebotherrevenue'] =$efebotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emarotherrevenue'] =$emarotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaprotherrevenue'] =$eaprotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emayotherrevenue'] =$emayotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejunotherrevenue'] =$ejunotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejulotherrevenue'] =$ejulotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaugotherrevenue'] =$eaugotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['esepotherrevenue'] =$esepotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eoctotherrevenue'] =$eoctotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['enovotherrevenue'] =$enovotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['edecotherrevenue'] =$edecotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emonthotherrevenue'] =$emonthotherrevenue= $data['ejanotherrevenue'] + $data['efebotherrevenue'] + $data['emarotherrevenue'] + $data['eaprotherrevenue'] + $data['emayotherrevenue'] + $data['ejunotherrevenue'] + $data['ejulotherrevenue'] + $data['eaugotherrevenue'] + $data['esepotherrevenue'] + $data['eoctotherrevenue'] + $data['enovotherrevenue'] + $data['edecotherrevenue'];
        $data['eexpense'] =$eexpense= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['ejantotal2'] =$ejantotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal2'] =$efebtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal2'] =$emartotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal2'] =$eaprtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal2'] =$emaytotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal2'] =$ejuntotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal2'] =$ejultotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal2'] =$eaugtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal2'] =$eseptotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal2'] =$eocttotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal2'] =$enovtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal2'] =$edectotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal2'] =$emonthtotal2= $data['ejantotal2'] + $data['efebtotal2'] + $data['emartotal2'] + $data['eaprtotal2'] + $data['emaytotal2'] + $data['ejuntotal2'] + $data['ejultotal2'] + $data['eaugtotal2'] + $data['eseptotal2'] + $data['eocttotal2'] + $data['enovtotal2'] + $data['edectotal2'];
        $data['ejantotal2actual'] =$ejantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['efebtotal2actual'] =$efebtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['emartotal2actual'] =$emartotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['eaprtotal2actual'] =$eaprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['emaytotal2actual'] =$emaytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['ejuntotal2actual'] =$ejuntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['ejultotal2actual'] =$ejultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['eaugtotal2actual'] =$eaugtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['eseptotal2actual'] =$eseptotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['eocttotal2actual'] =$eocttotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['enovtotal2actual'] =$enovtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['edectotal2actual'] =$edectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['emonthtotal2actual'] =$emonthtotal2actual= $data['ejantotal2actual'] + $data['efebtotal2actual'] + $data['emartotal2actual'] + $data['eaprtotal2actual'] + $data['emaytotal2actual'] + $data['ejuntotal2actual'] + $data['ejultotal2actual'] + $data['eaugtotal2actual'] + $data['eseptotal2actual'] + $data['eocttotal2actual'] + $data['enovtotal2actual'] + $data['edectotal2actual'];
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal'] =$monthtotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['janmargrosstotal2'] =$janmargrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('janmar');
        $data['aprjungrosstotal2'] =$aprjungrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aprjun');
        $data['julsepgrosstotal2'] =$julsepgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('julsep');
        $data['octdecgrosstotal2'] =$octdecgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('octdec');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['janmargrosstotal2'] + $data['aprjungrosstotal2'] + $data['julsepgrosstotal2'] + $data['octdecgrosstotal2'];
         $data['janmargrossactual'] =$janmargrossactual= $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'];
        $data['aprjungrossactual'] =$aprjungrossactual= $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'];
        $data['julsepgrossactual'] =$julsepgrossactual= $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'];
        $data['octdecgrossactual'] =$octdecgrossactual= $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['monthgrossactual'] =$monthgrossactual= $data['janmargrossactual'] + $data['aprjungrossactual'] + $data['julsepgrossactual'] + $data['octdecgrossactual'];
        $data['janmarothrevenue'] =$janmarothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('janmar');
        $data['aprjunothrevenue'] =$aprjunothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aprjun');
        $data['julsepothrevenue'] =$julsepothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('julsep');
        $data['octdecothrevenue'] =$octdecothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('octdec');
        $data['monthothrevenue'] =$monthothrevenue= $data['janmarothrevenue'] + $data['aprjunothrevenue'] + $data['julsepothrevenue'] + $data['octdecothrevenue'];
        $data['janmarotherrevenue'] =$janmarotherrevenue= $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'];
        $data['aprjunotherrevenue'] =$aprjunotherrevenue=$aprjunotherrevenue= $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'];
        $data['julsepotherrevenue'] =$julsepotherrevenue= $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'];
        $data['octdecotherrevenue'] =$octdecotherrevenue= $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['monthotherrevenue'] =$monthotherrevenue= $data['janmarotherrevenue'] + $data['aprjunotherrevenue'] + $data['julsepotherrevenue'] + $data['octdecotherrevenue'];
        $data['janmartotalactual'] =$janmartotalactual= $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'];
        $data['aprjuntotalactual'] =$aprjuntotalactual= $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'];
        $data['julseptotalactual'] =$julseptotalactual= $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'];
        $data['octdectotalactual'] =$octdectotalactual= $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['monthtotalactual'] =$monthtotalactual= $data['janmartotalactual'] + $data['aprjuntotalactual'] + $data['julseptotalactual'] + $data['octdectotalactual'];
        $data['expensess'] =$expensess= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['janmartotal2'] =$janmartotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal2'] =$aprjuntotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal2'] =$julseptotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal2'] =$octdectotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal2'] =$monthtotal2= $data['janmartotal2'] + $data['aprjuntotal2'] + $data['julseptotal2'] + $data['octdectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['janmartotal2actual'] =$janmartotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'];
        $data['aprjuntotal2actual'] =$aprjuntotal2actual= $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'];
        $data['julseptotal2actual'] =$julseptotal2actual= $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'];
        $data['octdectotal2actual'] =$octdectotal2actual= $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['monthtotal2actual'] =$monthtotal2actual= $data['janmartotal2actual'] + $data['aprjuntotal2actual'] + $data['julseptotal2actual'] + $data['octdectotal2actual'];
        $data['assets'] =$assets= DB::table('asset_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('description')->orderBy('id', 'desc')->get();
        $data['chat'] =$chat= "";
        $data['tools'] =$tools= "";
         $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
       $data['expense_account']=$expense_account = DB::table('expense_record')->where('account_description','!=','Sales Tax Paid')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_start();
        ?>

        <div class="table-wrap">
          <table class="table table-striped table-bordered table-hover main-table" id="">
            <thead>
              <?php if($weekcnt == 3){ ?>
              <tr class="top-tr">
                <th class="fixed-side"></th>
                <th>1st Week</th>
                <th>2nd Week</th>
                <th>3rd Week</th>
                <th>Total</th>
              </tr>
              <?php }elseif ($weekcnt == 4) { ?>
              <tr class="top-tr">
                <th class="fixed-side"></th>
                <th>1st Week</th>
                <th>2nd Week</th>
                <th>3rd Week</th>
                <th>4th Week</th>
                <th>Total</th>
              </tr>
              <?php }elseif ($weekcnt == 5) { ?>
              <tr class="top-tr">
                <th class="fixed-side"></th>
                <th>1st Week</th>
                <th>2nd Week</th>
                <th>3rd Week</th>
                <th>4th Week</th>
                <th>5th Week</th>
                <th>Total</th>
              </tr>
              <?php }elseif ($weekcnt == 6) { ?>
              <tr class="top-tr">
                <th class="fixed-side"></th>
                <th>1st Week</th>
                <th>2nd Week</th>
                <th>3rd Week</th>
                <th>4th Week</th>
                <th>5th Week</th>
                <th>6th Week</th>
                <th>Total</th>
              </tr>
              <?php } ?>
              </thead>
              <tbody>
              <tr>
                <?php if($weekcnt == 3){ ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 4) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 5) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 6) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php } ?>
              </tr>
              <tr class="odd gradeX">
                <td class="fixed-side">Gross Revenue</td>
                <?php if($weekcnt == 3){ ?>
                <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                <td><?=$week1+$week2+$week3 ?></td>
                <?php }elseif ($weekcnt == 4) { ?>
                <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                <td class="grossweek" id="gweek3"><?= $week4 ?></td>
                <td><?=$week1+$week2+$week3+$week4 ?></td>
                <?php }elseif ($weekcnt == 5) { ?>
                <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                <td class="grossweek" id="gweek3"><?= $week4 ?></td>
                <td class="grossweek" id="gweek4"><?= $week5 ?></td>
                <td><?=$week1+$week2+$week3+$week4+$week5 ?></td>
                <?php }elseif ($weekcnt == 6) { ?>
                <td class="grossweek" id="gweek0"><?= $week1 ?></td>
                <td class="grossweek" id="gweek1"><?= $week2 ?></td>
                <td class="grossweek" id="gweek2"><?= $week3 ?></td>
                <td class="grossweek" id="gweek3"><?= $week4 ?></td>
                <td class="grossweek" id="gweek4"><?= $week5 ?></td>
                <!--  <td class="grossweek" id="gweek5">\</td> -->
                <td><?=$week1+$week2+$week3+$week4+$week5 ?></td>
                <?php } ?>
              </tr>
              <!-- .nk-tb-item  -->
              <tr class="odd gradeX">
                <td class="fixed-side">Other Revenue</td>
                <?php if($weekcnt == 3){ ?>
                <td class="otherrweek" id="oweek0"><?= $week1s ?></td>
                <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                <td><?= $week1s+$week2s+$week3s ?></td>
                <?php }elseif ($weekcnt == 4) { ?>
                <td class="otherrweek" id="owee0"><?= $week1s ?></td>
                <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                <td class="otherrweek" id="oweek3"><?= $week4s ?></td>
                <td><?=$week1s+$week2s+$week3s+$week4s ?></td>
                <?php }elseif ($weekcnt == 5) { ?>
                <td class="otherrweek" id="oweek0"><?= $week1s ?></td>
                <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                <td class="otherrweek" id="oweek3"><?= $week4s ?></td>
                <td class="otherrweek" id="oweek4"><?= $week5s ?></td>
                <td><?=$week1s+$week2s+$week3s+$week4s+$week5s?></td>
                <?php }elseif ($weekcnt == 6) { ?>
                <td class="otherrweek" id="oweek0"><?= $week1s ?></td>
                <td class="otherrweek" id="oweek1"><?= $week2s ?></td>
                <td class="otherrweek" id="oweek2"><?= $week3s ?></td>
                <td class="otherrweek" id="oweek3"><?= $week4s ?></td>
                <td class="otherrweek" id="oweek4"><?= $week5s ?></td>
                <!--  <td class="otherrweek" id="oweek5"></td> -->
                <td><?=$week1s+$week2s+$week3s+$week4s+$week5s ?></td>
                <?php } ?>
              </tr>
              <!-- .nk-tb-item  -->
              <tr class="total-tr">
                <td class="fixed-side" style=""><b>Total Revenue</b></td>
                <?php if($weekcnt == 3){ ?>
                <td><?= $week1 + $week1s ?></td>
                <td><?= $week2 + $week2s ?></td>
                <td><?= $week3 + $week3s ?></td>
                <td><?=$week1+$week2+$week3+$week1s+$week2s+$week3s ?></td>
                <?php }elseif ($weekcnt == 4) { ?>
                <td><?= $week1 + $week1s ?></td>
                <td><?= $week2 + $week2s ?></td>
                <td><?= $week3 + $week3s ?></td>
                <td><?= $week4 + $week4s ?></td>
                <td><?=$week1+$week2+$week3+$week4+$week1s+$week2s+$week3s+$week4s ?></td>
                <?php }elseif ($weekcnt == 5) { ?>
                <td><?= $week1 + $week1s ?></td>
                <td><?= $week2 + $week2s ?></td>
                <td><?= $week3 + $week3s ?></td>
                <td><?= $week4 + $week4s ?></td>
                <td><?= $week5 + $week5s ?></td>
                <td><?=$week1+$week2+$week3+$week4+$week5+$week1s+$week2s+$week3s+$week4s+$week5s ?></td>
                <?php }elseif ($weekcnt == 6) { ?>
                <td><?= $week1 + $week1s ?></td>
                <td><?= $week2 + $week2s ?></td>
                <td><?= $week3 + $week3s ?></td>
                <td><?= $week4 + $week4s ?></td>
                <td><?= $week5 + $week5s ?></td>
                <td><?=$week1+$week2+$week3+$week4+$week5+$week1s+$week2s+$week3s+$week4s+$week5s?></td>
                <?php } ?>
              </tr>
              <!-- .nk-tb-item  -->
              <tr>
                <?php if($weekcnt == 3){ ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 4) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 5) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php }elseif ($weekcnt == 6) { ?>
                <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <?php } ?>
              </tr>
              <?php 
                foreach($expensess as $value){
                ?>
              <tr class="odd gradeX">
                <td class="fixed-side"><?= $value->name ?></td>
                <?php
                   echo $actual_week =MainController::getweekactualexp($value->name);
                   ?>
              </tr>
              <?php } ?>
              <tr class="total2-tr">
                <td class="fixed-side" style=""><b>Total Expenses</b></td>
                <?php
                   echo $actual_week_total = MainController::getweekactualexptotal();
                   ?>
              </tr>
              </tbody>
              <tbody></tbody>
              <tfoot>
              <tr>
                <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                <?php
                   echo $actual_week_diff = MainController::getweekactualexpdiff();
                   ?>
              </tr>
              <!-- .nk-tb-item  -->
              </tfoot>
              </table>
              </div>
              <?php
        $html=ob_get_clean();
        echo $html;

  }
  public function profit_loss_stmt_monthly(Request $request){
    $year=$request->year;
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
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
        $data['week1'] =$week1= $weeklycnt[0];
        $data['week2'] =$week2= $weeklycnt[1];
        $data['week3'] =$week3= $weeklycnt[2];
        $data['week4'] =$week4= $weeklycnt[3];
        $data['week5'] =$week5= $weeklycnt[4];
        //$data['week6'] = $weeklycnt[5];
        $data['week1s'] =$week1s= $weeklycnt2[0];
        $data['week2s'] =$week2s= $weeklycnt2[1];
        $data['week3s'] =$week3s= $weeklycnt2[2];
        $data['week4s'] =$week4s= $weeklycnt2[3];
        $data['week5s'] =$week5s= $weeklycnt2[4];
      //  $data['week6s'] = $weeklycnt2[5];
        $data['weekcnt'] =$weekcnt= $i;
        $data['revenue'] =$revenue= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['alljantotal'] =$alljantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['allfebtotal'] =$allfebtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['allmartotal'] =$allmartotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['allaprtotal'] =$allaprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['allmaytotal'] =$allmaytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['alljuntotal'] =$alljuntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['alljultotal'] =$alljultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['allaugtotal'] =$allaugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['allseptotal'] =$allseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['allocttotal'] =$allocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['allnovtotal'] =$allnovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['alldectotal']=$alldectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['allmonthtotal']=$allmonthtotal = $data['alljantotal'] + $data['allfebtotal'] + $data['allmartotal'] + $data['allaprtotal'] + $data['allmaytotal'] + $data['alljuntotal'] + $data['alljultotal'] + $data['allaugtotal'] + $data['allseptotal'] + $data['allocttotal'] + $data['allnovtotal'] + $data['alldectotal'];
        $data['otherjantotal']=$otherjantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jan');
        $data['otherfebtotal']=$otherfebtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('feb');
        $data['othermartotal']=$othermartotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('mar');
        $data['otheraprtotal']=$otheraprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('apr');
        $data['othermaytotal']=$othermaytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('may');
        $data['otherjuntotal']=$otherjuntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jun');
        $data['otherjultotal'] =$otherjultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jul');
        $data['otheraugtotal'] =$otheraugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('aug');
        $data['otherseptotal'] =$otherseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('sep');
        $data['otherocttotal'] =$otherocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('oct');
        $data['othernovtotal'] =$othernovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('nov');
        $data['otherdectotal'] =$otherdectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('decem');
        $data['othermonthtotal'] =$othermonthtotal= $data['otherjantotal'] + $data['otherfebtotal'] + $data['othermartotal'] + $data['otheraprtotal'] + $data['othermaytotal'] + $data['otherjuntotal'] + $data['otherjultotal'] + $data['otheraugtotal'] + $data['otherseptotal'] + $data['otherocttotal'] + $data['othernovtotal'] + $data['otherdectotal'];
        $data['jantotal'] =$jantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal'] =$febtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal'] =$martotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal'] =$aprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal'] =$maytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal'] =$juntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal'] =$jultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal'] =$augtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal'] =$septotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal'] =$octtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal'] =$novtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal'] =$dectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal'] =$monthtotal= $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['revenue_quaterly'] =$revenue_quaterly= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotal'] =$quaterlytotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['alljanmartotal'] =$alljanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('janmar');
        $data['allaprjuntotal'] =$allaprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('aprjun');
        $data['alljulseptotal'] =$alljulseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('julsep');
        $data['alloctdectotal'] =$alloctdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('octdec');
        $data['allquaterlytotal'] =$allquaterlytotal= $data['alljanmartotal'] + $data['allaprjuntotal'] + $data['alljulseptotal'] + $data['alloctdectotal'];
        $data['otherjanmartotal'] =$otherjanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('janmar');
        $data['otheraprjuntotal']=$otheraprjuntotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('aprjun');
        $data['otherjulseptotal']=$otherjulseptotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('julsep');
        $data['otheroctdectotal']=$otheroctdectotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('octdec');
        $data['otherquaterlytotal']=$otherquaterlytotal = $data['otherjanmartotal'] + $data['otheraprjuntotal'] + $data['otherjulseptotal'] + $data['otheroctdectotal'];
        $data['expenses']=$expenses = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['jantotall']=$jantotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotall']=$febtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotall']=$martotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotall']=$aprtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotall']=$maytotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotall']=$juntotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotall']=$jultotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotall']=$augtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotall']=$septotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotall']=$octtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotall']=$novtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotall']=$dectotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotall']=$monthtotall = $data['jantotall'] + $data['febtotall'] + $data['martotall'] + $data['aprtotall'] + $data['maytotall'] + $data['juntotall'] + $data['jultotall'] + $data['augtotall'] + $data['septotall'] + $data['octtotall'] + $data['novtotall'] + $data['dectotall'];
        $data['expenses_quaterly']=$expenses_quaterly = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotall']=$janmartotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotall']=$aprjuntotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotall']=$julseptotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotall']=$octdectotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotall']=$quaterlytotall = $data['janmartotall'] + $data['aprjuntotall'] + $data['julseptotall'] + $data['octdectotall'];
        $data['jantotal']=$jantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal']=$febtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal']=$martotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal']=$aprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal']=$maytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal']=$juntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal']=$jultotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal']=$augtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal']=$septotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal']=$octtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal']=$novtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal']=$dectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal']=$monthtotal = $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['jangrosstotal2']=$jangrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['febgrosstotal2']=$febgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['margrosstotal2']=$margrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['aprgrosstotal2']=$aprgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['maygrosstotal2']=$maygrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['jungrosstotal2']=$jungrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['julgrosstotal2']=$julgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['auggrosstotal2'] =$auggrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['sepgrosstotal2'] =$sepgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['octgrosstotal2'] =$octgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['novgrosstotal2'] =$novgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['decgrosstotal2'] =$decgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['jangrosstotal2'] + $data['febgrosstotal2'] + $data['margrosstotal2'] + $data['aprgrosstotal2'] + $data['maygrosstotal2'] + $data['jungrosstotal2'] + $data['julgrosstotal2'] + $data['auggrosstotal2'] + $data['sepgrosstotal2'] + $data['octgrosstotal2'] + $data['novgrosstotal2'] + $data['decgrosstotal2'];
        $data['jangrossactual'] =$jangrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['febgrossactual'] =$febgrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['margrossactual']=$margrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['aprgrossactual']=$aprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['maygrossactual']=$maygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['jungrossactual']=$jungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['julgrossactual']=$julgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['auggrossactual']=$auggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['sepgrossactual']=$sepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['octgrossactual']=$octgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['novgrossactual']=$novgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['decgrossactual']=$decgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['monthgrossactual']=$monthgrossactual = $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'] + $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'] + $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'] + $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['jantotalactual']=$jantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['febtotalactual']=$febtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['martotalactual']=$martotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['aprtotalactual']=$aprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['maytotalactual']=$maytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['juntotalactual']=$juntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['jultotalactual']=$jultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['augtotalactual']=$augtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['septotalactual']=$septotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['octtotalactual']=$octtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['novtotalactual']=$novtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['dectotalactual']=$dectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['monthtotalactual']=$monthtotalactual = $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'] + $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'] + $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'] + $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['janothrevenue']=$janothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['febothrevenue']=$febothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['marothrevenue']=$marothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['aprothrevenue']=$aprothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['mayothrevenue']=$mayothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['junothrevenue']=$junothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['julothrevenue']=$julothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['augothrevenue']=$augothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['sepothrevenue']=$sepothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['octothrevenue']=$octothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['novothrevenue']=$novothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['decothrevenue']=$decothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['monthothrevenue']=$monthothrevenue = $data['janothrevenue'] + $data['febothrevenue'] + $data['marothrevenue'] + $data['aprothrevenue'] + $data['mayothrevenue'] + $data['junothrevenue'] + $data['julothrevenue'] + $data['augothrevenue'] + $data['sepothrevenue'] + $data['octothrevenue'] + $data['novothrevenue'] + $data['decothrevenue'];
        $data['janotherrevenue']=$janotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['febotherrevenue']=$febotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['marotherrevenue']=$marotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['aprotherrevenue']=$aprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['mayotherrevenue']=$mayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['junotherrevenue']=$junotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['julotherrevenue']=$julotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['augotherrevenue']=$augotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['sepotherrevenue']=$sepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['octotherrevenue']=$octotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['novotherrevenue']=$novotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['decotherrevenue']=$decotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['monthotherrevenue']=$monthotherrevenue = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'] + $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'] + $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'] + $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['expense']=$expense = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['jantotal2']=$jantotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal2']=$febtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal2']=$martotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal2']=$aprtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal2']=$maytotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal2']=$juntotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal2']=$jultotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal2']=$augtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal2']=$septotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal2']=$octtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal2'] =$novtotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal2'] =$dectotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal2'] =$monthtotal2= $data['jantotal2'] + $data['febtotal2'] + $data['martotal2'] + $data['aprtotal2'] + $data['maytotal2'] + $data['juntotal2'] + $data['jultotal2'] + $data['augtotal2'] + $data['septotal2'] + $data['octtotal2'] + $data['novtotal2'] + $data['dectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['monthtotal2actual'] =$monthtotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'] + $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'] + $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'] + $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['ejantotal'] =$ejantotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal'] =$efebtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal'] =$emartotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal'] =$eaprtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal'] =$emaytotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal'] =$ejuntotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal'] =$ejultotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal'] =$eaugtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal'] =$eseptotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal'] =$eocttotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal'] =$enovtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal'] =$edectotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal'] =$emonthtotal= $data['ejantotal'] + $data['efebtotal'] + $data['emartotal'] + $data['eaprtotal'] + $data['emaytotal'] + $data['ejuntotal'] + $data['ejultotal'] + $data['eaugtotal'] + $data['eseptotal'] + $data['eocttotal'] + $data['enovtotal'] + $data['edectotal'];
        $data['ejangrosstotal2'] =$ejangrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['efebgrosstotal2'] =$efebgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['emargrosstotal2'] =$emargrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['eaprgrosstotal2'] =$eaprgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['emaygrosstotal2'] =$emaygrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['ejungrosstotal2'] =$ejungrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['ejulgrosstotal2'] =$ejulgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['eauggrosstotal2'] =$eauggrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['esepgrosstotal2']=$esepgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['eoctgrosstotal2']=$eoctgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['enovgrosstotal2']=$enovgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['edecgrosstotal2']=$edecgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['emonthgrosstotal2']=$emonthgrosstotal2 = $data['ejangrosstotal2'] + $data['efebgrosstotal2'] + $data['emargrosstotal2'] + $data['eaprgrosstotal2'] + $data['emaygrosstotal2'] + $data['ejungrosstotal2'] + $data['ejulgrosstotal2'] + $data['eauggrosstotal2'] + $data['esepgrosstotal2'] + $data['eoctgrosstotal2'] + $data['enovgrosstotal2'] + $data['edecgrosstotal2'];
        $data['ejangrossactual']=$ejangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['efebgrossactual']=$efebgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emargrossactual']=$emargrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eaprgrossactual']=$eaprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emaygrossactual']=$emaygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejungrossactual']=$ejungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejulgrossactual']=$ejulgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eauggrossactual']=$eauggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['esepgrossactual']=$esepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eoctgrossactual']=$eoctgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['enovgrossactual']=$enovgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['edecgrossactual']=$edecgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emonthgrossactual']=$emonthgrossactual = $data['ejangrossactual'] + $data['efebgrossactual'] + $data['emargrossactual'] + $data['eaprgrossactual'] + $data['emaygrossactual'] + $data['ejungrossactual'] + $data['ejulgrossactual'] + $data['eauggrossactual'] + $data['esepgrossactual'] + $data['eoctgrossactual'] + $data['enovgrossactual'] + $data['edecgrossactual'];
        $data['ejantotalactual']=$ejantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['efebtotalactual']=$efebtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['emartotalactual']=$emartotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['eaprtotalactual']=$eaprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['emaytotalactual']=$emaytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['ejuntotalactual']=$ejuntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['ejultotalactual'] =$ejultotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['eaugtotalactual'] =$eaugtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['eseptotalactual'] =$eseptotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['eocttotalactual'] =$eocttotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['enovtotalactual'] =$enovtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['edectotalactual'] =$edectotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['emonthtotalactual'] =$emonthtotalactual= $data['ejantotalactual'] + $data['efebtotalactual'] + $data['emartotalactual'] + $data['eaprtotalactual'] + $data['emaytotalactual'] + $data['ejuntotalactual'] + $data['ejultotalactual'] + $data['eaugtotalactual'] + $data['eseptotalactual'] + $data['eocttotalactual'] + $data['enovtotalactual'] + $data['edectotalactual'];
        $data['ejanothrevenue'] =$ejanothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['efebothrevenue'] =$efebothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['emarothrevenue'] =$emarothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['eaprothrevenue'] =$eaprothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['emayothrevenue'] =$emayothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['ejunothrevenue'] =$ejunothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['ejulothrevenue'] =$ejulothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['eaugothrevenue'] =$eaugothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['esepothrevenue'] =$esepothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['eoctothrevenue'] =$eoctothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['enovothrevenue'] =$enovothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['edecothrevenue'] =$edecothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['emonthothrevenue'] =$emonthothrevenue= $data['ejanothrevenue'] + $data['efebothrevenue'] + $data['emarothrevenue'] + $data['eaprothrevenue'] + $data['emayothrevenue'] + $data['ejunothrevenue'] + $data['ejulothrevenue'] + $data['eaugothrevenue'] + $data['esepothrevenue'] + $data['eoctothrevenue'] + $data['enovothrevenue'] + $data['edecothrevenue'];
        $data['ejanotherrevenue'] =$ejanotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['efebotherrevenue'] =$efebotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emarotherrevenue'] =$emarotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaprotherrevenue'] =$eaprotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emayotherrevenue'] =$emayotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejunotherrevenue'] =$ejunotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejulotherrevenue'] =$ejulotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaugotherrevenue'] =$eaugotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['esepotherrevenue'] =$esepotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eoctotherrevenue'] =$eoctotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['enovotherrevenue'] =$enovotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['edecotherrevenue'] =$edecotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emonthotherrevenue'] =$emonthotherrevenue= $data['ejanotherrevenue'] + $data['efebotherrevenue'] + $data['emarotherrevenue'] + $data['eaprotherrevenue'] + $data['emayotherrevenue'] + $data['ejunotherrevenue'] + $data['ejulotherrevenue'] + $data['eaugotherrevenue'] + $data['esepotherrevenue'] + $data['eoctotherrevenue'] + $data['enovotherrevenue'] + $data['edecotherrevenue'];
        $data['eexpense'] =$eexpense= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['ejantotal2'] =$ejantotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal2'] =$efebtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal2'] =$emartotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal2'] =$eaprtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal2'] =$emaytotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal2'] =$ejuntotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal2'] =$ejultotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal2'] =$eaugtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal2'] =$eseptotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal2'] =$eocttotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal2'] =$enovtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal2'] =$edectotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal2'] =$emonthtotal2= $data['ejantotal2'] + $data['efebtotal2'] + $data['emartotal2'] + $data['eaprtotal2'] + $data['emaytotal2'] + $data['ejuntotal2'] + $data['ejultotal2'] + $data['eaugtotal2'] + $data['eseptotal2'] + $data['eocttotal2'] + $data['enovtotal2'] + $data['edectotal2'];
        $data['ejantotal2actual'] =$ejantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['efebtotal2actual'] =$efebtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['emartotal2actual'] =$emartotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['eaprtotal2actual'] =$eaprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['emaytotal2actual'] =$emaytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['ejuntotal2actual'] =$ejuntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['ejultotal2actual'] =$ejultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['eaugtotal2actual'] =$eaugtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['eseptotal2actual'] =$eseptotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['eocttotal2actual'] =$eocttotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['enovtotal2actual'] =$enovtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['edectotal2actual'] =$edectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['emonthtotal2actual'] =$emonthtotal2actual= $data['ejantotal2actual'] + $data['efebtotal2actual'] + $data['emartotal2actual'] + $data['eaprtotal2actual'] + $data['emaytotal2actual'] + $data['ejuntotal2actual'] + $data['ejultotal2actual'] + $data['eaugtotal2actual'] + $data['eseptotal2actual'] + $data['eocttotal2actual'] + $data['enovtotal2actual'] + $data['edectotal2actual'];
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal'] =$monthtotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['janmargrosstotal2'] =$janmargrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('janmar');
        $data['aprjungrosstotal2'] =$aprjungrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aprjun');
        $data['julsepgrosstotal2'] =$julsepgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('julsep');
        $data['octdecgrosstotal2'] =$octdecgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('octdec');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['janmargrosstotal2'] + $data['aprjungrosstotal2'] + $data['julsepgrosstotal2'] + $data['octdecgrosstotal2'];
         $data['janmargrossactual'] =$janmargrossactual= $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'];
        $data['aprjungrossactual'] =$aprjungrossactual= $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'];
        $data['julsepgrossactual'] =$julsepgrossactual= $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'];
        $data['octdecgrossactual'] =$octdecgrossactual= $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['monthgrossactual'] =$monthgrossactual= $data['janmargrossactual'] + $data['aprjungrossactual'] + $data['julsepgrossactual'] + $data['octdecgrossactual'];
        $data['janmarothrevenue'] =$janmarothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('janmar');
        $data['aprjunothrevenue'] =$aprjunothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aprjun');
        $data['julsepothrevenue'] =$julsepothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('julsep');
        $data['octdecothrevenue'] =$octdecothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('octdec');
        $data['monthothrevenue'] =$monthothrevenue= $data['janmarothrevenue'] + $data['aprjunothrevenue'] + $data['julsepothrevenue'] + $data['octdecothrevenue'];
        $data['janmarotherrevenue']=$janmarotherrevenue = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'];
        $data['aprjunotherrevenue'] =$aprjunotherrevenue= $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'];
        $data['julsepotherrevenue'] =$julsepotherrevenue= $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'];
        $data['octdecotherrevenue'] =$octdecotherrevenue= $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['monthotherrevenue'] =$monthotherrevenue= $data['janmarotherrevenue'] + $data['aprjunotherrevenue'] + $data['julsepotherrevenue'] + $data['octdecotherrevenue'];
        $data['janmartotalactual'] =$janmartotalactual= $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'];
        $data['aprjuntotalactual'] =$aprjuntotalactual= $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'];
        $data['julseptotalactual'] =$julseptotalactual= $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'];
        $data['octdectotalactual'] =$octdectotalactual= $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['monthtotalactual'] =$monthtotalactual= $data['janmartotalactual'] + $data['aprjuntotalactual'] + $data['julseptotalactual'] + $data['octdectotalactual'];
        $data['expensess'] =$expensess= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['janmartotal2'] =$janmartotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal2'] =$aprjuntotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal2'] =$julseptotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal2'] =$octdectotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal2'] =$monthtotal2= $data['janmartotal2'] + $data['aprjuntotal2'] + $data['julseptotal2'] + $data['octdectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['janmartotal2actual'] =$janmartotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'];
        $data['aprjuntotal2actual'] =$aprjuntotal2actual= $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'];
        $data['julseptotal2actual'] =$julseptotal2actual= $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'];
        $data['octdectotal2actual'] =$octdectotal2actual= $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['monthtotal2actual'] =$monthtotal2actual= $data['janmartotal2actual'] + $data['aprjuntotal2actual'] + $data['julseptotal2actual'] + $data['octdectotal2actual'];
        $data['assets'] =$assets= DB::table('asset_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('description')->orderBy('id', 'desc')->get();
        $data['chat'] =$chat= "";
        $data['tools'] =$tools= "";
         $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
       $data['expense_account']=$expense_account = DB::table('expense_record')->where('account_description','!=','Sales Tax Paid')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_start();
        ?>


    <div class="table-wrap">
                                <?php
                              $tott2 = ($jantotal2actual + $febtotal2actual + $martotal2actual + $aprtotal2actual + $maytotal2actual + $juntotal2actual + $jultotal2actual + $augtotal2actual + $septotal2actual + $octtotal2actual + $novtotal2actual + $dectotal2actual); ?>
                                 <table class="table table-striped table-bordered table-hover main-table" id="">
                                    <thead>
                                       <tr class="bg-purple">
                                          <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                          <td><?= ($jantotalactual-$jantotal2actual) ?></td>
                                          <td><?= ($febtotalactual-$febtotal2actual) ?></td>
                                          <td><?= ($martotalactual-$martotal2actual) ?></td>
                                          <td><?= ($aprtotalactual-$aprtotal2actual) ?></td>
                                          <td><?= ($maytotalactual-$maytotal2actual) ?></td>
                                          <td><?= ($juntotalactual-$juntotal2actual) ?></td>
                                          <td><?= ($jultotalactual-$jultotal2actual) ?></td>
                                          <td><?= ($augtotalactual-$augtotal2actual) ?></td>
                                          <td><?= ($septotalactual-$septotal2actual) ?></td>
                                          <td><?= ($octtotalactual-$octtotal2actual) ?></td>
                                          <td><?= ($novtotalactual-$novtotal2actual) ?></td>
                                          <td><?= ($dectotalactual-$dectotal2actual) ?></td>
                                          <td><?= ($monthtotalactual-$tott2) ?></td>
                                          <td>
                                             <!-- <a href="#"><i class="fa fa-bar-chart"></i></a> -->
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                    </thead>
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
                                    <tbody>
                                       <tr>
                                          <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Revenue</b></td>
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
                                       <tr class="odd gradeX">
                                          <td class="fixed-side">Gross Revenue</td>
                                          <?php if($jangrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="01revactual"><?= $jangrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $jangrossactual ?></td>
                                          <?php } ?> 
                                          <?php if($febgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="02revactual"><?= $febgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $febgrossactual ?></td>
                                          <?php } ?> 
                                          <?php if($margrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="03revactual"><?= $margrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $margrossactual ?></td>
                                          <?php } ?> 
                                          <?php if($aprgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="04revactual"><?= $aprgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $aprgrossactual ?></td>
                                          <?php } ?> 
                                          <?php if($maygrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="05revactual"><?= $maygrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $maygrossactual ?></td>
                                          <?php } ?>
                                          <?php if($jungrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="06revactual"><?= $jungrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $jungrossactual ?></td>
                                          <?php } ?>
                                          <?php if($julgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="07revactual"><?= $julgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $julgrossactual ?></td>
                                          <?php } ?>
                                          <?php if($auggrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="08revactual"><?= $auggrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $auggrossactual ?></td>
                                          <?php } ?>
                                          <?php if($sepgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="09revactual"><?= $sepgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $sepgrossactual ?></td>
                                          <?php } ?>
                                          <?php if($octgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="10revactual"><?= $octgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $octgrossactual ?></td>
                                          <?php } ?>
                                          <?php if($novgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="11revactual"><?= $novgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $novgrossactual ?></td>
                                          <?php } ?>
                                          <?php if($decgrossactual != 0){ ?>
                                          <td><a class="actual_month_revenue" id="12revactual"><?= $decgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $decgrossactual ?></td>
                                          <?php } ?>
                                          <td><?= $monthgrossactual ?></td>
                                          <td>
                                             <a href="<?= url('gross_revenue_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr class="odd gradeX">
                                          <td class="fixed-side">Other Revenue</td>
                                          <?php if($janotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="01otheractual"><?= $janotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $janotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($febotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="02otheractual"><?= $febotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $febotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($marotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="03otheractual"><?= $marotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $marotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($aprotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="04otheractual"><?= $aprotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $aprotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($mayotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="05otheractual"><?= $mayotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $mayotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($junotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="06otheractual"><?= $junotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $junotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($julotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="07otheractual"><?= $julotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $julotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($augotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="08otheractual"><?= $augotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $augotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($sepotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="09otheractual"><?= $sepotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $sepotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($octotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="10otheractual"><?= $octotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $octotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($novotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="11otheractual"><?= $novotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $novotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($decotherrevenue != 0){ ?>
                                          <td><a class="actual_other_revenue" id="12otheractual"><?= $decotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $decotherrevenue ?></td>
                                          <?php } ?>
                                          <td><?= $monthotherrevenue ?></td>
                                          <td>
                                             <a href="<?= url('other_revenue_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr class="total-tr">
                                          <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                          <td><?= $jantotalactual ?></td>
                                          <td><?= $febtotalactual ?></td>
                                          <td><?= $martotalactual ?></td>
                                          <td><?= $aprtotalactual ?></td>
                                          <td><?= $maytotalactual ?></td>
                                          <td><?= $juntotalactual ?></td>
                                          <td><?= $jultotalactual ?></td>
                                          <td><?= $augtotalactual ?></td>
                                          <td><?= $septotalactual ?></td>
                                          <td><?= $octtotalactual ?></td>
                                          <td><?= $novtotalactual ?></td>
                                          <td><?= $dectotalactual ?></td>
                                          <td><?= $monthtotalactual ?></td>
                                          <td>
                                             <a href="<?= url('all_revenue_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr>
                                          <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
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
                                       <?php
                                          $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12'];
                                          foreach($expense_account as $value){
                                          ?>
                                       <tr class="odd gradeX">
                                          <td class="fixed-side"><?= $value->account_description ?></td>
                                          <?php
                                             $tot = 0;
                                                 foreach ($months_arr as $valuee) {
                                                     $count =MainController::get_month_count_expense($valuee, $value->account_description);
                                             
                                                     $tot += $count;
                                             
                                                     // echo '<td>'.$count.'</td>';
                                             
                                                     if($count > 0){
                                                         echo '<td><a class="revenue_month" id="'.$valuee.'revenue_month'.$value->account_description.'">'.$count.'</a></td>';
                                                     }
                                                     else{
                                                         echo '<td>'.$count.'</td>';
                                                     }
                                                 }
                                              ?>
                                          <td><?= $tot ?></td>
                                          <td>
                                             <a href="<?= url('expense_variance_monthly_graph')."/".$value->account_description ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <?php
                                          }
                                          ?>
                                       <?php 
                                          foreach($expense as $value){
                                          ?>
                                       <tr class="odd gradeX">
                                          <td class="fixed-side"><?= $value->name ?></td>
                                          <?php
                                             $actual_jan = HomeController::getjanactualexp($value->name);
                                             if($actual_jan!= 0){ ?>
                                          <td><a class="actual_monthly_expense" id="01actualexpense<?= $value->name ?>"><?= $actual_jan ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_jan ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_feb =HomeController::getfebactualexp($value->name);
                                             if($actual_feb != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="02actualexpense<?= $value->name ?>"><?= $actual_feb ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_feb ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_mar =HomeController::getmaractualexp($value->name);
                                             if($actual_mar != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="03actualexpense<?= $value->name ?>"><?= $actual_mar ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_mar ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_apr = HomeController::getapractualexp($value->name);
                                             if($actual_apr != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="04actualexpense<?= $value->name ?>"><?= $actual_apr ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_apr ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_may = HomeController::getmayactualexp($value->name);
                                             if($actual_may != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="05actualexpense<?= $value->name ?>"><?= $actual_may ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_may ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_jun =HomeController::getjunactualexp($value->name);
                                             if($actual_jun != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="06actualexpense<?= $value->name ?>"><?= $actual_jun ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_jun ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_jul = HomeController::getjulactualexp($value->name);
                                             if($actual_jul != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="07actualexpense<?= $value->name ?>"><?= $actual_jul ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_jul ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_aug = HomeController::getaugactualexp($value->name);
                                             if($actual_aug != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="08actualexpense<?= $value->name ?>"><?= $actual_aug ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_aug ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_sep = HomeController::getsepactualexp($value->name);
                                             if($actual_sep != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="09actualexpense<?= $value->name ?>"><?= $actual_sep ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_sep ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_oct = HomeController::getoctactualexp($value->name);
                                             if($actual_oct != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="10actualexpense<?= $value->name ?>"><?= $actual_oct ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_oct ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_nov = HomeController::getnovactualexp($value->name);
                                             if($actual_nov != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="11actualexpense<?= $value->name ?>"><?= $actual_nov ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_nov ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_decem = HomeController::getdecemactualexp($value->name);
                                             if($actual_decem != 0){ ?>
                                          <td><a class="actual_monthly_expense" id="12actualexpense<?= $value->name ?>"><?= $actual_decem ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_decem ?></td>
                                          <?php } ?>
                                          <td><?php echo $actual_total2 = HomeController::gettotalactualexp($value->name); ?></td>
                                          <td>
                                             <a href="<?= url('expense_variance_monthly_graph')."/".$value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                       <tr class="total2-tr">
                                          <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                          <td><?= $jantotal2actual ?></td>
                                          <td><?= $febtotal2actual ?></td>
                                          <td><?= $martotal2actual ?></td>
                                          <td><?= $aprtotal2actual ?></td>
                                          <td><?= $maytotal2actual ?></td>
                                          <td><?= $juntotal2actual ?></td>
                                          <td><?= $jultotal2actual ?></td>
                                          <td><?= $augtotal2actual ?></td>
                                          <td><?= $septotal2actual ?></td>
                                          <td><?= $octtotal2actual ?></td>
                                          <td><?= $novtotal2actual ?></td>
                                          <td><?= $dectotal2actual ?></td>
                                          <td><?= $tott2 = ($jantotal2actual + $febtotal2actual + $martotal2actual + $aprtotal2actual + $maytotal2actual + $juntotal2actual + $jultotal2actual + $augtotal2actual + $septotal2actual + $octtotal2actual + $novtotal2actual + $dectotal2actual) ?></td>
                                          <td>
                                             <a href="<?=url('expense_monthly_vary_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                          <td><?= ($jantotalactual-$jantotal2actual) ?></td>
                                          <td><?= ($febtotalactual-$febtotal2actual) ?></td>
                                          <td><?= ($martotalactual-$martotal2actual) ?></td>
                                          <td><?= ($aprtotalactual-$aprtotal2actual) ?></td>
                                          <td><?= ($maytotalactual-$maytotal2actual) ?></td>
                                          <td><?= ($juntotalactual-$juntotal2actual) ?></td>
                                          <td><?= ($jultotalactual-$jultotal2actual) ?></td>
                                          <td><?= ($augtotalactual-$augtotal2actual) ?></td>
                                          <td><?= ($septotalactual-$septotal2actual) ?></td>
                                          <td><?= ($octtotalactual-$octtotal2actual) ?></td>
                                          <td><?= ($novtotalactual-$novtotal2actual) ?></td>
                                          <td><?= ($dectotalactual-$dectotal2actual) ?></td>
                                          <td><?= ($monthtotalactual-$tott2) ?></td>
                                          <td>
                                             <!-- <a href="#"><i class="fa fa-bar-chart"></i></a> -->
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                    </tfoot>
                                 </table>
                              </div>
                              <?php
        $html=ob_get_clean();
        echo $html;



  }
  public function profit_loss_stmt_yearly(Request $request){
$year=$request->year;
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
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
        $data['week1'] =$week1= $weeklycnt[0];
        $data['week2'] =$week2= $weeklycnt[1];
        $data['week3'] =$week3= $weeklycnt[2];
        $data['week4'] =$week4= $weeklycnt[3];
        $data['week5'] =$week5= $weeklycnt[4];
        //$data['week6'] = $weeklycnt[5];
        $data['week1s'] =$week1s= $weeklycnt2[0];
        $data['week2s'] =$week2s= $weeklycnt2[1];
        $data['week3s'] =$week3s= $weeklycnt2[2];
        $data['week4s'] =$week4s= $weeklycnt2[3];
        $data['week5s'] =$week5s= $weeklycnt2[4];
      //  $data['week6s'] = $weeklycnt2[5];
        $data['weekcnt'] =$weekcnt= $i;
        $data['revenue'] =$revenue= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['alljantotal'] =$alljantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['allfebtotal'] =$allfebtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['allmartotal'] =$allmartotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['allaprtotal'] =$allaprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['allmaytotal'] =$allmaytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['alljuntotal'] =$alljuntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['alljultotal'] =$alljultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['allaugtotal'] =$allaugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['allseptotal'] =$allseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['allocttotal'] =$allocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['allnovtotal'] =$allnovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['alldectotal']=$alldectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['allmonthtotal']=$allmonthtotal = $data['alljantotal'] + $data['allfebtotal'] + $data['allmartotal'] + $data['allaprtotal'] + $data['allmaytotal'] + $data['alljuntotal'] + $data['alljultotal'] + $data['allaugtotal'] + $data['allseptotal'] + $data['allocttotal'] + $data['allnovtotal'] + $data['alldectotal'];
        $data['otherjantotal']=$otherjantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jan');
        $data['otherfebtotal']=$otherfebtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('feb');
        $data['othermartotal']=$othermartotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('mar');
        $data['otheraprtotal']=$otheraprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('apr');
        $data['othermaytotal']=$othermaytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('may');
        $data['otherjuntotal']=$otherjuntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jun');
        $data['otherjultotal'] =$otherjultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('jul');
        $data['otheraugtotal'] =$otheraugtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('aug');
        $data['otherseptotal'] =$otherseptotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('sep');
        $data['otherocttotal'] =$otherocttotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('oct');
        $data['othernovtotal'] =$othernovtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('nov');
        $data['otherdectotal'] =$otherdectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', 'Other Revenue')->sum('decem');
        $data['othermonthtotal'] =$othermonthtotal= $data['otherjantotal'] + $data['otherfebtotal'] + $data['othermartotal'] + $data['otheraprtotal'] + $data['othermaytotal'] + $data['otherjuntotal'] + $data['otherjultotal'] + $data['otheraugtotal'] + $data['otherseptotal'] + $data['otherocttotal'] + $data['othernovtotal'] + $data['otherdectotal'];
        $data['jantotal'] =$jantotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal'] =$febtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal'] =$martotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal'] =$aprtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal'] =$maytotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal'] =$juntotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal'] =$jultotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal'] =$augtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal'] =$septotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal'] =$octtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal'] =$novtotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal'] =$dectotal= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal'] =$monthtotal= $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['revenue_quaterly'] =$revenue_quaterly= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotal'] =$quaterlytotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['alljanmartotal'] =$alljanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('janmar');
        $data['allaprjuntotal'] =$allaprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('aprjun');
        $data['alljulseptotal'] =$alljulseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('julsep');
        $data['alloctdectotal'] =$alloctdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','!=','Other Revenue')->sum('octdec');
        $data['allquaterlytotal'] =$allquaterlytotal= $data['alljanmartotal'] + $data['allaprjuntotal'] + $data['alljulseptotal'] + $data['alloctdectotal'];
        $data['otherjanmartotal'] =$otherjanmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('janmar');
        $data['otheraprjuntotal']=$otheraprjuntotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('aprjun');
        $data['otherjulseptotal']=$otherjulseptotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('julsep');
        $data['otheroctdectotal']=$otheroctdectotal = DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name','Other Revenue')->sum('octdec');
        $data['otherquaterlytotal']=$otherquaterlytotal = $data['otherjanmartotal'] + $data['otheraprjuntotal'] + $data['otherjulseptotal'] + $data['otheroctdectotal'];
        $data['expenses']=$expenses = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['jantotall']=$jantotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotall']=$febtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotall']=$martotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotall']=$aprtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotall']=$maytotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotall']=$juntotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotall']=$jultotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotall']=$augtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotall']=$septotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotall']=$octtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotall']=$novtotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotall']=$dectotall = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotall']=$monthtotall = $data['jantotall'] + $data['febtotall'] + $data['martotall'] + $data['aprtotall'] + $data['maytotall'] + $data['juntotall'] + $data['jultotall'] + $data['augtotall'] + $data['septotall'] + $data['octtotall'] + $data['novtotall'] + $data['dectotall'];
        $data['expenses_quaterly']=$expenses_quaterly = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->orderBy('id', 'desc')->get();
        $data['janmartotall']=$janmartotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotall']=$aprjuntotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotall']=$julseptotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotall']=$octdectotall = DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['quaterlytotall']=$quaterlytotall = $data['janmartotall'] + $data['aprjuntotall'] + $data['julseptotall'] + $data['octdectotall'];
        $data['jantotal']=$jantotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal']=$febtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal']=$martotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal']=$aprtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal']=$maytotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal']=$juntotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal']=$jultotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal']=$augtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal']=$septotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal']=$octtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal']=$novtotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal']=$dectotal = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal']=$monthtotal = $data['jantotal'] + $data['febtotal'] + $data['martotal'] + $data['aprtotal'] + $data['maytotal'] + $data['juntotal'] + $data['jultotal'] + $data['augtotal'] + $data['septotal'] + $data['octtotal'] + $data['novtotal'] + $data['dectotal'];
        $data['jangrosstotal2']=$jangrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['febgrosstotal2']=$febgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['margrosstotal2']=$margrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['aprgrosstotal2']=$aprgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['maygrosstotal2']=$maygrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['jungrosstotal2']=$jungrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['julgrosstotal2']=$julgrosstotal2 = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['auggrosstotal2'] =$auggrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['sepgrosstotal2'] =$sepgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['octgrosstotal2'] =$octgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['novgrosstotal2'] =$novgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['decgrosstotal2'] =$decgrosstotal2= DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['jangrosstotal2'] + $data['febgrosstotal2'] + $data['margrosstotal2'] + $data['aprgrosstotal2'] + $data['maygrosstotal2'] + $data['jungrosstotal2'] + $data['julgrosstotal2'] + $data['auggrosstotal2'] + $data['sepgrosstotal2'] + $data['octgrosstotal2'] + $data['novgrosstotal2'] + $data['decgrosstotal2'];
        $data['jangrossactual'] =$jangrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['febgrossactual'] =$febgrossactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['margrossactual']=$margrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['aprgrossactual']=$aprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['maygrossactual']=$maygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['jungrossactual']=$jungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['julgrossactual']=$julgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['auggrossactual']=$auggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['sepgrossactual']=$sepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['octgrossactual']=$octgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['novgrossactual']=$novgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['decgrossactual']=$decgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['monthgrossactual']=$monthgrossactual = $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'] + $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'] + $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'] + $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['jantotalactual']=$jantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['febtotalactual']=$febtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['martotalactual']=$martotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['aprtotalactual']=$aprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['maytotalactual']=$maytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['juntotalactual']=$juntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['jultotalactual']=$jultotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['augtotalactual']=$augtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['septotalactual']=$septotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['octtotalactual']=$octtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['novtotalactual']=$novtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['dectotalactual']=$dectotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['monthtotalactual']=$monthtotalactual = $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'] + $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'] + $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'] + $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['janothrevenue']=$janothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['febothrevenue']=$febothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['marothrevenue']=$marothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['aprothrevenue']=$aprothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['mayothrevenue']=$mayothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['junothrevenue']=$junothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['julothrevenue']=$julothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['augothrevenue']=$augothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['sepothrevenue']=$sepothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['octothrevenue']=$octothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['novothrevenue']=$novothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['decothrevenue']=$decothrevenue = DB::table('revenue_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['monthothrevenue']=$monthothrevenue = $data['janothrevenue'] + $data['febothrevenue'] + $data['marothrevenue'] + $data['aprothrevenue'] + $data['mayothrevenue'] + $data['junothrevenue'] + $data['julothrevenue'] + $data['augothrevenue'] + $data['sepothrevenue'] + $data['octothrevenue'] + $data['novothrevenue'] + $data['decothrevenue'];
        $data['janotherrevenue']=$janotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['febotherrevenue']=$febotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['marotherrevenue']=$marotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['aprotherrevenue']=$aprotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['mayotherrevenue']=$mayotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['junotherrevenue']=$junotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['julotherrevenue']=$julotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['augotherrevenue']=$augotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['sepotherrevenue']=$sepotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['octotherrevenue']=$octotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['novotherrevenue']=$novotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['decotherrevenue']=$decotherrevenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['monthotherrevenue']=$monthotherrevenue = $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'] + $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'] + $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'] + $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['expense']=$expense = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['jantotal2']=$jantotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['febtotal2']=$febtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['martotal2']=$martotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['aprtotal2']=$aprtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['maytotal2']=$maytotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['juntotal2']=$juntotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['jultotal2']=$jultotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['augtotal2']=$augtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['septotal2']=$septotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['octtotal2']=$octtotal2 = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['novtotal2'] =$novtotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['dectotal2'] =$dectotal2= DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['monthtotal2'] =$monthtotal2= $data['jantotal2'] + $data['febtotal2'] + $data['martotal2'] + $data['aprtotal2'] + $data['maytotal2'] + $data['juntotal2'] + $data['jultotal2'] + $data['augtotal2'] + $data['septotal2'] + $data['octtotal2'] + $data['novtotal2'] + $data['dectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['monthtotal2actual'] =$monthtotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'] + $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'] + $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'] + $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['ejantotal'] =$ejantotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal'] =$efebtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal'] =$emartotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal'] =$eaprtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal'] =$emaytotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal'] =$ejuntotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal'] =$ejultotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal'] =$eaugtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal'] =$eseptotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal'] =$eocttotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal'] =$enovtotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal'] =$edectotal= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal'] =$emonthtotal= $data['ejantotal'] + $data['efebtotal'] + $data['emartotal'] + $data['eaprtotal'] + $data['emaytotal'] + $data['ejuntotal'] + $data['ejultotal'] + $data['eaugtotal'] + $data['eseptotal'] + $data['eocttotal'] + $data['enovtotal'] + $data['edectotal'];
        $data['ejangrosstotal2'] =$ejangrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jan');
        $data['efebgrosstotal2'] =$efebgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('feb');
        $data['emargrosstotal2'] =$emargrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('mar');
        $data['eaprgrosstotal2'] =$eaprgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('apr');
        $data['emaygrosstotal2'] =$emaygrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('may');
        $data['ejungrosstotal2'] =$ejungrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jun');
        $data['ejulgrosstotal2'] =$ejulgrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('jul');
        $data['eauggrosstotal2'] =$eauggrosstotal2= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aug');
        $data['esepgrosstotal2']=$esepgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('sep');
        $data['eoctgrosstotal2']=$eoctgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('oct');
        $data['enovgrosstotal2']=$enovgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('nov');
        $data['edecgrosstotal2']=$edecgrosstotal2 = DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('decem');
        $data['emonthgrosstotal2']=$emonthgrosstotal2 = $data['ejangrosstotal2'] + $data['efebgrosstotal2'] + $data['emargrosstotal2'] + $data['eaprgrosstotal2'] + $data['emaygrosstotal2'] + $data['ejungrosstotal2'] + $data['ejulgrosstotal2'] + $data['eauggrosstotal2'] + $data['esepgrosstotal2'] + $data['eoctgrosstotal2'] + $data['enovgrosstotal2'] + $data['edecgrosstotal2'];
        $data['ejangrossactual']=$ejangrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['efebgrossactual']=$efebgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emargrossactual']=$emargrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eaprgrossactual']=$eaprgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emaygrossactual']=$emaygrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejungrossactual']=$ejungrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['ejulgrossactual']=$ejulgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eauggrossactual']=$eauggrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['esepgrossactual']=$esepgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['eoctgrossactual']=$eoctgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['enovgrossactual']=$enovgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['edecgrossactual']=$edecgrossactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', '!=', 'Other Revenue')->sum('bill');
        $data['emonthgrossactual']=$emonthgrossactual = $data['ejangrossactual'] + $data['efebgrossactual'] + $data['emargrossactual'] + $data['eaprgrossactual'] + $data['emaygrossactual'] + $data['ejungrossactual'] + $data['ejulgrossactual'] + $data['eauggrossactual'] + $data['esepgrossactual'] + $data['eoctgrossactual'] + $data['enovgrossactual'] + $data['edecgrossactual'];
        $data['ejantotalactual']=$ejantotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('bill');
        $data['efebtotalactual']=$efebtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('bill');
        $data['emartotalactual']=$emartotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('bill');
        $data['eaprtotalactual']=$eaprtotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('bill');
        $data['emaytotalactual']=$emaytotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('bill');
        $data['ejuntotalactual']=$ejuntotalactual = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('bill');
        $data['ejultotalactual'] =$ejultotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('bill');
        $data['eaugtotalactual'] =$eaugtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('bill');
        $data['eseptotalactual'] =$eseptotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('bill');
        $data['eocttotalactual'] =$eocttotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('bill');
        $data['enovtotalactual'] =$enovtotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('bill');
        $data['edectotalactual'] =$edectotalactual= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('bill');
        $data['emonthtotalactual'] =$emonthtotalactual= $data['ejantotalactual'] + $data['efebtotalactual'] + $data['emartotalactual'] + $data['eaprtotalactual'] + $data['emaytotalactual'] + $data['ejuntotalactual'] + $data['ejultotalactual'] + $data['eaugtotalactual'] + $data['eseptotalactual'] + $data['eocttotalactual'] + $data['enovtotalactual'] + $data['edectotalactual'];
        $data['ejanothrevenue'] =$ejanothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jan');
        $data['efebothrevenue'] =$efebothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('feb');
        $data['emarothrevenue'] =$emarothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('mar');
        $data['eaprothrevenue'] =$eaprothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('apr');
        $data['emayothrevenue'] =$emayothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('may');
        $data['ejunothrevenue'] =$ejunothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jun');
        $data['ejulothrevenue'] =$ejulothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('jul');
        $data['eaugothrevenue'] =$eaugothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aug');
        $data['esepothrevenue'] =$esepothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('sep');
        $data['eoctothrevenue'] =$eoctothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('oct');
        $data['enovothrevenue'] =$enovothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('nov');
        $data['edecothrevenue'] =$edecothrevenue= DB::table('revenue_projection')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('decem');
        $data['emonthothrevenue'] =$emonthothrevenue= $data['ejanothrevenue'] + $data['efebothrevenue'] + $data['emarothrevenue'] + $data['eaprothrevenue'] + $data['emayothrevenue'] + $data['ejunothrevenue'] + $data['ejulothrevenue'] + $data['eaugothrevenue'] + $data['esepothrevenue'] + $data['eoctothrevenue'] + $data['enovothrevenue'] + $data['edecothrevenue'];
        $data['ejanotherrevenue'] =$ejanotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->where('account_description', 'Other Revenue')->sum('bill');
        $data['efebotherrevenue'] =$efebotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emarotherrevenue'] =$emarotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaprotherrevenue'] =$eaprotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emayotherrevenue'] =$emayotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejunotherrevenue'] =$ejunotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->where('account_description', 'Other Revenue')->sum('bill');
        $data['ejulotherrevenue'] =$ejulotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eaugotherrevenue'] =$eaugotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->where('account_description', 'Other Revenue')->sum('bill');
        $data['esepotherrevenue'] =$esepotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->where('account_description', 'Other Revenue')->sum('bill');
        $data['eoctotherrevenue'] =$eoctotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->where('account_description', 'Other Revenue')->sum('bill');
        $data['enovotherrevenue'] =$enovotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->where('account_description', 'Other Revenue')->sum('bill');
        $data['edecotherrevenue'] =$edecotherrevenue= DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->where('account_description', 'Other Revenue')->sum('bill');
        $data['emonthotherrevenue'] =$emonthotherrevenue= $data['ejanotherrevenue'] + $data['efebotherrevenue'] + $data['emarotherrevenue'] + $data['eaprotherrevenue'] + $data['emayotherrevenue'] + $data['ejunotherrevenue'] + $data['ejulotherrevenue'] + $data['eaugotherrevenue'] + $data['esepotherrevenue'] + $data['eoctotherrevenue'] + $data['enovotherrevenue'] + $data['edecotherrevenue'];
        $data['eexpense'] =$eexpense= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['ejantotal2'] =$ejantotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jan');
        $data['efebtotal2'] =$efebtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('feb');
        $data['emartotal2'] =$emartotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('mar');
        $data['eaprtotal2'] =$eaprtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('apr');
        $data['emaytotal2'] =$emaytotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('may');
        $data['ejuntotal2'] =$ejuntotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jun');
        $data['ejultotal2'] =$ejultotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('jul');
        $data['eaugtotal2'] =$eaugtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('aug');
        $data['eseptotal2'] =$eseptotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('sep');
        $data['eocttotal2'] =$eocttotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('oct');
        $data['enovtotal2'] =$enovtotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('nov');
        $data['edectotal2'] =$edectotal2= DB::table('expense_projection')->where('uid', $uid)->whereYear('created_at', $year)->sum('decem');
        $data['emonthtotal2'] =$emonthtotal2= $data['ejantotal2'] + $data['efebtotal2'] + $data['emartotal2'] + $data['eaprtotal2'] + $data['emaytotal2'] + $data['ejuntotal2'] + $data['ejultotal2'] + $data['eaugtotal2'] + $data['eseptotal2'] + $data['eocttotal2'] + $data['enovtotal2'] + $data['edectotal2'];
        $data['ejantotal2actual'] =$ejantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['efebtotal2actual'] =$efebtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['emartotal2actual'] =$emartotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['eaprtotal2actual'] =$eaprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['emaytotal2actual'] =$emaytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['ejuntotal2actual'] =$ejuntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['ejultotal2actual'] =$ejultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['eaugtotal2actual'] =$eaugtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['eseptotal2actual'] =$eseptotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['eocttotal2actual'] =$eocttotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['enovtotal2actual'] =$enovtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['edectotal2actual'] =$edectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['emonthtotal2actual'] =$emonthtotal2actual= $data['ejantotal2actual'] + $data['efebtotal2actual'] + $data['emartotal2actual'] + $data['eaprtotal2actual'] + $data['emaytotal2actual'] + $data['ejuntotal2actual'] + $data['ejultotal2actual'] + $data['eaugtotal2actual'] + $data['eseptotal2actual'] + $data['eocttotal2actual'] + $data['enovtotal2actual'] + $data['edectotal2actual'];
        $data['janmartotal'] =$janmartotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal'] =$aprjuntotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal'] =$julseptotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal'] =$octdectotal= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal'] =$monthtotal= $data['janmartotal'] + $data['aprjuntotal'] + $data['julseptotal'] + $data['octdectotal'];
        $data['janmargrosstotal2'] =$janmargrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('janmar');
        $data['aprjungrosstotal2'] =$aprjungrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('aprjun');
        $data['julsepgrosstotal2'] =$julsepgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('julsep');
        $data['octdecgrosstotal2'] =$octdecgrosstotal2= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '!=', 'Other Revenue')->sum('octdec');
        $data['monthgrosstotal2'] =$monthgrosstotal2= $data['janmargrosstotal2'] + $data['aprjungrosstotal2'] + $data['julsepgrosstotal2'] + $data['octdecgrosstotal2'];
         $data['janmargrossactual'] =$janmargrossactual= $data['jangrossactual'] + $data['febgrossactual'] + $data['margrossactual'];
        $data['aprjungrossactual'] =$aprjungrossactual= $data['aprgrossactual'] + $data['maygrossactual'] + $data['jungrossactual'];
        $data['julsepgrossactual'] =$julsepgrossactual= $data['julgrossactual'] + $data['auggrossactual'] + $data['sepgrossactual'];
        $data['octdecgrossactual'] =$octdecgrossactual= $data['octgrossactual'] + $data['novgrossactual'] + $data['decgrossactual'];
        $data['monthgrossactual'] =$monthgrossactual= $data['janmargrossactual'] + $data['aprjungrossactual'] + $data['julsepgrossactual'] + $data['octdecgrossactual'];
        $data['janmarothrevenue'] =$janmarothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('janmar');
        $data['aprjunothrevenue'] =$aprjunothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('aprjun');
        $data['julsepothrevenue'] =$julsepothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('julsep');
        $data['octdecothrevenue'] =$octdecothrevenue= DB::table('revenue_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->where('name', '==', 'Other Revenue')->sum('octdec');
        $data['monthothrevenue'] =$monthothrevenue= $data['janmarothrevenue'] + $data['aprjunothrevenue'] + $data['julsepothrevenue'] + $data['octdecothrevenue'];
        $data['janmarotherrevenue'] =$janmarotherrevenue= $data['janotherrevenue'] + $data['febotherrevenue'] + $data['marotherrevenue'];
        $data['aprjunotherrevenue'] =$aprjunotherrevenue= $data['aprotherrevenue'] + $data['mayotherrevenue'] + $data['junotherrevenue'];
        $data['julsepotherrevenue'] =$julsepotherrevenue= $data['julotherrevenue'] + $data['augotherrevenue'] + $data['sepotherrevenue'];
        $data['octdecotherrevenue'] =$octdecotherrevenue= $data['octotherrevenue'] + $data['novotherrevenue'] + $data['decotherrevenue'];
        $data['monthotherrevenue'] =$monthotherrevenue= $data['janmarotherrevenue'] + $data['aprjunotherrevenue'] + $data['julsepotherrevenue'] + $data['octdecotherrevenue'];
        $data['janmartotalactual'] =$janmartotalactual= $data['jantotalactual'] + $data['febtotalactual'] + $data['martotalactual'];
        $data['aprjuntotalactual'] =$aprjuntotalactual= $data['aprtotalactual'] + $data['maytotalactual'] + $data['juntotalactual'];
        $data['julseptotalactual'] =$julseptotalactual= $data['jultotalactual'] + $data['augtotalactual'] + $data['septotalactual'];
        $data['octdectotalactual'] =$octdectotalactual= $data['octtotalactual'] + $data['novtotalactual'] + $data['dectotalactual'];
        $data['monthtotalactual'] =$monthtotalactual= $data['janmartotalactual'] + $data['aprjuntotalactual'] + $data['julseptotalactual'] + $data['octdectotalactual'];
        $data['expensess'] =$expensess= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->get();
        $data['janmartotal2'] =$janmartotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('janmar');
        $data['aprjuntotal2'] =$aprjuntotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('aprjun');
        $data['julseptotal2'] =$julseptotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('julsep');
        $data['octdectotal2'] =$octdectotal2= DB::table('expense_quaterly_budget')->where('uid', $uid)->whereYear('created_at', $year)->sum('octdec');
        $data['monthtotal2'] =$monthtotal2= $data['janmartotal2'] + $data['aprjuntotal2'] + $data['julseptotal2'] + $data['octdectotal2'];
        $data['jantotal2actual'] =$jantotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '01')->sum('amount_paid');
        $data['febtotal2actual'] =$febtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '02')->sum('amount_paid');
        $data['martotal2actual'] =$martotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '03')->sum('amount_paid');
        $data['aprtotal2actual'] =$aprtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '04')->sum('amount_paid');
        $data['maytotal2actual'] =$maytotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '05')->sum('amount_paid');
        $data['juntotal2actual'] =$juntotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '06')->sum('amount_paid');
        $data['jultotal2actual'] =$jultotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '07')->sum('amount_paid');
        $data['augtotal2actual'] =$augtotal2actual= DB::table('expense_record')->where('uid',$uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '08')->sum('amount_paid');
        $data['septotal2actual'] =$septotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '09')->sum('amount_paid');
        $data['octtotal2actual'] =$octtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '10')->sum('amount_paid');
        $data['novtotal2actual'] =$novtotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '11')->sum('amount_paid');
        $data['dectotal2actual'] =$dectotal2actual= DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->whereMonth('transaction_date', '12')->sum('amount_paid');
        $data['janmartotal2actual'] =$janmartotal2actual= $data['jantotal2actual'] + $data['febtotal2actual'] + $data['martotal2actual'];
        $data['aprjuntotal2actual'] =$aprjuntotal2actual= $data['aprtotal2actual'] + $data['maytotal2actual'] + $data['juntotal2actual'];
        $data['julseptotal2actual'] =$julseptotal2actual= $data['jultotal2actual'] + $data['augtotal2actual'] + $data['septotal2actual'];
        $data['octdectotal2actual'] =$octdectotal2actual= $data['octtotal2actual'] + $data['novtotal2actual'] + $data['dectotal2actual'];
        $data['monthtotal2actual'] =$monthtotal2actual= $data['janmartotal2actual'] + $data['aprjuntotal2actual'] + $data['julseptotal2actual'] + $data['octdectotal2actual'];
        $data['assets'] =$assets= DB::table('asset_record')->where('uid', $uid)->whereYear('created_at', $year)->groupBy('description')->orderBy('id', 'desc')->get();
        $data['chat'] =$chat= "";
        $data['tools'] =$tools= "";
         $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
       $data['expense_account']=$expense_account = DB::table('expense_record')->where('account_description','!=','Sales Tax Paid')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_start();
        ?>
        <div id="" class="table-scroll">
                              <div class="table-wrap">
                                 <table class="table table-striped table-bordered table-hover main-table" id="">
                                    <thead>
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
                                          <td class="fixed-side">Gross Revenue</td>
                                          <?php if($janmargrossactual != 0){ ?>
                                          <td><a class="actual_quarter_revenue" id="01qrevactual"><?= $janmargrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $janmargrossactual ?></td>
                                          <?php } ?>
                                          <?php if($aprjungrossactual != 0){ ?>
                                          <td><a class="actual_quarter_revenue" id="04qrevactual"><?= $aprjungrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $aprjungrossactual ?></td>
                                          <?php } ?>
                                          <?php if($julsepgrossactual != 0){ ?>
                                          <td><a class="actual_quarter_revenue" id="07qrevactual"><?= $julsepgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $julsepgrossactual ?></td>
                                          <?php } ?>
                                          <?php if($octdecgrossactual != 0){ ?>
                                          <td><a class="actual_quarter_revenue" id="10qrevactual"><?= $octdecgrossactual ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $octdecgrossactual ?></td>
                                          <?php } ?>
                                          <td><?= $monthgrossactual ?></td>
                                          <td>
                                             <a href="<?= url('gross_quarter_revenue_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr class="odd gradeX">
                                          <td class="fixed-side">Other Revenue</td>
                                          <?php if($janmarotherrevenue != 0){ ?>
                                          <td><a class="quarteractual_other_revenue" id="01qotheractual"><?= $janmarotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $janmarotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($aprjunotherrevenue != 0){ ?>
                                          <td><a class="quarteractual_other_revenue" id="04qotheractual"><?= $aprjunotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $aprjunotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($julsepotherrevenue != 0){ ?>
                                          <td><a class="quarteractual_other_revenue" id="07qotheractual"><?= $julsepotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $julsepotherrevenue ?></td>
                                          <?php } ?>
                                          <?php if($octdecotherrevenue != 0){ ?>
                                          <td><a class="quarteractual_other_revenue" id="10qotheractual"><?= $octdecotherrevenue ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $octdecotherrevenue ?></td>
                                          <?php } ?>
                                          <td><?= $monthotherrevenue ?></td>
                                          <td>
                                             <a href="<?=url('other_quarter_revenue_chart') ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr class="total-tr">
                                          <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                          <td><?= $janmartotalactual ?></td>
                                          <td><?= $aprjuntotalactual ?></td>
                                          <td><?= $julseptotalactual ?></td>
                                          <td><?= $octdectotalactual ?></td>
                                          <td><?= $monthtotalactual ?></td>
                                          <td>
                                             <a href="{{ url('all_quarter_revenue_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                       <tr>
                                          <td class="fixed-side" style="text-align: left; color: #da291c;"><b>Expenses</b></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                       </tr>
                                       <?php 
                                          foreach($expensess as $value){
                                          ?>
                                       <tr class="odd gradeX">
                                          <td class="fixed-side"><?= $value->name ?></td>
                                          <?php
                                             $actual_janmar = HomeController::getjanmaractualexp($value->name);
                                             if($actual_janmar!= 0){ ?>
                                          <td><a class="actual_quarterly_expense" id="01qactualexpense<?= $value->name ?>"><?= $actual_janmar ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_janmar ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_aprjun = HomeController::getaprjunactualexp($value->name);
                                             if($actual_aprjun!= 0){ ?>
                                          <td><a class="actual_quarterly_expense" id="04qactualexpense<?= $value->name ?>"><?= $actual_aprjun ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_aprjun ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_julsep = HomeController::getjulsepactualexp($value->name);
                                             if($actual_julsep!= 0){ ?>
                                          <td><a class="actual_quarterly_expense" id="07qactualexpense<?= $value->name ?>"><?= $actual_julsep ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_julsep ?></td>
                                          <?php } ?>
                                          <?php
                                             $actual_octdec = HomeController::getoctdecactualexp($value->name);
                                             if($actual_octdec!= 0){ ?>
                                          <td><a class="actual_quarterly_expense" id="10qactualexpense<?= $value->name ?>"><?= $actual_octdec ?></a></td>
                                          <?php }else{ ?>
                                          <td><?= $actual_octdec ?></td>
                                          <?php } ?>
                                          <td><?php echo $actual_total2 = HomeController::gettotalactualexp($value->name); ?></td>
                                          <td>
                                             <a href="<?= url('expense_variance_quarterly_graph')."/".$value->name ?>"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                       <?php } ?>
                                       <tr class="total2-tr">
                                          <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                          <td><?= $janmartotal2actual ?></td>
                                          <td><?= $aprjuntotal2actual ?></td>
                                          <td><?= $julseptotal2actual ?></td>
                                          <td><?= $octdectotal2actual ?></td>
                                          <td><?= $tott2 = ($janmartotal2actual + $aprjuntotal2actual + $julseptotal2actual + $octdectotal2actual) ?></td>
                                          <td>
                                             <a href="{{ url('expense_quarterly_vary_chart') }}"><i class="fa fa-bar-chart"></i></a>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tbody></tbody>
                                    <tfoot>
                                       <tr>
                                          <td class="fixed-side" style="text-align: left;"><b>Estimated Profit & Loss</b></td>
                                          <td><?= ($janmartotalactual-$janmartotal2actual) ?></td>
                                          <td><?= ($aprjuntotalactual-$aprjuntotal2actual) ?></td>
                                          <td><?= ($julseptotalactual-$julseptotal2actual) ?></td>
                                          <td><?= ($octdectotalactual-$octdectotal2actual) ?></td>
                                          <td><?= ($monthtotalactual-$tott2) ?></td>
                                          <td>
                                             <!-- <a href="#"><i class="fa fa-bar-chart"></i></a> -->
                                          </td>
                                       </tr>
                                       <!-- .nk-tb-item  -->
                                    </tfoot>
                                 </table>
                              </div>
        <?php
        $html=ob_get_clean();
        echo $html;



  }

  public function revenue_report_monthly(Request $request){
    $year=$request->year;
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat'] =$chat= "on";
            }
            else{
                $data['chat'] =$chat= "off";
            }
            if($cdet->tools == "on"){
                $data['tools'] =$tools= "on";
            }
            else{
                $data['tools'] =$tools= "off";
            }
        }
        ob_start();
        ?>
         <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Revenue Name</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr as $valuee) {
                                                        $count = MainController::get_month_count_revenue($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';
                                                       
                                                        if($count > 0){
                                                            echo '<td><a class="revenue_month" id="'.$valuee.'revenue_month'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                            <?php
                                            $tot2 = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $count2 = MainController::get_month_totall_revenue($valuee);

                                                    $tot2 += $count2;

                                                    echo '<td>'.$count2.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot2 ?></td>
                                        </tr>                                    
                                    </tfoot>
                                </table>
                                <?php
        $html=ob_get_clean();
        echo $html;
    }

    public function revenue_report_quaterly(Request $request){
    $year=$request->year;
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat'] =$chat= "on";
            }
            else{
                $data['chat'] =$chat= "off";
            }
            if($cdet->tools == "on"){
                $data['tools'] =$tools= "on";
            }
            else{
                $data['tools'] =$tools= "off";
            }
        }
        ob_start();
        ?>
        <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Revenue Name</th>
                                            <th>Jan-Mar</th>
                                            <th>Apr-Jun</th>
                                            <th>Jul-Sep</th>
                                            <th>Oct-Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr2 = ['01','04','07','10']; 
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr2 as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_quarter_count_revenue($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';
                                                       
                                                        if($count > 0){
                                                            echo '<td><a class="revenue_quarter" id="'.$valuee.'revenue_quarter'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                            <?php
                                            $tot3 = 0;
                                                foreach ($months_arr2 as $valuee) {
                                                    $count3 = \App\Http\Controllers\MainController::get_quarter_totall_revenue($valuee);

                                                    $tot3 += $count3;
                                                    echo '<td>'.$count3.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot3 ?></td>
                                        </tr>                                    
                                    </tfoot>
                                </table>
        <?php
        $html=ob_get_clean();
        echo $html; 
    }
    public function expenses_report_monthly()
    {
        if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        // $data['revenue'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['revenue']=$revenue = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_start();
        ?>
 <table class="table table-striped table-bordered table-hover fw2">
                                    <thead>
                                        <tr>
                                            <th>Revenue Name</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_month_count_revenue($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';
                                                       
                                                        if($count > 0){
                                                            echo '<td><a class="revenue_month" id="'.$valuee.'revenue_month'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Revenue</b></td>
                                            <?php
                                            $tot2 = 0;
                                                foreach ($months_arr as $valuee) {
                                                    $count2 = \App\Http\Controllers\MainController::get_month_totall_revenue($valuee);

                                                    $tot2 += $count2;

                                                    echo '<td>'.$count2.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot2 ?></td>
                                        </tr>                                    
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div id="monthly_details"></div>
                                    </div>
                                </div>
        <?php
        $html=ob_get_clean();
        echo $html;
  }


  public function expenses_report_quaterly()
    {
        if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        // $data['revenue'] = DB::table('expense_budget')->where('uid', $uid)->whereYear('created_at', date('Y'))->orderBy('id', 'desc')->get();
        $data['revenue']=$revenue = DB::table('expense_record')->where('uid', $uid)->whereYear('transaction_date', $year)->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_start();
        ?>
        <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Expenses Name</th>
                                            <th>Jan-Mar</th>
                                            <th>Apr-Jun</th>
                                            <th>Jul-Sep</th>
                                            <th>Oct-Dec</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $months_arr2 = ['01','04','07','10']; 
                                            foreach($revenue as $value){
                                        ?>
                                            <tr class="odd gradeX">
                                                <td class="fixed-side"><?= $value->account_description ?></td>
                                                <?php
                                                $tot = 0;
                                                    foreach ($months_arr2 as $valuee) {
                                                        $count = \App\Http\Controllers\MainController::get_quarter_count_expense($valuee, $value->account_description);

                                                        $tot += $count;

                                                        // echo '<td>'.$count.'</td>';
                                                       
                                                        if($count > 0){
                                                            echo '<td><a class="revenue_quarter" id="'.$valuee.'revenue_quarter'.$value->account_description.'">'.$count.'</a></td>';
                                                        }
                                                        else{
                                                            echo '<td>'.$count.'</td>';
                                                        }
                                                    }
                                                 ?>
                                                <td><?= $tot ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="fixed-side" style=""><b>Total Expenses</b></td>
                                            <?php
                                            $tot3 = 0;
                                                foreach ($months_arr2 as $valuee) {
                                                    $count3 = \App\Http\Controllers\MainController::get_quarter_totall_expense($valuee);

                                                    $tot3 += $count3;
                                                    echo '<td>'.$count3.'</td>';
                                                }
                                             ?>
                                            <td><?= $tot3 ?></td>
                                        </tr>                                    
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-12" style="margin-top: 10px;">
                                        <div id="monthly_details2"></div>
                                    </div>
                                </div>
        <?php
        $html=ob_get_clean();
        echo $html;
  }
  public function balancesheet_report_yearly(Request $request){
    $year=$request->year;
    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['client']=$client = DB::table('client_appointment_lists')->where('uid', $uid)->whereYear('created_at',$year)->orderBy('id', 'desc')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
    ob_start();
    ?>
    <table class="table table-striped table-bordered table-hover" id="datatable_sample">
        <thead>
            <tr>
                <th>Client Name</th>
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
            </tr>
        </thead>
        <tbody>
            <?php
                $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                foreach($client as $value){
            ?>
                <tr class="odd gradeX">
                    <td class="fixed-side"><?= $value->first_name ?> <?= $value->last_name ?></td>
                    <?php
                    $tot = 0;
                        foreach ($months_arr as $valuee) {
                            $balance = \App\Http\Controllers\HomeController::get_month_balance($valuee, $value->email);

                            $tot += $balance;

                            echo '<td>'.$balance.'</td>';
                        }
                     ?>
                    <td><?= $tot ?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <?php
    $html=ob_get_clean();
    echo $html;
  }

  public function paymentbalance_report_monthly(Request $request){

    $year=$request->year;

    if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");
        }
        if(Auth::user()->role == "admin"){
                return redirect('/')->with('status',"Admin can't access this page.");
            }
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $data['status']=$status = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links']=$links = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos']=$top_videos = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $aaid = "";
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner']=$aabanner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['top_banners']=$top_banners = FinancialManagementBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime']=$slidetime = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['client']=$client = DB::table('client_appointment_lists')->where('uid', $uid)->orderBy('id', 'desc')->get();
        $data['revenue']=$revenue = DB::table('revenue_record')->where('uid', $uid)->whereNotIn('account_description',['Sales Tax Collected','Shipping Collected'])->whereYear('transaction_date', $year)->whereMonth('transaction_date', date('m'))->orderBy('transaction_date', 'desc')->groupBy('account_description')->get();
         $data['category']=$category = CardCategory::orderBy('category','desc')->get();
        $data['cards']=$cards = UploadCard::groupBy('category')->get();
        $data['chat']=$chat = "";
        $data['tools']=$tools = "";
        if(Auth::user()->role == "affiliate_user"){
            $cdet = DB::table('user_menu_access2')->where('uemail', Auth::user()->email)->first();
            if($cdet->chat == "on"){
                $data['chat']=$chat = "on";
            }
            else{
                $data['chat']=$chat = "off";
            }
            if($cdet->tools == "on"){
                $data['tools']=$tools = "on";
            }
            else{
                $data['tools']=$tools = "off";
            }
        }
        ob_clean();
        ?>
        <table class="table table-striped table-bordered table-hover">
                           <thead>
                              <tr>
                                 <?php
                                    $months_arr = ['01','02','03','04','05','06','07','08','09','10','11','12']; 
                                    $cmonth=date('m');
                                    ?>
                                 @foreach ($months_arr as $valuee) 
                                 <th id="month_record" data-id="<?= $valuee ?>" @if($cmonth == $valuee) class="active1" @endif><?= date("M", mktime(0, 0, 0, $valuee, 10)) ?></th>
                                 @endforeach
                              </tr>
                           </thead>
                        </table>
                        <table class="table table-striped table-bordered table-hover" id="sample_editable_1">
                           <thead>
                              <?php
                                 $bill_amount1=0;
                                 $tax_amount1=0;
                                 $shipping_amount1=0;
                                 $total_amount1=0;
                                 $paid_amount1=0;
                                 $balance_amount1=0;
                                 
                                 foreach($client as $value){
                                 
                                 
                                 $month=date('m');
                                 $bill_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'bill');
                                 $tax_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'tax');
                                 $shipping_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'shipping');
                                 $total_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'total');
                                 $paid_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'amount_paid');
                                 $balance_amount1 +=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'balance');
                                 }
                                 $balance_amount1= str_replace('-',' ', $balance_amount1);
                                 ?>
                              <tr class="bg-purple" id=
                                 "revenue_header">
                                 <th colspan="2">Total</th>
                                 <th><?=$bill_amount1 ?></th>
                                 <th><?=$tax_amount1 ?></th>
                                 <th><?=$shipping_amount1 ?></th>
                                 <th><?=$total_amount1 ?></th>
                                 <th><?=$paid_amount1 ?></th>
                                 <th><?=$balance_amount1 ?></th>
                              </tr>
                              <tr>
                                 <th class="table-checkbox">
                                    <input type="checkbox" class="group-checkable" data-set="#datatable_sample checkboxes" />
                                 </th>
                                 <th>Client Name</th>
                                 <th>Charged/Bill</th>
                                 <th>Tax</th>
                                 <th>Shipping</th>
                                 <th>Total</th>
                                 <th>Amount Paid</th>
                                 <th>Balance</th>
                              </tr>
                           </thead>
                           <tbody id="revenue_records">
                              <?php
                                 foreach($client as $value){
                                 
                                 
                                 $month=date('m');
                                 $bill_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'bill');
                                 $tax_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'tax');
                                 $shipping_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'shipping');
                                 $total_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'total');
                                 $paid_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'amount_paid');
                                 $balance_amount=\App\Http\Controllers\MainController::get_revenue_by_col($value->email,$month,'balance');
                                         
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
                                 }
                                 ?>
                           </tbody>
                        </table>
                        <div class="row">
                           <div class="col-md-12" style="margin-top: 10px;">
                              <div id="monthly_details"></div>
                           </div>
                        </div>

        <?php
        $html=ob_get_clean();
        echo $html;

  }

  

}
