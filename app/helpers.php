<?php
use App\AccessMonitoring;
use App\AffiliateRegistration;
use App\AssignUser;
//use Auth;
//use Request;
use App\BusinessCategory;
use App\CmsNotification;
use App\Folders;
use App\LeadsCategory;
use App\LogActivity;
use App\Menulinks;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

function date_formate($date)
{
    return date('d F Y, g:i A', strtotime($date));
}

function get_business_category()
{
    $uid = $account = "";
    if ((Auth::user()->role) == "affiliate") {
        $uid = Auth::id();
    } else {
        $uid = Auth::user()->affiliate_user_id;
    }
    if ($uid != '') {
        $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
        $business_category = $affiliate->business_category;
        $cat = BusinessCategory::find($business_category);
        $account = $cat->category;
    }

    return $account;
}

function get_business_category_desc()
{
    $html = $desc = "";
    $category = get_business_category();
    $imgs = DB::table('upload_scripts')->where('category', $category)->get();
    $html = ob_start();
    ?>
<?php
foreach ($imgs as $img) {?>
<div class="col-md-12 hide-child  child-<?=$category?>"
    style="margin-bottom: 10px;border: 1px solid #da291c; border-radius: 3px; padding: 5px 10px;">
    <!-- <img src="<?php echo asset('public/images') ?>/<?=$img->image?>" alt="" class="script_img" style="width: 100%;" /> -->
    <a class="script_des"><?=$img->description?></a>
</div>

<?php }?>
<?php
$html = ob_get_clean();
    echo $html;
}

function get_business_category_cards()
{
    $html = $desc = "";
    $category = get_business_category();
    $imgs = DB::table('upload_cards')->where('category', $category)->get();
    $html = ob_start();
    ?>
<?php
foreach ($imgs as $img) {?>
<div class="col-md-2" style="margin-bottom: 10px;">
    <img src="<?php echo asset('public/images') ?>/<?=$img->image?>" alt="" class="card_img" />
</div>

<?php }?>
<?php
$html = ob_get_clean();
    echo $html;
}

if (!function_exists('arrondissements_by_dept')) {

    function arrondissements_by_dept($department_id)
    {

        $data = DB::table('arrondissements')->where('department_id', $department_id)->get();
        return $data;
    }
}

if (!function_exists('comunes_by_arrondissements')) {

    function comunes_by_arrondissements($arrondissement_id)
    {

        $data = DB::table('comunes')->where('arrondissement_id', $arrondissement_id)->get();
        return $data;
    }
}

if (!function_exists('getYears')) {

    function getYears()
    {

        $data = ['All', '2018', '2019', '2020', '2021', '2022'];
        return $data;
    }
}

if (!function_exists('getMonthsName')) {

    function getMonthsName()
    {

        $data = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        return $data;
    }
}

if (!function_exists('get_genealogy_users_by_paid_level')) {
    function get_genealogy_users_by_paid_level($level = "", $year, $month, $country)
    {

        $query = AffiliateRegistration::query();
        if (!empty($level)) {

            $query->where('users.level', $level);
        }
        $query->where('users.level', '!=', '');
        $users = $query->where('affiliate_registrations.type', 'free_affiliate')
            ->whereMonth('users.created_at', $month)
            ->whereYear('users.created_at', $year)
            ->join('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc')
            ->get();
        return $users;
    }
}

if (!function_exists('get_genealogy_users_monthly')) {
    function get_genealogy_users_monthly($month, $rank_id, $year, $country)
    {

        $query = AffiliateRegistration::query();
        $users = $query->where('affiliate_registrations.type', 'free_affiliate')
            ->where('affiliate_registrations.country', $country)
            ->whereMonth('users.created_at', $month)
            ->whereYear('users.created_at', $year)
            ->where('users.rank_id', $rank_id)
            ->join('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc')
            ->get();
        return $users;
    }
}
if (!function_exists('getGenealogyUserQuaterly')) {
    function getGenealogyUserQuaterly($rank_id, $start_date, $end_date, $month, $country)
    {
        $users = AffiliateRegistration::where('affiliate_registrations.type', 'free_affiliate')
            ->where('users.rank_id', $rank_id)
            ->where('affiliate_registrations.country', $country)
            ->whereMonth('users.created_at', $month)
            ->whereBetween('users.created_at', [$start_date, $end_date])
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc')->get();

        return $users;
    }
}

if (!function_exists('get_genealogy_users_by_level')) {
    function get_genealogy_users_by_level($level = "", $rank_id, $year, $month, $country)
    {
        $query = User::query();
        if (!empty($level)) {
            $query->where('users.level', $level);
        }
        $users = $query->where('users.rank_id', $rank_id)
            ->whereYear('users.created_at', $year)
            ->whereMonth('users.created_at', $month)
            ->where('affiliate_registrations.type', '!=', 'free_affiliate')
            ->leftJoin('affiliate_registrations', 'affiliate_registrations.email', '=', 'users.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc')
            ->get();
        return $users;
    }
}

if (!function_exists('getPaidAffiliates')) {
    function getPaidAffiliates($level, $year, $month, $country)
    {
        $users = AffiliateRegistration::where('affiliate_registrations.type', 'free_affiliate')
            ->where('affiliate_registrations.country', $country)
            ->where('users.level', $level)
            ->whereYear('users.created_at', $year)
            ->whereMonth('users.created_at', $month)
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('affiliate_registrations.*', 'users.show_pass', 'users.id as user_id', 'users.status as ustatus')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->count();
    }
}

if (!function_exists('getPaidAffiliatesMonthly')) {
    function getPaidAffiliatesMonthly($month, $year, $country)
    {
        $users = AffiliateRegistration::where('affiliate_registrations.type', 'free_affiliate')
            ->where('affiliate_registrations.country', $country)
            ->whereMonth('users.created_at', $month)
            ->whereYear('users.created_at', $year)
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('affiliate_registrations.*', 'users.show_pass', 'users.id as user_id', 'users.status as ustatus')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->count();
    }
}

if (!function_exists('getPaidAffiliatesQuarterly')) {
    function getPaidAffiliatesQuarterly($start_date, $end_date, $month, $country)
    {
        // echo $start_date."<br>".$end_date."<br>".$month."<br>".$country;die;
        $users = AffiliateRegistration::where('affiliate_registrations.type', 'free_affiliate')
            ->where('affiliate_registrations.country', $country)
            ->whereMonth('users.created_at', $month)
            ->whereBetween('users.created_at', [$start_date, $end_date])
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('affiliate_registrations.*', 'users.show_pass', 'users.id as user_id', 'users.status as ustatus')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->count();
    }
}

if (!function_exists('getYearlyMember')) {
    function getYearlyMember($plan_id, $level, $year, $country)
    {
        // echo $start_date."<br>".$end_date."<br>".$month."<br>".$country;die;
        $users = AffiliateRegistration::where('affiliate_registrations.country', $country)
            ->where('users.plan_id', $plan_id)
            ->where('users.level', $level)
            ->whereYear('users.created_at', $year)
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->get();
    }
}
if (!function_exists('get_monthly_member')) {
    function get_monthly_member($plan_id, $month, $year, $country)
    {
        // echo $start_date."<br>".$end_date."<br>".$month."<br>".$country;die;
        $users = AffiliateRegistration::where('affiliate_registrations.country', $country)
            ->where('users.plan_id', $plan_id)
            ->whereMonth('users.created_at', $month)
            ->whereYear('users.created_at', $year)
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->get();
    }
}
if (!function_exists('getquarterly_member')) {
    function getquarterly_member($plan_id, $start_date, $end_date, $country)
    {
        // echo $start_date."<br>".$end_date."<br>".$month."<br>".$country;die;
        $users = AffiliateRegistration::where('affiliate_registrations.country', $country)
            ->where('users.plan_id', $plan_id)
            ->whereBetween('users.created_at', [$start_date, $end_date])
        // ->whereYear('users.created_at',$year)
            ->leftJoin('users', 'users.email', '=', 'affiliate_registrations.email')
            ->select('users.*', 'affiliate_registrations.company', 'affiliate_registrations.cellphone')
            ->orderBy('affiliate_registrations.id', 'desc');
        return $users->get();
    }
}

if (!function_exists('geanologyUser')) {
    function geanologyUser($level, $plan_id)
    {
        $users = User::where(['level' => $level, 'plan_id' => $plan_id])->get();
        return $users->count();
    }
}

if (!function_exists('geanologyTotalUser')) {
    function geanologyTotalUser($level)
    {
        $users = User::where(['level' => $level])->get();
        return $users->count();
    }
}

if (!function_exists('getGeanologyUserYearly')) {
    function getGeanologyUserYearly($level, $rank_id, $year)
    {
        //$rank_id=0;
        $users = User::where(['level' => $level, 'rank_id' => $rank_id])
            ->whereYear('created_at', $year)
        // ->whereDate('created_at', Carbon::today())
            ->get();

        return $users->count();
    }
}

if (!function_exists('getMemberUserYearly')) {
    function getMemberUserYearly($level, $plan_id, $year)
    {
        //$rank_id=0;
        $users = User::where(['level' => $level, 'plan_id' => $plan_id])
            ->whereYear('created_at', $year)

            ->get();

        return $users->count();
    }
}

if (!function_exists('getGeanologyUserMonthly')) {
    function getGeanologyUserMonthly($month, $rank_id, $year, $country)
    {
        //$rank_id=0;
        $users = User::where(['rank_id' => $rank_id])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
        // ->whereDate('created_at', Carbon::today())
            ->get();
        return $users->count();
    }
}

if (!function_exists('getMemberMonthly')) {
    function getMemberMonthly($month, $plan_id, $year)
    {
        //$rank_id=0;
        $users = User::where(['plan_id' => $plan_id])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
        // ->whereDate('created_at', Carbon::today())
            ->get();
        return $users->count();
    }
}

if (!function_exists('getGeanologyUserQuarterly')) {
    function getGeanologyUserQuarterly($start_date, $end_date, $rank_id)
    {
        //$rank_id=0;
        $users = User::where(['rank_id' => $rank_id])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        return $users->count();
    }
}

if (!function_exists('getMemberQuarterly')) {
    function getMemberQuarterly($start_date, $end_date, $plan_id, $country)
    {
        //$rank_id=0;
        $users = User::where(['plan_id' => $plan_id])
            ->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        return $users->count();
    }
}

if (!function_exists('getGeanologyUserYearlyTotal')) {
    function getGeanologyUserYearlyTotal($level, $year)
    {

        $users = User::where(['level' => $level])
            ->where('rank_id', '!=', 0)
            ->whereYear('created_at', $year)
            ->get();
        return $users->count();
    }
}

if (!function_exists('getMemberUserYearlyTotal')) {
    function getMemberUserYearlyTotal($level, $year, $month, $country)
    {

        $users = User::where(['level' => $level])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();
        return $users->count();
    }
}
if (!function_exists('getGeanologyUserMonthlyTotal')) {
    function getGeanologyUserMonthlyTotal($month, $year)
    {

        $users = User::where('rank_id', '!=', 0)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
        return $users->count();
    }
}

if (!function_exists('getMemberMonthlyTotal')) {
    function getMemberMonthlyTotal($month, $year)
    {

        $users = User::where('rank_id', '!=', 0)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
        return $users->count();
    }
}

if (!function_exists('getGeanologyUserQuarterlyTotal')) {
    function getGeanologyUserQuarterlyTotal($start_date, $end_date)
    {

        $users = User::where('rank_id', '!=', 0)->whereBetween('created_at', [$start_date, $end_date])
            ->get();
        return $users->count();
    }
}

if (!function_exists('getMemberQuarterlyTotal')) {
    function getMemberQuarterlyTotal($start_date, $end_date)
    {

        $users = User::whereBetween('created_at', [$start_date, $end_date])
            ->get();
        return $users->count();
    }
}

if (!function_exists('getWeeklyGeanologyReport')) {
    function getWeeklyGeanologyReport($level, $week)
    {
        $users = User::where(['level' => $level])->whereDate('created_at', Carbon::today())->get();
        return $users->count();
    }
}

function isLinkAccess($id)
{
    if (Auth::check()) {
        $admin_per_id = Auth::user()->id;
        $user = User::where('id', $admin_per_id)->first();
        if (!empty($user)) {
            if (!empty($user->plan_id)) {
                $plan = $user->plan_id;
                $assign = Menulinks::find($id);
                if ($plan == 1) {
                    $access = $assign->affiliate_access;
                } elseif ($plan == 2) {
                    $access = $assign->enterprise_access;
                } elseif ($plan == 3) {
                    $access = $assign->gold_access;
                } elseif ($plan == 4) {
                    $access = $assign->enterprise_access;
                }

                return $access;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function get_cat_name($cat_ids)
{
    $cats = explode(',', $cat_ids);
    $da1 = array();
    foreach ($cats as $cat) {
        $da = LeadsCategory::find($cat);
        $da1[] = $da->category;
    }

    return implode(',', $da1);
}

function get_basket_name($id)
{

    $data = Folders::where('id', $id)->first();
    return $data->folder_name;
}

function total_access_user()
{

    $admin_per_id = Auth::user()->id;
    $r1 = User::where('id', $admin_per_id)->first();
    if (!empty($r1)) {

        if (!empty($r1->plan_id)) {
            $plan = $r1->plan_id;
            $assign = AssignUser::find(1);
            if ($plan == 1) {
                $total_assign_users = $assign->affiliate;
            } elseif ($plan == 2) {
                $total_assign_users = $assign->enterprises;
            } elseif ($plan == 3) {
                $total_assign_users = $assign->gold;
            } elseif ($plan == 4) {
                $total_assign_users = $assign->silver;
            }

            return $total_assign_users;
        } else {
            return 0;
        }
    } else {
        return 0;
    }

}

if (!function_exists('getCurrentWeather')) {
    // https://www.worldweatheronline.com
    function getCurrentWeather()
    {
        $ip = Request::ip();
        $lat = Session::get('latitute');
        $long = Session::get('longitude');

        if (!empty($lat) && !empty($long)) {
            $lat = round($lat, 3);
            $long = round($long, 3);
            $ip = $lat . ',' . $long;
        }
        // echo  $ip;die;
        //$ip='68.134.234.88';
        // 0172719d4b5d492b97554121210809
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.worldweatheronline.com/premium/v1/weather.ashx?q=' . $ip . '&key=bbcbce6d272a41f38d951940211311&tp=24&format=json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data1 = json_decode($response, true);
        // echo "<pre>";
        // print_r($data1['data']['error']);die;
        $data['time'] = 'NA';
        $data['temp_c'] = 'NA';
        $data['temp_f'] = 'NA';
        $data['ctime'] = 'NA';
        $data['cdate'] = date('d F Y H:i A');
        // $data['icon']='';
        $data['icon'] = 'NA';
        $data['wind'] = 'NA';
        $data['desc'] = 'NA';
        $data['pressure'] = 'NA';
        $data['humidity'] = 'NA';
        if (empty($data1['data']['error'])) {
            $data['time'] = $data1['data']['current_condition'][0]['observation_time'];
            $data['temp_c'] = $data1['data']['current_condition'][0]['temp_C'];
            $data['temp_f'] = $data1['data']['current_condition'][0]['temp_F'];
            $data['ctime'] = '';
            $data['cdate'] = date('d F Y H:i A');
            // $data['icon']=$data1['data']['current_condition'][0]['weatherIconUrl'][0]['value'];
            $data['icon'] = $data1['data']['weather'][0]['hourly'][0]['weatherIconUrl'][0]['value'];
            $data['wind'] = $data1['data']['current_condition'][0]['windspeedKmph'] . '/kmh';
            $data['desc'] = $data1['data']['current_condition'][0]['weatherDesc'][0]['value'];
            $data['pressure'] = $data1['data']['current_condition'][0]['pressure'] . ' mm';
            $data['humidity'] = $data1['data']['current_condition'][0]['humidity'];
        }
        return $data;
    }

}

if (!function_exists('get_earned_points')) {
    function get_earned_points($uid)
    {
        $data = AccessMonitoring::where('user_id', $uid)->first();
        $cnt = 0;
        if (!empty($data)) {
            $cnt = $value->earned_points;
        }
        return $cnt;
    }
}

if (!function_exists('send_unauthorize_login_alert_to_affiliate')) {
    function send_unauthorize_login_alert_to_affiliate($subject, $message = '')
    {

        $emaildetails = array('body' => $message);

        $malto = Auth::user()->affiliate_user_email;
        Mail::send('main.notification_email_template', $emaildetails, function ($message) use ($malto, $subject) {
            $message->to($malto)
                ->subject($subject);
            $message->from('support@mafama.com', Auth::user()->name);
        });
    }
}

if (!function_exists('addUserActivity')) {
    function addUserActivity($subject, $action, $notification = '', $message = '')
    {
        if (Auth::check()) {
            \LogActivity::addToLog($subject, $action, Auth::user(), $notification);
            // Notification::create([
            //     'notification'  => $notification,
            //     'uid'   => Auth::user()->id,
            // ]);
            $emaildetails = array(
                'body' => $message,
            );
            //$malto1 = 'mem2u2@yahoo.com';

            $malto = Auth::user()->email;
            Mail::send('main.notification_email_template', $emaildetails, function ($message) use ($malto, $subject) {
                $message->to($malto)
                    ->subject($subject);
                $message->from('support@mafama.com', Auth::user()->name);
            });
        }

    }
}

if (!function_exists('getPermissionPages')) {
    function getPermissionPages()
    {
        //Permission Pages
        $PerPages = array(
            "dashboard_per" => "Dashboard",
            "admininstrator_per" => "Administrator",
            "email_templates_per" => "Email Templates",
            "member_management_per" => "Member Management",
            "home_page_per" => "Home Page",
            "site_banners_per" => "Site Banners",
            "site_videos_per" => "Site Videos",
            "sign_in_popups_per" => "Sign-In-Popusps",
            "templates_per" => "Templates",
            "create_categories_per" => "Create Categories",
            "upload_to_categories_per" => "Upload To Categories",
            "condition_for_baskets_movements_per" => "Condition For Basket Movements",
            "commission_setup_per" => "Commission Setup",
            "bonus_prizes_setup_per" => "Bonus Prizes Setup",
            "affiliates_management_per" => "Affiliates Management",
            "notification_management_per" => "Notification Management",
            "reports_per" => "Reports",
            "manage_package_per" => "Manage Packeges",
            "feature_access_per" => "Feactures Acsess",
            "front_editing_per" => "Front End Editting",
            "chat_room_per" => "Chat Room",
            "countries_per" => "Countries",
            "archives_per" => "Archives",
            "forms_library_per" => "Forms Library",
            "google_analysis_per" => "Google Analysis",
            "payment_gateway_per" => "Payment Gateway",
            "smtp_setting_per" => "SMTP Setting",
            "shedule_holiday_per" => "Shedule Holiday",
            "background_color_per" => "Background Color",
            "survey_polls_per" => "Survey / Polls",
            "terms_condition_per" => "Terms And Condition",
            "test_components_per" => "Test Components",
        );
        return $PerPages;
    }
}
$dashboard_per = array("dashboard_view");

$admininstrator_per = array("admininstrator_view", "access_role", "table_of_level", "registered_affiliates", "registered_buissness", "registration_requests", "religion", "access_monitoring", "general_settings", "earning_points", "lead_qualifier_setting", "terms_and_condition", "administrator_hide_unhide_links", "restrict_of_signups", "assign_of_users", "search_and_send_sms", "search_and_send_email");
$email_templates_per = array("email_templates_view", "affiliate_email_template", "client_registration_email_template", "business_registration_email_template", "record_transaction_email_template", "minus_balance_email_template");
$member_management_per = array("member_management_view", "affiliate_management", "enterprise_management");
$home_page_per = array("home_page_views", "hide_unhide_links", "affiliates_feedback", "home_page_top_banner", "home_page_banner_for_text", "home_page_videos", "home_page_video_main");
$site_banners_per = array("site_banners_views", "settings", "appoitment", "clients_management", "emails_management", "financial_management", "archives");
$site_videos_per = array("site_videos_views", "introduction_videos", "settings_tutorial", "appoitment_tutorial", "clients_m_tutorial", "emails_m_tutorial", "financial_tutorial", "archives_tutorial");
$sign_in_popups_per = array("sign_in_popups_views", "create_category_popup", "upload_popup_business_category1", "upload_popup_buisiness_category2", "popup_settings");
$templates_per = array("templates_views", "create_client_templates_categories", "upload_client_templates", "upload_financial_templates", "upload_balancesheet_templates");
$create_categories_per = array("create_categories_views", "cards", "scripts", "business", "leads", "personalised_greetings");
$upload_to_categories_per = array("upload_to_categories_views", "upload_cards", "upload_scripts", "upload_business", "upload_leads");
$condition_for_baskets_movements_per = array("condition_for_baskets_movements_views", "leads_by_category", "basket_leads_rotation", "move_leads_to_baskets1", "move_leads_to_baskets2", "move_leads_to_baskets3", "move_leads_to_baskets4");
$commission_setup_per = array("commission_setup_views", "commission_setup_table", "affiliate_commission_setting");
$bonus_prizes_setup_per = array("bonus_prizes_setup_views", "bonus_condition_table", "bonus_pool_prize_setting", "prizes_table", "other_table");
$affiliates_management_per = array("affiliates_management_views", "network");
$notification_management_per = array("notification_management_views", "notifications", "notifications_cms");
$reports_per = array("reports_views", "bonus_income_report", "level_income_report", "prize_report", "other_report", "transactions");
$manage_package_per = array("package_views", "pricing_table", "upgrade");
$feature_access_per = array("feature_views", "affiliates", "gold", "silver", "enterprises");
$front_editing_per = array("front_editing_views", "front_settings", "front_appoitments", "front_client_management", "front_email_management", "front_financial_management", "front_archives");
$chat_room_per = array("chat_room_views", "manage_chat_rooms");
$countries_per = array("countries_views", "create_department", "upload_departments", "create_arroundissements", "upload_arroundissements", "create_communes", "upload_communes");
$archives_per = array("archives_views");
$forms_library_per = array("forms_library_views");
$google_analysis_per = array("google_analysis_views");
$payment_gateway_per = array("payment_gateway_views");
$smtp_setting_per = array("smtp_setting_views");
$shedule_holiday_per = array("shedule_holiday_views");
$background_color_per = array("background_color_views");
$survey_polls_per = array("survey_polls_views", "survey_questions", "survey_result");
$terms_condition_per = array("terms_condition_views", "upload");
$test_components_per = array("test_components_views");
if (!function_exists('permission_access')) {
    function permission_access($access)
    {
        if (Auth::check()) {
            $admin_per_id = Auth::user()->id;
            $r1 = User::where('id', $admin_per_id)->first();
            if (!empty($r1)) {

                $permit = json_decode($r1->permission1);
                // print_r($permit);die;
                if (isset($permit->$access)) {
                    return $permit->$access;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        }
    }

}
function permission_access1($access)
{
    if (Auth::check()) {
        $admin_per_id = Auth::user()->id;
        $r1 = User::where('id', $admin_per_id)->first();
        if (!empty($r1)) {
            $permit = json_decode($r1->permission);
            if (isset($permit->$access)) {
                return $permit->$access;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
function userAccess($access)
{
    if (Auth::check()) {
        $uid = "";
        if ((Auth::user()->role) == "affiliate") {
            $uid = Auth::id();
        } else {
            $uid = Auth::user()->affiliate_user_id;
        }
        
        if ($uid != '') {
            $usr = User::where('id', $uid)->first();
            $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
            if($affiliate->$access==1){
                return true;
            }else{
                return false;
            }
        }

    }
    return true;
}


if (!function_exists('getAllActionList')) {
    function getAllActionList()
    {

        $data = array(
            "1" => "Notification on login",
            "2" => "Notification on logout",
            "3" => "Appointment Booked",
            "4" => "Appointment Changed",
            "5" => "Appointment Deletion",
            "6" => "Asset Record Addition",
            "7" => "Asset Record Updation",
            "8" => "Asset Record Deletion",
            "9" => "Expense Record Addition",
            "10" => "Expense Record Update",
            "11" => "Expense Record Deletion",
            "12" => "Record Revenue Addition",
            "13" => "Record Revenue Updation",
            "14" => "Record Revenue Deletion",
            "15" => "Client Addition",
            "16" => "Client Updation",
            "17" => "Client Deletion",
            "18" => "Folder Addition",
            "19" => "Folder Updation",
            "20" => "Folder Deletion",
            "21" => "Contact Addition",
            "22" => "Contact Updation",
            "23" => "Contact Deletion",
            "24" => "File Addition",
            "25" => "File Updation",
            "26" => "File Deletion",
            "27" => "Access role Created",
            "28" => "Access role Updation",
            "29" => "Access role Deletion",
            "30" => "Lab Test Addition",
            "31" => "Lab Test status Progress",
            "32" => "Lab Test status Complete",
            "33" => "Vital-sign Addition",
            "34" => "Vital-sign Deletion",
            "35" => "Pharmacy Creation",
            "36" => "Pharmacy Updation",
            "37" => "Pharmacy Deletion",
            "38" => "Medication Addition",
            "39" => "Medication Updation",
            "40" => "Medication Deletion",
            "41" => "Email Send",
            "42" => "Sms Send",
            "43" => "Email Compaign Send",
            "44" => "Business Register",
            "45" => "Revenue Budget Creation",
            "46" => "Revenue Budget Updation",
            "47" => "Revenue Budget Deletion",
            "48" => "Expenses Budget Creation",
            "49" => "Expenses Budget Updation",
            "50" => "Expenses Budget Deletion",
            "51" => "Affiliate banner updation",
            "52" => "Birthday  Schedulded",
            "53" => "Balancssheet  created",
            "54" => "Balancssheet  updation",
            "55" => "Balancssheet deleted",
            "56" => "Appointment Setting Added",
            "57" => "Appointment Setting Updated",
            "58" => "Appointment Setting Deletion",
            "59" => "Appointment Block",
            "60" => "Appointment Email Send",
            "61" => "Holiday Addition",
            "62" => "Sales Tax Collected",
            "63" => "Delete Record",
            "64" => "Lab test released",
            "65" => "Lab test update",
            "66" => "Vital-sign updation",
            "67" => "Recommendation added",
            "68" => "Library form added",
            "69" => "Member Added",
            "70" => "Sales tax account created",
            "71" => "Shipping  Collected",
            "72" => "User Access Rights deativated",
            "73" => "User Access Rights Ativated",
            "74" => "Appointment Cancellation",
            "75" => "Library form updated",
            "76" => "Report Submitted",
            "77" => "Diagnostic Report Submitted",
            "78" => "Report status change",
            "79" => "Client task added",
            "80" => "Client task confirm",
            "81" => "Revenue account created",
            "82" => "Balancssheet account created",
            "83" => "Expense account created",
            "84" => "Survey Submitted",

        );

        return $data;
    }
}

if (!function_exists('getNotificationMessage')) {
    function getNotificationMessage($key)
    {
        $message = "";
        $noti = CmsNotification::where('action_id', $key)->first();
        if (!empty($noti)) {
            $message = $noti->message;
        }

        return $message;

    }
}

if (!function_exists('getLatLong')) {
    function getLatLong($zip)
    {
        // $ApiKey = 'AIzaSyDUOtywW8WIKZrXvMVUgfN6Kb8yUASAXIc';
        $ApiKey = 'AIzaSyDgBWvd_Vkzm2cGASKH5POBUxKnoKfWqYw';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip) . "&key=" . $ApiKey . "";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);

        if (isset($result['results'][0])) {
            $result1[] = $result['results'][0];

            $result5[] = $result1[0]['address_components'];
            $result4[] = $result1[0]['formatted_address'];
            $result2[] = $result1[0]['geometry'];
            $result3[] = $result2[0]['location'];

            $latitude = $result3[0]['lat'];
            $longitude = $result3[0]['lng'];
        } else {
            $latitude = 37.0902;
            $longitude = 95.7129;
        }

        $data = array(
            // 'geo' =>$result3[0],
            // 'caddress' =>$result4[0],
            //'pincode' =>$result5[0][0]['long_name'],
            // 'location' =>$result5[0][1]['long_name'],
            //'city' =>$result5[0][2]['long_name'],
            //'state' =>$result5[0][3]['long_name'],
            //'country' =>$result5[0][4]['long_name'],
            // 'data' =>$result5[0],
            'latitute' => $latitude,
            'longitude' => $longitude,

        );
        // echo "<pre>";
        // print_r($data);die;
        return $data;
    }
}

if (!function_exists('geolocationaddress')) {
    function geolocationaddress($lat, $long)
    {
        $geocode = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyDgBWvd_Vkzm2cGASKH5POBUxKnoKfWqYw";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $geocode);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($response);
        $dataarray = get_object_vars($output);
        if ($dataarray['status'] != 'ZERO_RESULTS' && $dataarray['status'] != 'INVALID_REQUEST') {
            if (isset($dataarray['results'][0]->formatted_address)) {

                $address = $dataarray['results'][0]->formatted_address;

            } else {
                $address = '';

            }
            if (isset($dataarray['results'][1]->address_components[0]->long_name)) {

                $pincode = $dataarray['results'][1]->address_components[0]->long_name;

            } else {
                $pincode = '';

            }
        } else {
            $address = '';
            $pincode = '';
        }

        $data = array('pincode' => $pincode, 'address' => $address);

        return $data;
    }

}

if (!function_exists('get_distance')) {
    function get_distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }
}

function showdepartmentName($id)
{
    // echo '-'.$id;die;
    $data = DB::table('departments')->where('id', $id)->first();
    return $data->department;
}

function showarrondissementName($id)
{
    $data = DB::table('arrondissements')->where('id', $id)->first();
    return $data->arrondissement;
}

function showcommuneName($id)
{
    // if (!isset($id)) {
    //     return "";
    // }

    $data = DB::table('comunes')->where('id', $id)->first();
    return $data->commune ?? '';
}
function showreligionName($id)
{
    $data = DB::table('religions')->where('id', $id)->first();
    return $data->religion ?? '';
}
function showStateName($code)
{
    $data = DB::table('state')->where('code', $code)->first();
    return $data->name ?? '';
}

function showbcat($id)
{
    $data = DB::table('business_categories')->where('id', $id)->first();
    return $data->category;
}

function totalemail($id)
{
    $data = DB::table('plans')->where('id', $id)->first();
    return $data->emailquantity;
}

function totalsms($id)
{
    $data = DB::table('plans')->where('id', $id)->first();
    return $data->emailquantity;
}

function admin_email()
{
    return 'mem2u2@yahoo.com';
}
// software developer Ravi coding start 9660813935

function getCountryName($country)
{

    $result = DB::table('country')->where('iso', $country)->first();
    return isset($result) ? $result->name : '';
}
// software developer Ravi coding end 9660813935

//ahsan aatir
function getBusinessName($email)
{
    $result = DB::table('affiliate_banner')->where('affiliate_email', $email)->first();
    if (!isset($result) || $result->business_name == '') {
        $result1 = DB::table('affiliate_registrations')->where('email', $email)->first();
        return isset($result1) ? $result1->company : '';
    } else {
        return isset($result) ? $result->business_name : '';
    }
}

function getStateName($id)
{
    $result = DB::table('state')->where('code', $id)->first();
    return isset($result) ? $result->name : '';
}