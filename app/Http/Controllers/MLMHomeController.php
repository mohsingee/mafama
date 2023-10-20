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
use App\Setting;
use App\Balance_info;
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
use App\Network;
use App\LevelEarning;
use App\Mlm_transaction;
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

use App\Plan;
use App\LogActivity;
use App\AccessMonitoring;
use App\DailyAccessMonitoring;
use App\Bonus_condition;
use App\BonusPoolPrice;
use App\Bonus_income;
use App\BonusReward;
use App\OtherReward;
use App\PrizeReward;
use App\Prize_condition;
use App\VideoTrainingRecord;
use App\BasketRotationSetting;
use App\ActivePlan;
use App\OtherCondition;
use App\PromotionCondition;
use Charts;
use App\Http\Requests;
use Validator;
use URL;
use Redirect;
use Input;
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

class MLMHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_api_context;
    public function __construct()
    {
         $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
        if(Auth::id() == NULL){
            return redirect('login');
        }
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        // $this->middleware('auth');
     }
// ramkishor script
    public function back_office()
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
         $data['networks']=Network::get_my_network(Auth::user()->id);
         $data['transactions']=Mlm_transaction::get_usercommission_list();
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


        return view('back_office_page')->with($data);
    }
   public  function affiliate_profile_view($username)
   {
             if(!empty($username))
             {
             $data['user'] = DB::table('affiliate_registrations')->where('username',$username)->first();
             if(!empty($data['user']))
             {
               $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
                $data['links'] = Menulinks::get();
                $now = date('Y-m-d');
                $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
                $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
                $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
                $data['religion'] = Religion::get();
                $data['business_category'] = BusinessCategory::find($data['user']->business_category)->category;
                $data['lead_category'] = LeadsCategory::find($data['user']->lead_category)->category;
                $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $data['user']->email)->get();
                $data['my_referral_link']=User::my_referral_link($data['user']->email);
                $data['my_profile_link']=url('user/'.$username);
               //print_r( $data['user']->code );die;
               return view('profile_view')->with($data);
               }else{
                   return  redirect('/');
               }
             }else{
                return  redirect('/');
             }
 }
 public function verify_country_code(Request $req){
    //  print_r($req->all());
     if(isset($req->code)){
          $check_country=DB::table('country_status_setting')->where('country',$req->code)->first();
            if(empty($check_country)){
                $admin_message=DB::table('option_meta')->where('key','country_of_residense_admin_message')->first();

                 return response()->json(array('status'=> 2,'msg'=>$admin_message->value), 200);
            }else{
                return response()->json(array('status'=> 1), 200);
            }
     }
 }
public function affiliate_registration($user_id="",$code="")
    {
       $status=DB::table('affiliatebtn')->where('id', 1)->get();
       $status[0]->affiliatedisplay;
       $data['affiliate_reg_status']=$status[0]->affiliatedisplay;
        if(Auth::check())
        {
            return  redirect('/');
        }
        //elseif($status[0]->affiliatedisplay == "off"){

           // return  redirect('/');
        //}
        else{
        $communes = Comune::orderBy('commune', 'asc')->get();
        // $communes = Comune::get();
        // dd($communes);
        $data['communes'] = $communes;
        $data["user_id"]=isset($user_id)?base64_decode($user_id):'';
        $data["code"]=isset($code)?base64_decode($code):'';
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['terms'] = DB::table('register_terms')->find(1)->terms;
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $data['lead_cats'] = LeadsCategory::orderBy('category','asc')->get();
        return view('affiliate_registration')->with($data);
        }
    }
     public function adaffiliate_entry(Request $request)
    {
        // print_r($request->all());
         
            if(!empty($request->country))
        {
            $check_country=DB::table('country_status_setting')->where('country',$request->country)->first();
            if(empty($check_country)){
                 $admin_message=DB::table('option_meta')->where('key','country_of_residense_admin_message')->first();
                 return redirect('/business_registration/')->with('status',$admin_message->value);
            }
         
        }else{
             return redirect()->back()->with('status',"Country of residence is empty.");
        }
        $fileNameToStore="";
        $email=$request->email;
        $u1=User::where(['email'=>$email])->count();
        $u2=AffiliateRegistration::where(['email'=>$email])->count();
        $this->validate($request, [
           // 'password'     => 'required|min:5',
            'confirm_password' => 'required|same:password',
            ]);
        if(empty($request->terms)) {
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
        if(!empty($request->code))
        {
           $sponsor_id=$request->sponsor_id;
           $affiliate_code=$request->code;
           $code = Levels::where('code_name', $affiliate_code)->get();
           if(count($code) > 0){
            $now = date('Y-m-d H:i A');
            $vstart_date=$code[0]->vstart_date.' '.$code[0]->vstart_time;
            $vstart_date=date('Y-m-d H:i A',strtotime($vstart_date));
            $vend_date=$code[0]->vend_date.' '.$code[0]->vend_time;
            $vend_date=date('Y-m-d H:i A',strtotime($vend_date));
            if ($now >= $vstart_date && $now <= $vend_date)
             {
            return    $this->add_affiliate_entry($request->all(),$fileNameToStore,$sponsor_id,$affiliate_code);
             }else{
                 if($now < $vstart_date){
                    return redirect()->back()->with('status',"Validation start date for this code is ".$vstart_date);
                }
                else{
                    return redirect()->back()->with('status',"The code has expired.");
                }
             }
            }else{
             return redirect()->back()->with('status',"The code doesn't match.");
                exit;
            }
        }else{
           $sponsor_id= '';//Setting::get_admin_email();
           $affiliate_code='';//DB::table('levels')->orderBy('id','asc')->first()->code_name;
           return $this->add_affiliate_entry($request->all(),$fileNameToStore,$sponsor_id,$affiliate_code);
        }
      }
    }
public function add_affiliate_entry($request,$fileNameToStore,$sponsor_id,$affiliate_code)
{
  // print_r($request);die;
            $AffiliateRegistration      = TempAffiliateRegistration::create([
                'code'                  => $affiliate_code,
                'joining_date'          => $request['joining_date'],
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
                //26-12-2022 changes by ravi for testing.
                //'department'            => $request['selectdepartment'],
                //'arrondissement'        => $request['selectarr'],
                //'birth_address'               => $request['birth_address'],
                //'birth_zip_code'              => $request['birth_zip_code'],
               // 'birth_city'                  => $request['birth_city'],
                'birth_state'                 => $request['birth_state'],
                'birth_country'               => $request['birth_country'],
                'birth_commune'               => $request['birth_commune'],
                //'birth_department'            => $request['birth_selectdepartment'],
               // 'birth_arrondissement'        => $request['birth_selectarr'],
               
               //26-12-2022 changes end by ravi for testing.
               
                // 'billing_address'       => $request['billing_address']?:'',
                // 'billing_zip_code'      => $request['billing_zip_code']?:'',
                // 'billing_city'          => $request['billing_city']?:'',
                // 'billing_state'         => $request['billing_state']?:'',
                // 'billing_country'       => $request['billing_country']?:'',
                'sponsor_id'            => $sponsor_id,
                'image'                 => $fileNameToStore,
                'company'               => $request['company'],
                'dob'                   => $request['dob'],
            ]);
        if($AffiliateRegistration)
         {
            $last_id=$AffiliateRegistration->id;
            session()->put('user_id',$last_id);
            Session::flash('success', "Inserted successfully");
            return redirect('/affiliate-preview/'.$last_id);
        }
        else {
            return redirect()->back()->with('status',"Something went wrong!!!");
        }
}
public function add_affiliate_final_data($user_id)
{
         $request=TempAffiliateRegistration::where('id',$user_id)->first();
         $code=$request->code;
         if(!empty($request->sponsor_id))
         {
            $sponsor_id=User::where('email',$request->sponsor_id)->first()->id;
            if(!empty($request->code))
             {
               $level=AffiliateRegistration::get_user_level($request->code);
             }
             $role=session('role') ?? "affiliate";

         }
         else
         {
           $sponsor_id='';
            $level='';
            $role=session('role') ?? "user";
             $check_sponsor=Contacts::where('email',$request->email)->first();

             if(!empty($check_sponsor))
             {
              $sponsor_id=$check_sponsor->uid;
              $user=User::where('id',$sponsor_id)->first();
              $affiliate=AffiliateRegistration::where('email',$user->email)->first();

              $code=AffiliateRegistration::get_user_affiliate_code($affiliate->code);
              $level=AffiliateRegistration::get_user_level($code);
             }
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
                'username'                 => $username,
                'cellphone'             => $request->cellphone,
                'business_telephone'    => $request->business_telephone,
                'otherbusiness'         => $request->otherbusiness,
                'business_category'     => $request->business_category,
                'lead_category'         => $request->lead_category,
                'address'               => $request->address,
                'zip_code'              => $request->zip_code,
                'city'                  => $request->city,
                'state'                 => $request->state,
                'country'               => $request->country,
                'commune'               => $request->commune,
                'department'            => $request->department,
                'arrondissement'        => $request->arrondissement,
                'birth_zip_code'        => $request->birth_zip_code,
                'birth_city'            => $request->birth_city,
                'birth_state'           => $request->birth_state,
                'birth_country'         => $request->birth_country,
                'birth_commune'         => $request->birth_commune,
                'birth_department'      => $request->birth_department,
                'birth_arrondissement'  => $request->birth_arrondissement,
                'billing_address'       => $request->billing_address,
                'billing_zip_code'      => $request->billing_zip_code,
                'billing_city'          => $request->billing_city,
                'billing_state'         => $request->billing_state,
                'billing_country'       => $request->billing_country,
                'sponsor_id'            => $sponsor_id,
                'plan_id'               => $plan_id,
                'image'                 => $request->image,
                'type'                  => $role,
                'status'                => 2,
                'company'               => $request->company,
                'dob'                  => $request->dob,
            ]);
        if($AffiliateRegistration)
         {
              $full_address=$request->address.' '.$request->city.' '.$request->zip_code.' '.$request->state.' '.$request->country;
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
                 'status'       => 2,
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
            }
            if(!empty($plan_id))
            {
             $u_id=$User->id;
             ActivePlan::update_user_plan($u_id,$plan_id);
            }
            DB::table('affiliate_banner')->insert(array('affiliate_email' => $request->email));
           TempAffiliateRegistration::where('id',$request->id)->delete();
            $last_id=$User->id;
            session()->put('user_id',$last_id);
            session()->put('share_link_enable','Yes');
            session()->put('share_step1','Yes');
            Session::flash('success', "Payment done successfully");
           // return redirect('/paywithpaypal');
             session()->forget('share_step2');
           // echo url('/paywithpaypal');
            return redirect('/paywithpaypal');
        }
        else {
            return redirect()->back()->with('status',"Something went wrong!!!");
        }
}
  public function complete_registration_update(Request $request)
    {
        // print_r($request->all());
        if(!empty($request->user_id))
        {
            $data= array(
                      'fees'               => $request->fees,
                      'plan_id'            => $request->plan_id,
                       );
            $query = TempAffiliateRegistration::where('id',$request->user_id)->update($data);
            if($query){
                session()->put('user_id',$request->user_id);
           // return $this->add_affiliate_final_data($request->user_id);
             return   $this->postPaymentWithpaypal($request->fees,$request->user_id);
                //Session::flash('success', "Inserted successfully");
               // redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
        }
    }
public function send_invitation_link(Request $request)
{
    //print_r($request->all());
   $success=false;
    if(!empty($request->user)){
        $user_id=$request->user_id;
        $user=User::find($user_id);
        $aff_data=AffiliateRegistration::where('email',$user->email)->first();
        if(!empty($aff_data->code)){
          $sponsor_link=AffiliateRegistration::get_user_referral_link($aff_data->code,$aff_data->email);
        }else{
           $sponsor_link=url('/affiliate_registration');
        }
        $sponsor_name=$aff_data->first_name.' '.$aff_data->last_name;
        $sponsor_email=$aff_data->email;
        $setting=Setting::general_setting();
        $i=0;
        foreach ($request->user['email'] as $email) {
         $fullname=$request->user['first_name'][$i].' '.$request->user['last_name'][$i];
         $data=array('name'=>$fullname,'email'=>$email,'user_id'=>$user_id);
         $profile_image=Balance_info::get_affiliate_profile_pic($aff_data->email);
         $q=User_invite::create($data);
         if($q){
            $link="<a href='".$sponsor_link."' target='_blank'>Click Here</a>";
            $data = array(
            'template'          =>  'invitation_email_template',
            'subject'           =>  $setting->invitation_email_subject,
            'email_body'        =>  $setting->invitation_email_body,
            'fullname'          =>  $fullname,
            'sponsor_name'      =>  $sponsor_name,
            'sponsor_photo'     =>  $profile_image,
            'sponsor_link'      =>  $link,
           );
         //  Mail::to($email)->send(new SendMail($data2));
         $subject= $setting->invitation_email_subject;
          $data1 =array('data'=>$data);
         Mail::send('emails.invitation_email_template', $data1, function($message) use ($email, $subject,$sponsor_name,$sponsor_email) {
                 $message->to($email)->subject($subject);
                 $message->from($sponsor_email, $sponsor_name);
            });
            $success=true;
         }
         $i++;
        }
      if($success==true)
      {
       if(!empty(session()->get('share_step1')) && session()->get('share_step1')=='Yes') {
           session()->forget('share_step1');
           session()->put('share_step2','Yes');
           Session::flash('success', "Invitation send successfully");
            return redirect('/paywithpaypal');
       }elseif(!empty(session()->get('share_step2')) && session()->get('share_step2')=='Yes') {
           session()->forget('share_step2');
           session()->forget('share_link_enable');
           Session::flash('success', "Invitation send successfully");
            return redirect('/registration-success');
       }
      }else{
          return redirect()->back()->with('status',"Something went wrong!!!");
      }
    }
}
public function registration_success()
{
   if(!empty(session()->get('user_id')))
     {
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $user_id=session()->get('user_id');
        $user=User::find($user_id);
        $da2=array('status'=>1);
        $aff_data=AffiliateRegistration::where('email',$user->email)->update($da2);
        $update=User::where('id',$user_id)->update($da2);
        $setting=Setting::general_setting();
          $data2 = array(
            'template'          =>  'welcome_email_template',
            'subject'           =>  $setting->email_subject,
            'email_body'        =>  $setting->email_body,
            'fullname'          =>  $user->name,
            'email'             =>  $user->email,
            'password'          =>  $user->show_pass,
           );
         Mail::to($user->email)->send(new SendMail($data2));
        // send affiliate income
         $u=User::get_user_info($user_id);
         $u2=AffiliateRegistration::where('email',$user->email)->first();
         if(!empty($u2->code)){
            $affiliate_income=Balance_info::update_affiliate_bonus_income($user_id,$u->plan_id);
         }
        $add_plan=Balance_info::add_user_subscription($user_id,$u->plan_id);
        session()->forget('user_id');
        Session::flash('success', "Registration completed successfully");
          Session::flash('success_msg', $setting->success_page_message);
        return view('registration_success_page')->with($data);
     }else{
       return  redirect('/');
     }
}
   public  function affiliate_preview($user_id)
   {
     if(!empty(session()->get('user_id')))
     {
    $user = $data['user'] = DB::table('temp_affiliate_registrations')->where('id',$user_id)->first();
     $data['fees'] = Setting::general_setting()->registration_fee;
      $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::find($data['user']->business_category)->category;
        $data['lead_category']='';
         $data["birth_commune"] = Comune::find($user->birth_commune);
            $data["commune"] = Comune::find($user->commune);
        if(!empty($data['user']->lead_category))
        {
          $data['lead_category'] = LeadsCategory::find($data['user']->lead_category)->category;
        }

         if(empty($data['user']->code)){
            $data['plans'] = Plan::where('status',1)->whereNotIn('id',[1])->get();
            $data["grid"]=4;
             $data["offset"]='';
         }
          else{
             $data['plans'] = Plan::where(['status'=>1,'id'=>1])->get();
             $data["grid"]=4;
             $data["offset"]=4;
          }
       //print_r( $data['user']->code );die;
       return view('affiliate_registration_preview')->with($data);
     }else{
        return  redirect('affiliate_registration');
     }
   }
 public function payWithPaypal_renewal()
    {
       $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['business_category'] = BusinessCategory::get();
        $data['video'] = SettingTutorial::first();
        return view('payment_status')->with($data);
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
        return view('paywithpaypal')->with($data);
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
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));
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
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
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
        return Redirect::route('paywithpaypal');
    }
    public function postPaymentWithpaypal_renewal($price,$plan_id)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName('Renewal Fees')
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
            ->setDescription($plan_id);
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('renewal_status'))
            ->setCancelUrl(URL::route('renewal_status'));
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
                return Redirect::route('payment_status');
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('payment_status');
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
        return Redirect::route('payment_status');
    }
public function getPaymentStatus_renewal(Request $request)
    {
        
       
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
          if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $payment_id = Session::get('paypal_payment_id');
        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('payment_status');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
           
         $payment_id=$result->getId();
        // $order_no=$result->getDescription();
         $transaction_id=$result->transactions[0]->related_resources[0]->sale->id;
         $plan_id=$result->transactions[0]->description;
         $data['payment_id'] =  $payment_id;
         $data['transaction_id'] =  $transaction_id;
         $data['state'] =  $result->transactions[0]->related_resources[0]->sale->state;
        $data['amount'] =  $result->transactions[0]->related_resources[0]->sale->amount->total;
        $data['currency'] =  $result->transactions[0]->related_resources[0]->sale->amount->currency;
        $data1= array(
                      'user_id'          => Auth::user()->id,
                      'amount'           => $data['amount'],
                      'currency'         => $data['currency'],
                      'payment_id'       => $data['payment_id'],
                      'transaction_id'   => $data['transaction_id'],
                      'description'      => 'Renewal Fee',
                      'payment_status'   => $data['state'],
                      'status'           => 1,
                       );
            $query = Transactionhistory::create($data1);
            $desc="Plan Renew";
            $data1 = array(
                'user_id'            =>Auth::user()->id,
                'tid'                => $query->id,
                'amount'             => $data['amount'],
                'table_name'         => 'payments',
                'description'        => $desc,
                'status'             => 1
                 );
     $q0=Mlm_transaction::create($data1);
     if($q0){
         $user_id = Auth::user()->id;
           $u=User::get_user_info(Auth::user()->id);
           $user=User::get_user_info($user_id);
          
         $u2=AffiliateRegistration::where('email',$user->email)->first();
         if(!empty($u2->code)){
            $affiliate_income=Balance_info::update_affiliate_bonus_income_on_plan_renew($user_id,$u->plan_id); 
         }
     }
             $data['order_no'] =  $query->id;
            \Session::put('success','Payment success !!');
            if(!empty($plan_id))
            {
             ActivePlan::update_user_plan(Auth::user()->id,$plan_id);
            }
           return Redirect::route('payment_status');
        }
        \Session::put('error','Payment failed !!');
             return Redirect::route('payment_status');
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
            return Redirect::route('paywithpaypal');
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
           //return Redirect::route('paywithpaypal');
             // return view('paywithpaypal')->with($data);
            return $this->add_affiliate_final_data($order_no);
        }
        \Session::put('error','Payment failed !!');
             return Redirect::route('paywithpaypal');
          //return view('paywithpaypal')->with($data);
    }
  public function myTestAddToLog()
    {
        \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }
    // update login user idle time in system
    public function update_user_idle_time(Request $request)
    {
       if(Auth::check()){
         DailyAccessMonitoring::update_daily_idle_time();
         AccessMonitoring::update_total_stroke_idle_time();
       }
     echo "success";
    }
// update stroke time of user in system
    public function update_user_stroke_time(Request $request)
    {
       if(Auth::check()){
        DailyAccessMonitoring::update_daily_stroke_time();
        AccessMonitoring::update_total_stroke_idle_time();
       }
       echo " success";
    }
public function update_video_watching(Request $request)
    {
       if(Auth::check()){
         if(Auth::user()->role == 'affiliate'){
            $video_id=$request->video_id;
            $data=array('user_id'=>Auth::user()->id,'video_id'=>$video_id);
           VideoTrainingRecord::create($data);
         }
       }
       echo " success";
    }
public function run_jobs(){
      $success = false;
        $message = "";
        $url = "";
        $reminders=Bonus_condition::update_user_point_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_one_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_two_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_three_income_jobs();
     $reminders=Bonus_condition::distribute_bonus_level_four_income_jobs();
      $reminders=Prize_condition::distribute_bonus_prize_jobs();
     $reminders=OtherCondition::distribute_bonus_for_other_jobs();
      $reminders=UploadLeads::distribute_leads_into_basket();
      $reminders=BasketRotationSetting::rotate_basket_for_all_sponsors();
      $reminders=PromotionCondition::promote_affiliate_users();
    $success = true;
    $message = "Jobs run successfully.";
        echo json_encode(array(
        "valid"=>$success,
        "url" => $url,
        "msg" => $message
         ));
}
public function get_street_info(Request $request)
{
        $zip=$request->pincode;
         $ApiKey = 'AIzaSyDgBWvd_Vkzm2cGASKH5POBUxKnoKfWqYw';
         $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($zip)."&key=".$ApiKey."";
           $result_string = file_get_contents($url);
           $result = json_decode($result_string, true);
           $loc=$result['results'][0]['address_components'];
           $data=array(
                    'pincode' =>$loc[0]['long_name'],
                    'street' =>$loc[1]['long_name'],
                    'city' =>$loc[2]['long_name'],
                  //  'state' =>$loc[3]['long_name'],
                   // 'country' =>$loc[4]['long_name'],
                   );
           echo json_encode($data);
}
public function add_enquiry_entry(Request $request)
{
    $request->validate([
    'name' => 'required|min:3|max:50',
    'contact_no' =>  'required|numeric|min:10',
    'email_id' => 'required|email'
    ]);
    $data=array(
            'name' =>$request->name,
            'contact' =>$request->contact_no,
            'email' =>$request->email_id,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s')
            );
   // print_r($data);die;
    $q=DB::table('affiliate_enqueries')->insert($data);
    // return redirect('/home')->with('status',"Please login or register to access this page.");
      return redirect()->back()->with('status',"Thank you for submitting your email, will back with you shortly.");
}
   public  function upgrade_plan($user_id=null)
   {
       if(empty($user_id)){
            if(Auth::check())
     {
         $user_id=Auth::user()->id;
        
     //   if($user_id)
        $data['user'] = DB::table('users')->where('id',$user_id)->first();
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        if((Auth::user()->role) == "affiliate"){
            $aaid = Auth::user()->email;
        }
        else{
            $aaid = Auth::user()->affiliate_user_email;
        }
        $data['aabanner'] = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $affiliate=AffiliateRegistration::where('email',$data['user']->email)->first();
         if(empty($affiliate->code)){
            $data['plans'] = Plan::where('status',1)->whereNotIn('id',[1])->get();
            $data["grid"]=4;
             $data["offset"]='';
         }
          else{
             $data['plans'] = Plan::where(['status'=>1,'id'=>1])->get();
             $data["grid"]=4;
             $data["offset"]=4;
          }
       //print_r( $data['user']->code );die;
       return view('affiliate_renewplan')->with($data);
     }else{
        return  redirect('home');
     }
        }else{
           
        $user_id=$user_id;
        
     //   if($user_id)
        $data['user'] = DB::table('users')->where('id',$user_id)->first();
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        $data['links'] = Menulinks::get();
        $now = date('Y-m-d');
        $data['top_videos'] = HomeTopVideo::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now], ['display', "show"]])->get();
        $data['top_banners'] = TopBanner::select('*')->where([['status', "on"], ['startdate', '<=', $now], ['enddate', '>=', $now]])->get();
        $data['slidetime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        $data['religion'] = Religion::get();
        // if((Auth::user()->role) == "affiliate"){
        //     $aaid = Auth::user()->email;
        // }
        // else{
        //     $aaid = Auth::user()->affiliate_user_email;
        // }
         $get_user_info = User::where(['id'=>$user_id])->first();
        $aaid = $get_user_info->email;
         $data['aabanner'] =DB::table('affiliate_banner')->where('affiliate_email', $aaid)->get();
        $affiliate=AffiliateRegistration::where('email',$data['user']->email)->first();
         if(empty($affiliate->code)){
            $data['plans'] = Plan::where('status',1)->whereNotIn('id',[1])->get();
            $data["grid"]=4;
             $data["offset"]='';
         }
          else{
             $data['plans'] = Plan::where(['status'=>1,'id'=>1])->get();
             $data["grid"]=4;
             $data["offset"]=4;
          }
       //print_r( $data['user']->code );die;
       return view('affiliate_renewplan')->with($data);
    
        }
     
   }
  public function update_current_plan(Request $request)
    {
        // print_r($request->all());
        if(!empty($request->user_id) && !empty($request->plan_id))
        {
           return   $this->postPaymentWithpaypal_renewal($request->fees,$request->plan_id);
        }
        else{
        return redirect()->back()->with('status',"Something went wrong!!!");
        }
    }
    public function add_affiliate_library_form(Request $request)
    {
        $array = json_decode($request->sub_arr);
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $i=0;
        $delete = DB::table('affiliate_library_form')->where(['uid' =>$uid,'form_cat_id'=>$request->form_cat_id])->delete();
        foreach ($array as $value) {
          if(!empty($value))
          {
          $exist = DB::table('affiliate_library_form')->where(['uid' =>$uid,'form_id'=>$value])->first();
            if($exist == ""){
                $values = array(
                    'form_id'      => $value,
                    'form_cat_id'  => $request->form_cat_id,
                    'uid'           => $uid
                );
                DB::table('affiliate_library_form')->insert($values);
            }
           }
        }


         $notification  = getNotificationMessage(68);
         $message = $notification;
         $subject = "Library form added";
         addUserActivity($subject,'add',$notification,$message);
    }
    public static function library_existance($form_id)
    {
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $exist = DB::table('affiliate_library_form')->where(['uid'=>$uid,'form_id'=>$form_id])->first();
        $val = "";
        if($exist != ""){
            $val = "exist";
        }
        else{
            $val = "not exist";
        }
        return $val;
    }
    public function add_balancesheet_for_current_assets(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->asset_amount;
      //  print_r($amount_data);die;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
       DB::table('current_asset_balancesheet')->insert($data);
         $notification  = getNotificationMessage(53);
         $message = $notification;
         $subject = "Balancesheet Added";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function update_balancesheet_for_current_assets(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->asset_amount;
       // print_r($amount_data);die;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('current_asset_balancesheet')->where('id',$request->id)->update($data);
          $notification  = getNotificationMessage(54);
         $message = $notification;
         $subject = "Balancesheet updated";
         addUserActivity($subject,'update',$notification,$message);
       // return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function add_balancesheet_for_noncurrent_assets(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('noncurrent_asset_balancesheet')->insert($data);
          $notification  = getNotificationMessage(53);
         $message = $notification;
         $subject = "Balancesheet Added";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function update_balancesheet_for_noncurrent_assets(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('noncurrent_asset_balancesheet')->where('id',$request->id)->update($data);
          $notification  = getNotificationMessage(54);
         $message = $notification;
         $subject = "Balancesheet updated";
         addUserActivity($subject,'add',$notification,$message);
    }
    public function add_balancesheet_for_current_liability(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('current_liability_balancesheet')->insert($data);
          $notification  = getNotificationMessage(53);
         $message = $notification;
         $subject = "Balancesheet Added";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function update_balancesheet_for_current_liability(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('current_liability_balancesheet')->where('id',$request->id)->update($data);
         $notification  = getNotificationMessage(54);
         $message = $notification;
         $subject = "Balancesheet updated";
         addUserActivity($subject,'add',$notification,$message);
        //return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function add_balancesheet_for_noncurrent_liability(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('noncurrent_liability_balancesheet')->insert($data);
         $notification  = getNotificationMessage(53);
         $message = $notification;
         $subject = "Balancesheet added";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function update_balancesheet_for_noncurrent_liability(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('noncurrent_liability_balancesheet')->where('id',$request->id)->update($data);
          $notification  = getNotificationMessage(54);
         $message = $notification;
         $subject = "Balancesheet updated";
         addUserActivity($subject,'add',$notification,$message);
      //  return redirect()->back()->with('status',"Amount saved successfully.");
    }
    public function add_balancesheet_for_equity(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('equity_balancesheet')->insert($data);
          $notification  = getNotificationMessage(53);
         $message = $notification;
         $subject = "Balancesheet added";
         addUserActivity($subject,'add',$notification,$message);
        return redirect()->back()->with('status',"Amount saved successfully.");
    }
   public function update_balancesheet_for_equity(Request $request)
    {
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $raw_data=array();
        $amount_data=$request->amount;
        foreach ($amount_data as $key => $value) {
          $raw_data[] =array( "$key"=>$amount_data[$key][0]);
        }
        $data['uid']= $uid;
        $data['raw_data']= json_encode($raw_data);
        $data['created_at']=date('Y-m-d H:i:s');
        $data['updated_at']=date('Y-m-d H:i:s');
        DB::table('equity_balancesheet')->where('id',$request->id)->update($data);
        //return redirect()->back()->with('status',"Amount saved successfully.");
        $notification  = getNotificationMessage(54);
         $message = $notification;
         $subject = "Balancesheet updated";
         addUserActivity($subject,'update',$notification,$message);
    }
    public function send_test_email(){
         $setting=Setting::general_setting();
         $name="Ram";
         $email="ramkishor051@gmail.com";
          $data2 = array(
            'template'          =>  'welcome_email_template',
            'subject'           =>  $setting->email_subject,
            'email_body'        =>  $setting->email_body,
            'fullname'          =>  $name,
            'email'             =>  $email,
            'password'          =>  '12345',
           );
        $send= Mail::to($email)->send(new SendMail($data2));
        if($send){
            echo "Email has been send";
        }else{
            echo "Email not send";
        }
    }
    
    
    
    
    
    
    
public function test_email()
{
    //print_r($request->all());
   $success=false;
    
        $user_id=283;
        $user=User::find($user_id);
        $aff_data=AffiliateRegistration::where('email',$user->email)->first();
        if(!empty($aff_data->code)){
          $sponsor_link=AffiliateRegistration::get_user_referral_link($aff_data->code,$aff_data->email);
        }else{
           $sponsor_link=url('/affiliate_registration');
        }
        $sponsor_name=$aff_data->first_name.' '.$aff_data->last_name;
        $sponsor_email=$aff_data->email;
        $setting=Setting::general_setting();
        $i=0;
         $email="yramkishor0@gmail.com"; 
         $fullname='Test ssb';
         $data=array('name'=>$fullname,'email'=>$email,'user_id'=>$user_id);
         $profile_image=Balance_info::get_affiliate_profile_pic($aff_data->email);
        // $q=User_invite::create($data);
        
            $link="<a href='".$sponsor_link."' target='_blank'>Click Here</a>";
            $data = array(
            'template'          =>  'invitation_email_template',
            'subject'           =>  $setting->invitation_email_subject,
            'email_body'        =>  $setting->invitation_email_body,
            'fullname'          =>  $fullname,
            'sponsor_name'      =>  $sponsor_name,
            'sponsor_photo'     =>  $profile_image,
            'sponsor_link'      =>  $link,
           );
        // $dd= Mail::to($email)->send(new SendMail($data));
         $subject= $setting->invitation_email_subject;
          $data1 =array('data'=>$data);
         // print_r($data1);die;
        $dd=Mail::send('emails.invitation_email_template', $data1, function($message) use ($email, $subject,$sponsor_name,$sponsor_email) {
                 $message->to($email)->subject($subject);
                 $message->from($sponsor_email, $sponsor_name);
            });
            
            if($dd){
                echo "Email Send";
            }else{
                echo "not send";
            }
            $success=true;
        
       
    
}
    
    public function test_weekly_jobs(){
    $success = false;
    $message = "";
    $url = "";
    $reminders=Transactionhistory::weekly_jobs();
    $success = true;
    $message = "Jobs run successfully.";
        echo json_encode(array(
        "valid"=>$success,
        "url" => $url,
        "msg" => $message
         ));
}
    
    
     public static function deduct_commission_amount(){
       
     $affiliate_registrations = DB::table('affiliate_registrations')->where('status','1')->get();
    if(!empty($affiliate_registrations)){
        foreach($affiliate_registrations as $users_list){
            $country_code =$users_list->country;
            $a_user_email =$users_list->email;
            
            $check_country_of_residence = DB::table('country_status_setting')->where('country',$country_code)->where('status','1')->first();
            if(!empty($check_country_of_residence)){
                 
                $Affiliate_Commission_Amount = $check_country_of_residence->affiliate_commission;
                $deduct_amount = $check_country_of_residence->deduct_amount;
                
                $get_user_info = User::where(['email'=>$a_user_email])->first();
                 if(!empty($get_user_info)){
                $user_id = $get_user_info->id;
                $get_last_month = DB::table('option_meta')->where('user_id',$user_id)->where('key','user_last_commision_month')->first();
                if(!empty($get_last_month)){
                    $last_month = $get_last_month->value;
                }else{
                    $last_month =0;
                    DB::table('option_meta')->insert(['user_id'=>$user_id,'key'=>'user_last_commision_month','value'=>'0']);
                }
                 
                
                $date = new DateTime('now');
                 $current_date= $date->format('Y-m-d');
                $date->modify('last day of this month');
                $current_month= $date->format('m');
                $current_year= $date->format('Y');
                 $last_date= $date->format('Y-m-d');
                 if($last_month == 12){
                     $last_month =0;
                 }
                $get_bonus_incomes = Mlm_transaction::where('user_id',$user_id)->where('status','1')->whereMonth('created_at', $current_month)->whereYear('created_at', $current_year)->Where('table_name', 'bonus_incomes')->sum('amount');

                $get_level_earnings = Mlm_transaction::where('user_id',$user_id)->where('status','1')->whereMonth('created_at', $current_month)->whereYear('created_at', $current_year)->Where('table_name','level_earnings')->sum('amount');
                
                $current_amount = $get_bonus_incomes + $get_level_earnings;
              
                 if($current_amount > $Affiliate_Commission_Amount && $last_month <  $current_month)
                  {
                     
                      DB::table('option_meta')->where('user_id',$user_id)->where('key','user_last_commision_month')->update(['value'=>$current_month]);
                       
                     $new_amount=$current_amount-$deduct_amount;
                     $data1 =array('amount'=>$new_amount);
                     Balance_info::where(['user_id'=>$user_id])->update($data1);
                
                     $table_name="balance_infos";
                     $desc="Commission value reached over <b>$Affiliate_Commission_Amount</b> commission fees <b>$deduct_amount</b> deducted  ";
                     $tid=Balance_info::where('user_id',$user_id)->first()->id;
                      $data1 = array(
                                'user_id'            => $user_id,
                                'tid'                => $tid,
                                'amount'             => $deduct_amount,
                                'table_name'         => $table_name,
                                'description'        => $desc,
                                'status'             => 1
                                 );
                      $q0=Mlm_transaction::create($data1);
                  }
            }
                
                
            }
            
        }
    }
  
  
  
//  $get_plan_date = DB::table('plan_activations')->where('user_id',$user_id)->orderBy('id','desc')->first();  
//  if(!empty($get_plan_date)){
//      $plan_date = strtotime($get_plan_date->created_at);
//      $now = time();
//     $datediff = $now - $plan_date;
    
//     $total_days_diff =  round($datediff / (60 * 60 * 24));
     
//  }else{
//      $total_days_diff = 1000;
//  }

//  return $total_days_diff; 
  
}

    
    
    
    
    
    
    
    
    
}
