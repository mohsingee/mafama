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
// use Input;
// use PayPal\Rest\ApiContext;
// use PayPal\Auth\OAuthTokenCredential;
// use PayPal\Api\Amount;
// use PayPal\Api\Details;
// use PayPal\Api\Item;
// use PayPal\Api\ItemList;
// use PayPal\Api\Payer;
// use PayPal\Api\Payment;
// use PayPal\Api\RedirectUrls;
// use PayPal\Api\ExecutePayment;
// use PayPal\Api\PaymentExecution;
// use PayPal\Api\Transaction;
class ArchiveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
      // private $_api_context;
    public function __construct()
    {
        // $paypal_configuration = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        // $this->_api_context->setConfig($paypal_configuration['settings']);
        // $this->middleware('auth');
    }







public function total_revenue_by_month(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }

        $year = $request->year;
        $month = $request->month;
        $month_year = $year.'-'.$month;
        $revenue = DB::table('revenue_record')->where('transaction_date', 'like', '%' . $month_year . '%')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
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



public function total_expense_by_month(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }

        $year = $request->year;
        $month = $request->month;
        $month_year = $year.'-'.$month;

        $expense = DB::table('expense_record')->where('transaction_date', 'like', '%' . $month_year . '%')->where('uid', $uid)->get();
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




public function total_revenue_expense_by_month(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }

        $year = $request->year;
        $month = $request->month;
        if($month=='all')
        {
         $month_year = $year;
        }else{
          $month_year = $year.'-'.$month;
        }



        $revenue = DB::table('revenue_record')->where('transaction_date', 'like', '%' . $month_year . '%')->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
        $expense = DB::table('expense_record')->where('transaction_date', 'like', '%' . $month_year . '%')->where('uid', $uid)->get();
        echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
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
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                         <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }



        foreach ($expense as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>0</td>
                        <td>0</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';
    }







 public function get_quaterly_total_revenue(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }

        $year = $request->year;

        $month = $request->month;
        $month_year = $year."-".$month;
        $month = $request->month;
        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();

       echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
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
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->bill.'</td>
                         <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';

    }




 public function get_quaterly_total_expense(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = $request->year;
        $month = $request->month;
        $month_year = $year."-".$month;

        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
        $expense = DB::table('expense_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('uid', $uid)->get();
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



 public function get_qly_total_revenue_expense(Request $request)
    {
        //\LogActivity::addToLog('visited profile','view',Auth::user());
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $year = $request->year;

        $month = $request->month;
        $month_year = $year."-".$month;
        $month = $request->month;
        if($month=='all')
        {
          $month_year = $year."-01-01";
          $month_year3 = $year."-12-31";
        }else{
        $month_year = $year."-".$month."-01";
        $month_year3 = $year."-".str_pad(($month +3), 2, '0', STR_PAD_LEFT)."-01";
      }
        $revenue = DB::table('revenue_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('uid', $uid)->orderBy('transaction_date', 'desc')->get();
         $expense = DB::table('expense_record')->where('transaction_date', '>=', $month_year)->where('transaction_date', '<', $month_year3)->where('uid', $uid)->get();

       echo '<table class="table table-striped table-bordered table-hover" id="datatable_sample">
                <thead>
                    <tr>
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
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->bill.'</td>
                         <td>'.$value->tax.'</td>
                        <td>'.$value->shipping.'</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
         foreach ($expense as $value) {
            echo '<tr class="odd gradeX">
                        <td>'.date('d M Y', strtotime($value->transaction_date)).'</td>
                        <td>'.$value->account_description.'</td>
                        <td>'.$value->total.'</td>
                        <td>0</td>
                        <td>0</td>
                        <td>'.$value->amount_paid.'</td>
                        <td>'.$value->balance.'</td>
                    </tr>';
        }
        echo '</tbody></table>';



    }


}



?>