<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
//   $type = 'string';
// $length = 20;
// $fieldName = 'car_tyer';
// Schema::table('lab_tests', function (Blueprint $table) use ($type, $length, $fieldName) {
//     $table->$type($fieldName, $length);
// });
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
use App\LabTest;
use App\PharmacyDetail;
use App\VitalSign;
use App\TestComparision;
use App\Setting;
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
use App\Mlm_transaction;
use App\FinancialInvoiceSetup;
use App\Notification;
use App\FinancialTemplateCategory;
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
class LabController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
 
    public function upload_lab_test_result($id)
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid); 
        $data['id'] = $id;
        
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       
       $data["lab"]='';
       if(!empty($id)){
        $data["lab"]=LabTest::find($id);
       }
        
       $data["lab_name"]="";
       $bnr=DB::table('affiliate_banner')->where('affiliate_email',Auth::user()->email)->first();
       if(!empty($bnr)){
         $data["lab_name"]=$bnr->business_name;
       }
        $af=AffiliateRegistration::where('email',Auth::user()->email)->first();        
             
        $data["business_category"]=$af->business_category;
       return view('lab.upload_lab_test_result',$data);
    }
    public function lab_test_page(Request $request,$id,$test_id="")
    {
        $data['mode']='';
       $daily=$request->input('daily');
       $sdate=$request->input('sdate');
       $edate=$request->input('edate');
       $monthly=$request->input('monthly');
          if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");        
        }
        if(Auth::user()->role == "admin"){ 
            return redirect('/')->with('status',"Admin can't access this page.");
         }
         $client_id='';
        if(!empty($id))
        {
        $client_email=ClientAppointmentList::find($id)->email;
        $client_id=User::where('email',$client_email)->first()->id;
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
        //print_r($data['top_banners']);die();
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
        $data['id'] = $id;
        $data['test_id'] = $test_id;
        $data['client_id'] = $client_id;
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       
       $data["form"]='';
       if(!empty($test_id)){
        $data["form"]=LabTest::find($test_id);
       }
        
       $data["lab_name"]="";
       $bnr=DB::table('affiliate_banner')->where('affiliate_email',Auth::user()->email)->first();
       if(!empty($bnr)){
         $data["lab_name"]=$bnr->business_name;
       }
        $af=AffiliateRegistration::where('email',Auth::user()->email)->first();        


if(!empty($daily)){
         $data['mode']='daily';

         $data["lab_records"]=LabTest::where(['lab_tests.login_id'=>Auth::id()])
           ->whereDate('lab_tests.created_at', '=', $daily)

         ->join('users', 'users.id', '=', 'lab_tests.login_id')
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
        }elseif(!empty($monthly)){
          $data['mode']='monthly';

        $data["lab_records"]=LabTest::where(['lab_tests.login_id'=>Auth::id()])
           ->whereMonth('lab_tests.created_at',$monthly)
           ->whereYear('lab_tests.created_at',date('Y'))
         ->join('users', 'users.id', '=', 'lab_tests.login_id')
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
        }elseif (!empty($sdate) && !empty($edate)) {
           $data['mode']='weekly';

          $data["lab_records"]=LabTest::where(['lab_tests.login_id'=>Auth::id()])
           ->whereBetween('lab_tests.created_at', [$sdate, $edate])
         ->join('users', 'users.id', '=', 'lab_tests.login_id')
         ->select('lab_tests.*','users.email','users.name')
         ->orderBy('lab_tests.id','DESC')
         ->get();
        }else{
        $data["lab_records"]=LabTest::get_lab_records($client_id);
        }
        $data["lab_list"]=LabTest::get_lab_list();       
        $data["business_category"]=$af->business_category;
       return view('lab.lab_test_page',$data);
    }
public function download_file($id) {
      $data=LabTest::where(['id'=>$id])->first();
    $file_path = public_path('files/'.$data->uploaded_file);
    return response()->download($file_path);
  }
public function deleteRowData(Request $request){
    
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
        $notification  = getNotificationMessage(63);
        $message1 = $notification;
         $subject = "Record deleted  successfully";
         addUserActivity($subject,'delete',$notification,$message1);
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
public function mark_as_progress_test(Request $request){  
   
    $id=$request->id;
    $data['completed_by']=Auth::id();    
    $data['status']=2;
    $q1=LabTest::where('id',$id)->update($data);

       $notification  = getNotificationMessage(31);
        $message = $notification;
         $subject = "Lab request marked as progerss";
         addUserActivity($subject,'add',$notification,$message);
    //Session::flash('success', "Success!");
  //  return redirect()->with('status',"Test marked as progress successfully.");
   
  }
public function mark_as_complete_test(Request $request){
    
    $success = false;
    $message = "";
    $url = "";
    $id=$request->id;
    
    $data['completed_by']=Auth::id();
    $q1=LabTest::where('id',$id)->update($data);
    if($q1)
    {
      $success = true;
      $message = "Lab test mark as completed ";
       $notification  = getNotificationMessage(32);
        $message1 = $notification;
         $subject = "Lab request marked as completed";
         addUserActivity($subject,'add',$notification,$message1);
    }
    else
    {
      $message = "Not completed";
    }
   
    echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
public function update_test_status(Request $request){
    
    $success = false;
    $message = "";
    $url = "";
    $id=$request->id;
    $status=$request->status;
    $data['status']=$status;
    $q1=LabTest::where('id',$id)->update($data);
    if($q1)
    {
      $success = true;
      $message = "Lab test released successfully";
        $notification  = getNotificationMessage(64);
        $message1 = $notification;
         $subject = "Lab test released ";
         addUserActivity($subject,'add',$notification,$message1);
    }
    else
    {
      $message = "Not released";
    }
   
    echo json_encode(array(
        "valid"=>$success,        
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
public function update_lab_test_comment(Request $request){
    
    $success = false;
   
    $id=$request->id;   
    $data['comment']=$request->comment;
    $q1=LabTest::where('id',$id)->update($data);
    Session::flash('success', "Success!");
      $notification  = getNotificationMessage(65);
        $message1 = $notification;
         $subject = "Lab test updated ";
         addUserActivity($subject,'update',$notification,$message1);
     return redirect()->back()->with('status',"Comment updated successfully.");
    
  }
public function lab_test_add_edit(Request $request)
{
     if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
      $data['uid']=$uid;
      $data['login_id']=Auth::id();
      $data['client_id']=$request->client_id;
      $data['test_name']=$request->test_name;
      $data['lab_id']=$request->lab_id;
      $data['status']=0;
      LabTest::create($data);
        $notification  = getNotificationMessage(27);
        $message1 = $notification;
         $subject = "Lab test added ";
         addUserActivity($subject,'add',$notification,$message1);
      Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Test added successfully.");
   
}
public function lab_test_upload_file(Request $request)
{
     
    $file_path=$request->old_file;
    if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = 'lab_'; //$filenames[0];
            $extension = $file->getClientOriginalExtension();
            $file_path = $filename.'_'.time().'.'.$extension;
            $dir = 'public/files';
            $file->move($dir,$file_path);
        }
   
     
      $data['uploaded_file']=$file_path;
      $data['completed_by']=Auth::id();
      $data['status']=1;
      LabTest::where('id',$request->id)->update($data);
        $notification  = getNotificationMessage(32);
        $message1 = $notification;
         $subject = "Lab test completed ";
         addUserActivity($subject,'add',$notification,$message1);
      Session::flash('success', "Success!");
      return redirect('front_dashboard')->with('status',"Test completed successfully.");
   
}
  public function referals_page()
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
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.referals_page',$data);
    }
  public function vital_signs_page($id)
    {
      if(empty($id)){
        return redirect('/');
      }
          if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");        
        }
        if(Auth::user()->role == "admin"){ 
            return redirect('/')->with('status',"Admin can't access this page.");
         }
        $client_email=ClientAppointmentList::find($id)->email;
        $client_id=User::where('email',$client_email)->first()->id;
        $data["client_id"]=$client_id;
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       $data["form"]='';
       $data["uid"]=$id;
      
      // print_r($data["form"]);die;
       $data["records"]=VitalSign::get_vital_signs_records($client_id);
       return view('lab.vital_signs_page',$data);
    }
  public function vital_signs_update_page($id,$uid)
    {
      if(empty($id)){
        return redirect('/');
      }
          if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");        
        }
        if(Auth::user()->role == "admin"){ 
            return redirect('/')->with('status',"Admin can't access this page.");
         }
         
         $data["form"]=VitalSign::find($id);
        
        $client_id=$data["form"]->client_id;
        $data["client_id"]=$data["form"]->client_id;
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        // $uid = "";
        // if((Auth::user()->role) == "affiliate"){
        //     $uid = Auth::id();
        // }
        // else{
        // $uid = Auth::user()->affiliate_user_id;
        // }
       $data['uid']=$uid;
      // print_r($data["form"]);die;
       $data["records"]=VitalSign::get_vital_signs_records($client_id);
       return view('lab.vital_signs_page',$data);
    }
public function vital_signs_add_edit_post(Request $request)
{
     if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
    
    if(empty($request->id)){      
      $data['uid']=$uid;
      $data['login_id']=Auth::id();
      $data['client_id']=$request->client_id;
      $data['weight']=$request->weight;
      $data['weight_unit']=$request->weight_unit;
      $data['height']=$request->height;
      $data['blood_pressure']=$request->blood_pressure;
      $data['temperature']=$request->temperature;
      $data['heart_rate']=$request->heart_rate;
      $data['raspiratory']=$request->raspiratory;
      $data['spo2']=$request->spo2;    
      $data['status']=1;
       
      VitalSign::create($data);
         $notification  = getNotificationMessage(35);
        $message1 = $notification;
         $subject = "Vital sign added ";
         addUserActivity($subject,'add',$notification,$message1);
      Session::flash('success', "Success!");
     return redirect('lab/vital-signs')->with('status',"Signs added successfully.");
    }else{
      $data['weight_unit']=$request->weight_unit;
      $data['weight']=$request->weight;
      $data['height']=$request->height;
      $data['blood_pressure']=$request->blood_pressure;
      $data['temperature']=$request->temperature;
      $data['heart_rate']=$request->heart_rate;
      $data['raspiratory']=$request->raspiratory;
      $data['spo2']=$request->spo2;    
      
     
      VitalSign::where('id',$request->id)->update($data);
       $notification  = getNotificationMessage(66);
        $message1 = $notification;
         $subject = "Vital sign updated ";
         addUserActivity($subject,'add',$notification,$message1);
       Session::flash('success', "Success!");
      return redirect('lab/vital-signs/'.$request->userid)->with('status',"Signs updated successfully.");
    }
}
  public function lab_report_chart($client_id,$component_id)
    {
      if(empty($component_id)){
        return redirect('/');
      }
          if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");        
        }
        if(Auth::user()->role == "admin"){ 
            return redirect('/')->with('status',"Admin can't access this page.");
         }
        
        $data["client_id"]=$client_id;
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       
      $data["standard_value"] = DB::table('test_components')->where('id',$component_id)->first()->standard_value;
      $data["component_id"]=$component_id;
      $data["chart_months"]=TestComparision::get_chart_comparision_records($client_id,$component_id,10);
      return view('lab.lab_report_chart',$data);
    }
  public function test_comparision_page($id)
    {
      if(empty($id)){
        return redirect('/');
      }
          if(Auth::id() == NULL){
            return redirect('/')->with('status',"Please login or register to access this page.");
        }
        if((Auth::user()->role == "temp_user") || (Auth::user()->role == "client")){
            return redirect('/')->with('status', "You can't access this page.");        
        }
        if(Auth::user()->role == "admin"){ 
            return redirect('/')->with('status',"Admin can't access this page.");
         }
        $client_email=ClientAppointmentList::find($id)->email;
        $client_id=User::where('email',$client_email)->first()->id;
        $data["client_id"]=$client_id;
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       $data["form"]='';
       $data['component_list1']=DB::table('test_components')->where(['uid'=>$uid,'status'=>0])->orderBy('id','desc')->get();
  
      $data['component_list']=DB::table('test_components')->where('status',1)->orderBy('component','asc')->get();
      $data['components_reports']=DB::table('test_components')->where('status',1)->orWhere(['uid'=>$uid,'status'=>0])->orderBy('component','asc')->get();
      $data["records"]=TestComparision::get_test_components_records($client_id);
      $data["last_records"]=TestComparision::get_top_comparision_records($client_id,10);
      return view('lab.tests_comparison',$data);
    }
public function test_coparision_add_edit_post(Request $request)
{
     if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
    
        
      $data['uid']=$uid;
      $data['login_id']=Auth::id();
      $data['client_id']=$request->client_id;
      $data['component_id']=$request->component_id;
     // $data['test_component']=$request->test_component;
      $data['current_value']=$request->current_value;        
      $data['standard_value']=$request->standard_value;        
      $data['status']=1;
       
      TestComparision::create($data);
         $notification  = getNotificationMessage(30);
        $message1 = $notification;
         $subject = "TestComparision added ";
         addUserActivity($subject,'add',$notification,$message1);
      Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Comparision added successfully.");
   
}
public function pharmacy_form_submit(Request $request)
{
     if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
    
    if(empty($request->id)){      
      $data['uid']=$uid;
      $data['login_id']=Auth::id();
      
      $data['client_id']=$request->client_id;
      $data['complaint1']=$request->complaint1;
      $data['complaint2']=$request->complaint2;
      $data['complaint3']=$request->complaint3;
      $data['medication1']=$request->medician1;
      $data['medication2']=$request->medician2;
      $data['medication3']=$request->medician3;
      $data['recomm1']=$request->recomm1;
      $data['recomm2']=$request->recomm2;
      $data['recomm3']=$request->recomm3;
      $data['result1']=$request->result1;
      $data['result2']=$request->result2;
      $data['result3']=$request->result3;
      $data['dosage_day1']=$request->dosage_day1;
      $data['dosage_day2']=$request->dosage_day2;
      $data['dosage_day3']=$request->dosage_day3;
      $data['dosage_times1']=$request->dosage_times1;
      $data['dosage_times2']=$request->dosage_times2;
      $data['dosage_times3']=$request->dosage_times3;
      $data['dosage_hours1']=$request->dosage_hours1;
      $data['dosage_hours2']=$request->dosage_hours2;
      $data['dosage_hours3']=$request->dosage_hours3;
      $data['generic1']=$request->generic1;
      $data['generic2']=$request->generic2;
      $data['generic3']=$request->generic3;
      $data['fill_medication1']=$request->fill_medication1;
      $data['fill_medication2']=$request->fill_medication2;
      $data['fill_medication3']=$request->fill_medication3;
      $data['pharma_note1']=$request->pharma_note1;
      $data['pharma_note2']=$request->pharma_note2;
      $data['pharma_note3']=$request->pharma_note3;
      $data['special_note1']=$request->special_note1;
      $data['special_note2']=$request->special_note2;
      $data['special_note3']=$request->special_note3;
        
      $data['status']=1;
       
      PharmacyDetail::create($data);
         $notification  = getNotificationMessage(35);
        $message1 = $notification;
         $subject = "Pharmacy Added ";
         addUserActivity($subject,'add',$notification,$message1);
      Session::flash('success', "Success!");
     return redirect()->back()->with('status',"Pharmacy added successfully.");
    }else{
       $data['weight']=$request->weight;
        
      
     
      PharmacyDetail::where('id',$request->id)->update($data);
         $notification  = getNotificationMessage(36);
        $message1 = $notification;
         $subject = "Pharmacy Added ";
         addUserActivity($subject,'update',$notification,$message1);
       Session::flash('success', "Success!");
      return redirect('lab/pharmacy')->with('status',"Pharmacy updated successfully.");
    }
}
  public function visits_page()
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
         $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.visits_page',$data);
    }
  public function care_reminders_page()
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
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.care_reminders_page',$data);
    }
  public function access_role_page()
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
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.access_role_page',$data);
    }
  public function pharmacy_page(Request $request,$id='')
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
        $client_id=''; 
       if(!empty($id))
       {
        $client_email=ClientAppointmentList::find($id)->email;
        $client_id=User::where('email',$client_email)->first()->id;
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
        //print_r($data['top_banners']);die();
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
    
    $data["client_id"]=$client_id;
    $data["complaint1"]=DB::table("client_reports")->where('client_id',$client_id)->orderBy('report','asc')->get();
    $data["complaint2"]= $data["complaint1"];
    $data["complaint3"]= $data["complaint1"];
    $data["medician1"]=DB::table("client_medications")->where('client_id',$client_id)->orderBy('report','asc')->get();
    $data["recomms"]=DB::table("client_recommendations")->where('client_id',$client_id)->orderBy('report','asc')->get();
    $data["medician2"]=$data["medician1"];
    $data["medician3"]=$data["medician1"];   
      $data['mode']='';
       $daily=$request->input('daily');
       $sdate=$request->input('sdate');
       $edate=$request->input('edate');
       $monthly=$request->input('monthly');


if(!empty($daily)){
         $data['mode']='daily';

          $data["records"]=PharmacyDetail::where(['pharmacy_details.login_id'=>Auth::id()])
          ->whereDate('pharmacy_details.created_at', '=', $daily)
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
        }elseif(!empty($monthly)){
          $data['mode']='monthly';

           $data["records"]=PharmacyDetail::where(['pharmacy_details.login_id'=>Auth::id()])
            ->whereMonth('pharmacy_details.created_at', $monthly)
            ->whereYear('pharmacy_details.created_at', date('Y'))
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
        }elseif (!empty($sdate) && !empty($edate)) {
           $data['mode']='weekly';

           $data["records"]=PharmacyDetail::where(['pharmacy_details.login_id'=>Auth::id()])
           ->whereBetween('pharmacy_details.created_at', [$sdate, $edate])
         ->join('users', 'users.id', '=', 'pharmacy_details.login_id')
         ->select('pharmacy_details.*','users.email','users.name')
         ->orderBy('pharmacy_details.id','DESC')
         ->get();
        }else{
        $todayorder=$request->input('order');
             if($todayorder=='today')
             {
               $data["records"]=PharmacyDetail::get_pharmacy_today_records();
             }else{
                $data["records"]=PharmacyDetail::get_pharmacy_records($client_id);
             }

        }


       return view('lab.pharmacy_page',$data);
    }
  public function patient_grouping_page()
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
          $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.patient_grouping_page',$data);
    }
  public function resources_page()
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
        $data['is_medical_user'] = BusinessCategory::is_medical_user($aaid);
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
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
        $uid = Auth::user()->affiliate_user_id;
        }
       return view('lab.resources_page',$data);
    }
public function add_new_recommendations(Request $request)
{
   $success = true;
   $html1="";
   $html2="";
   $html3="";
  if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
      }
      else{
        $uid = Auth::user()->affiliate_user_id;
      }
 
  $data["report"]=$request->report;
  $data["client_id"]=$request->client_id;
  $data["status"]='1';
  $data["created_at"]=date('Y-m-d H:i:s');
  $data["updated_at"]=date('Y-m-d H:i:s');
  $check1= DB::table('client_recommendations')->where(['report'=>$request->report,'client_id'=>$request->client_id])->first();
  if(empty($check1))
  {
      DB::table('client_recommendations')->insert($data);
  }
 
  $list1=DB::table('client_recommendations')->where('client_id',$request->client_id)->orderBy('id','desc')->get();
  if(count($list1) >0 ){
    $html1=ob_start();
    foreach ($list1 as $key => $value) {
     echo "<option value='".$value->report."'>".$value->report."</option>";
    }
    $html1=ob_get_clean();
  }
       $notification  = getNotificationMessage(67);
        $message1 = $notification;
         $subject = "Recommendation Added ";
         addUserActivity($subject,'add',$notification,$message1);
  echo json_encode(array(
        "valid"=>$success,        
        "html1" => $html1,
        "type" => $request->type
       
        
    ));
    exit;
}
public function add_new_complaint(Request $request)
{
   $success = true;
   $html1="";
   $html2="";
   $html3="";
  if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
      }
      else{
        $uid = Auth::user()->affiliate_user_id;
      }
 
  $data["report"]=$request->complaint;
  $data["client_id"]=$request->client_id;
  $data["status"]='1';
  $data["created_at"]=date('Y-m-d H:i:s');
  $data["updated_at"]=date('Y-m-d H:i:s');
  $check1= DB::table('client_reports')->where(['report'=>$request->complaint,'client_id'=>$request->client_id])->first();
  if(empty($check1))
  {
      DB::table('client_reports')->insert($data);
  }
 
  $list1=DB::table('client_reports')->where('client_id',$request->client_id)->orderBy('id','desc')->get();
  if(count($list1) >0 ){
    $html1=ob_start();
    foreach ($list1 as $key => $value) {
     echo "<option value='".$value->report."'>".$value->report."</option>";
    }
    $html1=ob_get_clean();
  }
 
  echo json_encode(array(
        "valid"=>$success,        
        "html1" => $html1,
        "type" => $request->type
       
        
    ));
    exit;
}
public function add_new_component_by_user(Request $request)
{
 // print_r($request->all());die;
   $success = true;
   $html1="";
   $html2="";
  
  if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
      }
      else{
        $uid = Auth::user()->affiliate_user_id;
      }
 
  $data = array(         
         'component'           => $request->component,         
         'description'         => $request->bonus_message_day,         
         'standard_value'      =>$request->standard_value,         
         'uid'                 => $uid,         
         'status'              =>0,         
         'created_at'          =>date('Y-m-d H:i:s'),         
         'updated_at'          =>date('Y-m-d H:i:s'),         
                  
        );  
     
  $check1= DB::table('test_components')->where(['component'=>$request->component])->first();
  if(empty($check1))
  {
     DB::table('test_components')->insert($data); 
  }
 
  $list1=DB::table('test_components')->where(['uid'=>$uid,'status'=>0])->orderBy('id','desc')->get();
  if(count($list1) >0 ){
    $html1=ob_start();
    foreach ($list1 as $key => $value) {
     echo "<option value='".$value->id."'>".$value->component."</option>";
    }
    $html1=ob_get_clean();
  }
  $list2=DB::table('test_components')->where('status',1)->orderBy('id','desc')->get();
  if(count($list2) >0 ){
    $html2=ob_start();
    foreach ($list2 as $key => $value) {
     echo "<option value='".$value->id."'>".$value->component."</option>";
    }
    $html2=ob_get_clean();
  }
 $html=$html1.$html2;
  echo json_encode(array(
        "valid"=>$success,        
        "html" => $html,
        "standard_value" => $request->standard_value
       
        
    ));
    exit;
}
public function get_standard_value(Request $request)
{
  $list=DB::table('test_components')->where('id',$request->id)->first();
  echo $list->standard_value;
}
public function add_new_medication(Request $request)
{
  $success = true;
   $html1="";
   $html2="";
   $html3="";
  if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
      }
      else{
        $uid = Auth::user()->affiliate_user_id;
      }
  
  $data["report"]=$request->medication;
  $data["client_id"]=$request->client_id;
  $data["status"]='1';
  $data["created_at"]=date('Y-m-d H:i:s');
  $data["updated_at"]=date('Y-m-d H:i:s');
  
  $check1= DB::table('client_medications')->where(['report'=>$request->medication,'client_id'=>$request->client_id])->first();
  if(empty($check1))
  {
  DB::table('client_medications')->insert($data);
  }
   $list1=DB::table('client_medications')->where('client_id',$request->client_id)->orderBy('id','desc')->get();
  if(count($list1) >0 ){
    $html1=ob_start();
    foreach ($list1 as $key => $value) {
     echo "<option value='".$value->report."'>".$value->report."</option>";
    }
    $html1=ob_get_clean();
  }
   $notification  = getNotificationMessage(38);
        $message1 = $notification;
         $subject = "Medication Added ";
         addUserActivity($subject,'add',$notification,$message1);
  
  echo json_encode(array(
        "valid"=>$success,        
        "html1" => $html1,
         "type" => $request->type
        
        
    ));
}
public function get_ordered_test_info(Request $request){
  $lab_data=LabTest::find($request->id);
  $aff=DB::table('affiliate_registrations')->where('email',$request->email)->first();
  $affiliate=DB::table('affiliate_banner')->where('affiliate_email',$request->email)->first();
  $html=ob_start();
  $user=User::where('email',$request->email)->first();
  ?>
 <h4 class="text-pink">Ordered By:</h4>
<div class="col-md-12 shadow-boxx">         
    <div class=" text-center padding-0">
        <table class="profile-info margin-bottom-10 ">
            <tbody>
                <tr>
                    <td><b>Organization Name: </b></td>
                    <td><?=$affiliate->business_name;?></td>
                </tr>
                <tr>
                    <td><b>Doctor's Name: </b></td>
                    <td> <?=$user->name;?></td>
                   
                </tr>
                <tr>
                    <td><b>Phone Number: </b></td>
                    <td><?=$affiliate->phone_no;?></td>
                </tr>
                <tr>
                    <td><b>Address: </b></td>
                    <td><?=$affiliate->address;?></td>
                </tr>
                <tr>
                    <td><b>Doctors Lic #: </b></td>
                    <td><?=$aff->licence_no;?></td>
                </tr>
               
            </tbody>
        </table>
    </div>
    <div class="clearfix"></div>
    <hr />
    <div class="col-md-12 text-center">            
        <div class="col-md-12 text-center">
              <label class="text-pink"><?=$lab_data->test_name;?></label>      
        </div>
    </div>
</div>
  <?php
  $html=ob_get_clean();
  echo $html;
    
}
public function get_completed_test_info(Request $request){
    $lab_data=LabTest::find($request->id);
    $affiliate=DB::table('affiliate_banner')->where('affiliate_email',$request->email)->first();
    $aff=DB::table('affiliate_registrations')->where('email',$request->email)->first();
    $user=User::find($lab_data->completed_by);
    
     $html=ob_start();
     ?>
     <h4 class="text-pink">Completed By:</h4>
    <div class="col-md-12 shadow-boxx">         
        <div class=" text-center padding-0">
            <table class="profile-info margin-bottom-10">
                <tbody>
                    <tr>
                        <td><b>Lab's Name: </b></td>
                        <td><?=$affiliate->business_name;?></td>
                    </tr>
                    <tr>
                        <td><b>Fill by: </b></td>
                        <td><?=$user->name;?></td>
                       
                    </tr>
                    <tr>
                        <td><b>Phone Number: </b></td>
                        <td><?=$affiliate->phone_no;?></td>
                    </tr>
                    <tr>
                        <td><b>Address: </b></td>
                        <td><?=$affiliate->address;?></td>
                    </tr>
                    <tr>
                        <td><b>Lic #: </b></td>
                        <td><?=$aff->licence_no;?></td>
                    </tr>
                   
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>
        <hr />
        <div class="col-md-12 text-center">            
            <div class="col-md-12 text-center">
                  <label class="text-pink">
                      <?php if(!empty($lab_data->uploaded_file)){ ?>
                        <a href="<?=url('download_file/'.$lab_data->id);?>" class="btn btn-xs btn-primary float-right"> <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                       <?php } ?>
                  </label>      
            </div>
        </div>
    </div>
     <?php
     $html=ob_get_clean();
     echo $html;
}
public function get_lab_test_for_laboratory(Request $request)
{
  $html=ob_start();
   ?>
     <table class="table table-striped table-bordered table-hover table1" id="sample_editable_1">
          <thead>
              <tr>
                  <th>Date/Time</th>
                  <th>Ordered By</th>               
                  <th>Test Names</th>
                  <th>Upload</th>
                  <th>Status</th>
                  <th>Action</th>
                 
              </tr>
          </thead>
<?php
     
     $last_name=$request->last_name;
     $dob=date('m/d/Y',strtotime($request->dob));
    $qry_arr = array();  
    $qry_arr[]=" t3.status IN(0,2)"; 
    if(isset($dob) && !empty($dob))
      {
          $qry_arr[]=" t2.dob LIKE '%".$dob ."%'";
         
      }
    if(isset($last_name) && !empty($last_name))
      {
          $qry_arr[]=" t2.last_name LIKE '%".$last_name ."%'";
      }
    $str_qry=" WHERE ".implode(' AND ', $qry_arr);
 $lab_records = DB::select( DB::raw("SELECT t3.* FROM users as t1 JOIN client_appointment_lists as t2 ON t2.email =t1.email JOIN lab_tests as t3 ON t3.client_id=t1.id  $str_qry order by t3.id desc") );
    if(count($lab_records) >0 ){
       foreach($lab_records as $lab)
       {
     $user=\App\User::get_user_info($lab->login_id);
        ?>
    <tr>
        <td><?=date('M,d,Y :  h:i A',strtotime($lab->created_at))?></td>
        <td><a class="get_ordered_info" data-email="<?=$user->email;?>" data-id="<?=$lab->id;?>" style="color:red"><?=$user->name?></a></td>        
        <td><?=$lab->test_name?></td>
        <td>
          <?php
          if(!empty($lab->uploaded_file))
            { ?>
          <a href="<?= url('download_file/'.$lab->id);?>" class="btn btn-xs btn-primary float-right"> <i class="fa fa-download" aria-hidden="true"></i>
          </a>
          <?php } ?>
        </td>
         <td>
        <?php 
          if($lab->status==0){ 
              ?>
            <a href="javascript:void(0);" class="btn btn-xs btn-warning">pending</a>
            <?php }elseif($lab->status==1){ ?>
             <a href="javascript:void(0);" class="btn btn-xs btn-success"  data-id="<?=$lab->id;?>" >Completed</a>
            <?php } elseif($lab->status==2){ ?>
              <a href="javascript:void(0);" class="btn btn-xs btn-primary"><?=$lab->test_nam;?> in progress</a>
          <?php  } ?>
           
        </td>
        <td>
          <?php if($lab->status==0){ ?>
            <a href="<?=url('upload-lab-test-result/'.$lab->id);?>" data-id="<?=$lab->id;?>"  class="btn btn-xs btn-info mark-as-progress22">confirm</a>
          <?php }
          elseif ($lab->status==2) {  ?>
           
            <a href="<?=url('upload-lab-test-result/'.$lab->id);?>"  class="btn btn-xs btn-info">mark as complete</a>
         <?php }else{
         } ?>
            </td>
              
                 
      
    </tr>
    <?php } 
    }else{ ?>
    <tr>
      <td class="text-center" colspan="6"> No record found</td>
    </tr>
    <?php } ?>  
    </tbody>
</table>
<?php 
   $html=ob_get_clean();
     echo $html;
}
}
