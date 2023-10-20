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

use Excel;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class LandingController extends Controller
{
    public function introduction_videos($user="",$code="", $language="en"){
       
        $data['video']=IntroVideo::where('language', $language)->first();
        if(!empty($user) && !empty($code)){
			
            $data['link']=$user."/".$code;
        }
        return view('landingpage',$data);
    }

}
