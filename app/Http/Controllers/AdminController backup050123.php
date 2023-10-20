<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rating;
use App\Menulinks;
use App\Levels;
use App\Contacts;
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
use App\EmailCampaign;
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

use App\GeneralSetting;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $topbanner = TopBanner::get();
        $topbannercount = count($topbanner);
        Session::put('topbannercount', $topbannercount);
        $textbanner = TextBanner::get();
        $textbannercount = count($textbanner);
        Session::put('textbannercount', $textbannercount);
        $homevideo = HomeVideo::get();
        $homevideocount = count($homevideo);
        Session::put('homevideocount', $homevideocount);
        $hometopvideo = HomeTopVideo::get();
        $hometopvideocount = count($hometopvideo);
        Session::put('hometopvideocount', $hometopvideocount);
        $homemainvideo = HomeMainVideo::get();
        $homemainvideocount = count($homemainvideo);
        Session::put('homemainvideocount', $homemainvideocount);
        $settingbanner = SettingBanner::get();
        $settingbannercount = count($settingbanner);
        Session::put('settingbannercount', $settingbannercount);
        $appointmentbanner = AppointmentBanner::get();
        $appointmentbannercount = count($appointmentbanner);
        Session::put('appointmentbannercount', $appointmentbannercount);
        $clientmanagementbanner = ClientManagementBanner::get();
        $clientmanagementbannercount = count($clientmanagementbanner);
        Session::put('clientmanagementbannercount', $clientmanagementbannercount);
        $emailmanagementbanner = EmailManagementBanner::get();
        $emailmanagementbannercount = count($emailmanagementbanner);
        Session::put('emailmanagementbannercount', $emailmanagementbannercount);
        $financialmanagementbanner = FinancialManagementBanner::get();
        $financialmanagementbannercount = count($financialmanagementbanner);
        Session::put('financialmanagementbannercount', $financialmanagementbannercount);
        $archivesbanner = ArchivesBanner::get();
        $archivesbannercount = count($archivesbanner);
        Session::put('archivesbannercount', $archivesbannercount);
    }
    public function rating()
    {
        $data['ratings'] = Rating::select('*')->get();
        return view('admin_ratings')->with($data);
    }
    public function hide_unhide()
    {
         if(permission_access('homepage_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

           if(permission_access('hide_links_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['settings'] = Menulinks::where('main_menu', 'Setting')->get();
        $data['appointments'] = Menulinks::where('main_menu', 'Appointment')->get();
        $data['clientmanagements'] = Menulinks::where('main_menu', 'Client Management')->get();
        $data['emailmanagements'] = Menulinks::where('main_menu', 'Email Management')->get();
        $data['financialmanagements'] = Menulinks::where('main_menu', 'Financial Management')->get();
        $data['archives'] = Menulinks::where('main_menu', 'Archives')->get();

        $flag = 0;
        foreach ($data['settings'] as $value) {
            if ($value->status == 'on') {
                $flag++;
            }
        }
        $flag2 = 0;
        foreach ($data['appointments'] as $value) {
            if ($value->status == 'on') {
                $flag2++;
            }
        }
        $flag3 = 0;
        foreach ($data['clientmanagements'] as $value) {
            if ($value->status == 'on') {
                $flag3++;
            }
        }
        $flag4 = 0;
        foreach ($data['emailmanagements'] as $value) {
            if ($value->status == 'on') {
                $flag4++;
            }
        }
        $flag5 = 0;
        foreach ($data['financialmanagements'] as $value) {
            if ($value->status == 'on') {
                $flag5++;
            }
        }
        $flag6 = 0;
        foreach ($data['archives'] as $value) {
            if ($value->status == 'on') {
                $flag6++;
            }
        }
        // $aa = count($data['settings']);
        $data['settingsstatus'] = "";
        if($flag != 0){
            $data['settingsstatus'] = "checked";
        }
        $data['appointmentstatus'] = "";
        if($flag2 != 0){
            $data['appointmentstatus'] = "checked";
        }
        $data['clientmanagemetstatus'] = "";
        if($flag3 != 0){
            $data['clientmanagemetstatus'] = "checked";
        }
        $data['emailmanagementstatus'] = "";
        if($flag4 != 0){
            $data['emailmanagementstatus'] = "checked";
        }
        $data['financialmanagementstatus'] = "";
        if($flag5 != 0){
            $data['financialmanagementstatus'] = "checked";
        }
        $data['archivesstatus'] = "";
        if($flag6 != 0){
            $data['archivesstatus'] = "checked";
        }
        // print_r($data['settingsstatus']);die();
        return view('hide_unhide')->with($data);
    }
    public function hideunhidestatus(Request $request)
    {
        $id = $request->id;
        $affected = Menulinks::where('id', $id)->update(['status' => 'on']);
    }
    public function hideunhidestatuss(Request $request)
    {
        $id = $request->id;
        $affected = Menulinks::where('id', $id)->update(['status' => 'off']);
    }
    public function allhide(Request $request)
    {
        $name = $request->id;
        if($name == "setting") {
            $menu = "Setting";
            $sub = "se";
        }
        elseif($name == "appointment") {
            $menu = "Appointment";
            $sub = "ap";
        }
        elseif($name == "clientmanagement") {
            $menu = "Client Management";
            $sub = "cm";
        }
        elseif($name == "emailmanagement") {
            $menu = "Email Management";
            $sub = "em";
        }
        elseif($name == "financialmanagement") {
            $menu = "Financial Management";
            $sub = "fm";
        }
        elseif($name == "archives") {
            $menu = "Archives";
            $sub = "ar";
        }
        $affected = Menulinks::where('main_menu', $menu)->update(['status' => 'off']);
        echo $sub;
    }
    public function allunhide(Request $request)
    {
        $name = $request->id;
        if($name == "setting") {
            $menu = "Setting";
            $sub = "se";
        }
        elseif($name == "appointment") {
            $menu = "Appointment";
            $sub = "ap";
        }
        elseif($name == "clientmanagement") {
            $menu = "Client Management";
            $sub = "cm";
        }
        elseif($name == "emailmanagement") {
            $menu = "Email Management";
            $sub = "em";
        }
        elseif($name == "financialmanagement") {
            $menu = "Financial Management";
            $sub = "fm";
        }
        elseif($name == "archives") {
            $menu = "Archives";
            $sub = "ar";
        }
        $affected = Menulinks::where('main_menu', $menu)->update(['status' => 'on']);
        echo $sub;
    }
    public function level_table()
    {
        if(permission_access('table_level_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['levels'] = Levels::select('*')->get();
        $data['status'] = DB::table('affiliatebtn')->where('id', 1)->get();
        return view('admin_level_table')->with($data);
    }
    public function levelentry(Request $request)
    {
        // print_r($request->all());die();
        $levels = Levels::create([
            'level'             => $request->level,
            'code_name'         => $request->code_name,
            'vstart_date'       => $request->vstart_date,
            'vend_date'         => $request->vend_date,
             'vstart_time'       => $request->vstart_time,
            'vend_time'         => $request->vend_time,
            'fees'              => $request->fees,
            'fees_frequency'    => $request->fees_frequency,
        ]);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function editlevelentry(Request $request)
    {
        if(permission_access('table_level_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['levels'] = Levels::where('id', $id)->get();
        return view('editlevelentry')->with($data);
    }
    public function updatelevelentry(Request $request)
    {
        $id = $request->id;
        $levels = Levels::where('id', $id)->update([
            'level'             => $request->level,
            'code_name'         => $request->code_name,
            'vstart_date'       => $request->vstart_date,
            'vend_date'         => $request->vend_date,
             'vstart_time'       => $request->vstart_time,
            'vend_time'         => $request->vend_time,
            'fees'              => $request->fees,
            'fees_frequency'    => $request->fees_frequency,
        ]);
        Session::flash('success', "Success!");
        return redirect('level_table')->with('status',"Updated successfully");
    }
    public function deletelevelentry(Request $request)
    {
        if(permission_access('table_level_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $affected = Levels::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function affiliatedisplay(Request $request)
    {
        $status = DB::table('affiliatebtn')->where('id', 1)->update(['affiliatedisplay' => $request->status]);
        echo $request->status;
    }
    public function photo_slides()
    {
        if(permission_access('homepage_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

           if(permission_access('aff_feedback_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['slides'] = PhotoSlides::select('*')->get();
        return view('photo_slides')->with($data);
    }
    public function photo_slide_entry(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/demo/people/300x300';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $PhotoSlides = PhotoSlides::create([
                    'name'      => $request->name,
                    'comment'   => $request->comment,
                    'rating'    => $request->rating,
                    'image'     => $fileNameToStore,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editphoto_slide(Request $request)
    {
        if(permission_access('aff_feedback_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['slides'] = PhotoSlides::where('id', $id)->get();
        return view('editphoto_slide')->with($data);
    }
    public function photo_slide_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/demo/people/300x300';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $PhotoSlides = PhotoSlides::where('id', $id)->update([
                    'name'      => $request->name,
                    'comment'   => $request->comment,
                    'rating'    => $request->rating,
                    'image'     => $fileNameToStore,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/photo_slides')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $PhotoSlides = PhotoSlides::where('id', $id)->update([
                    'name'      => $request->name,
                    'comment'   => $request->comment,
                    'rating'    => $request->rating,
                ]);
        }
        Session::flash('success', "Success!");
        return redirect('admin/photo_slides')->with('status',"Updated successfully");
    }
    public function deletephoto_slide(Request $request)
    {
        if(permission_access('aff_feedback_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $PhotoSlides = PhotoSlides::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function top_banner()
    {
        if(permission_access('homepage_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

         if(permission_access('top_banner_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = TopBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime')->where('id', 1)->get();
        return view('top_banner')->with($data);
    }
    public function top_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $TopBanner = TopBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $topbanner = TopBanner::get();
                $topbannercount = count($topbanner);
                Session::put('topbannercount', $topbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function edittop_banner(Request $request)
    {
        if(permission_access('top_banner_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['banners'] = TopBanner::where('id', $id)->get();
        return view('edittop_banner')->with($data);
    }
    public function top_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $TopBanner = TopBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/top_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $TopBanner = TopBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/top_banner')->with('status',"Updated successfully");
        }
    }
    public function deletetop_banner(Request $request)
    {
        if(permission_access('top_banner_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $TopBanner = TopBanner::where('id', $id)->delete();
        $topbanner = TopBanner::get();
        $topbannercount = count($topbanner);
        Session::put('topbannercount', $topbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function text_banner()
    {
        if(permission_access('homepage_banner_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = TextBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime2')->where('id', 1)->get();
        return view('text_banner')->with($data);
    }
    public function text_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $TextBanner = TextBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'text'      => $request->text,
                    'link'      => $request->link,
                    'status'    => $status,
                ]);
                $textbanner = TextBanner::get();
                $textbannercount = count($textbanner);
                Session::put('textbannercount', $textbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function edittext_banner(Request $request)
    {
         if(permission_access('homepage_banner_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = TextBanner::where('id', $id)->get();

        return view('edittext_banner')->with($data);
    }
    public function text_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($request->all());die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $TextBanner = TextBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'text'      => $request->text,
                    'link'      => $request->link,
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/text_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $TextBanner = TextBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'text'      => $request->text,
                    'link'      => $request->link,
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/text_banner')->with('status',"Updated successfully");
        }
    }
    public function deletetext_banner(Request $request)
    {
        if(permission_access('homepage_banner_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $TextBanner = TextBanner::where('id', $id)->delete();
        $textbanner = TextBanner::get();
        $textbannercount = count($textbanner);
        Session::put('textbannercount', $textbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function text_banner_paytime(Request $request)
    {
        $playtime = DB::table('carouselplaytime2')->where('id', 1)->update(['playtime' => $request->playtime*100]);
        Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Updated successfully");
    }
    public function top_banner_paytime(Request $request)
    {
        $playtime = DB::table('carouselplaytime')->where('id', 1)->update(['playtime' => $request->playtime*100]);
        Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Updated successfully");
    }
    public function banner_paytime(Request $request)
    {
        $playtime = DB::table('carouselplaytime3')->where('id', 1)->update(['playtime' => $request->playtime*100]);
        Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Updated successfully");
    }
    public function home_videos()
    {
         if(permission_access('homepage_videos_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = HomeVideo::select('*')->get();
        return view('home_videos')->with($data);
    }
    public function home_video_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeVideo = HomeVideo::create([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $homevideo = HomeVideo::get();
                $homevideocount = count($homevideo);
                Session::put('homevideocount', $homevideocount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function edithome_videos(Request $request)
    {
        if(permission_access('homepage_videos_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['videos'] = HomeVideo::select('*')->where('id', $id)->get();
        return view('edithome_videos')->with($data);
    }
    public function home_video_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeVideo = HomeVideo::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/home_videos')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $HomeVideo = HomeVideo::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/home_videos')->with('status',"Updated successfully");
        }
    }
    public function deletehome_videos(Request $request)
    {
        if(permission_access('homepage_videos_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $HomeVideo = HomeVideo::where('id', $id)->delete();
        $homevideo = HomeVideo::get();
        $homevideocount = count($homevideo);
        Session::put('homevideocount', $homevideocount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function home_top_videos()
    {
         if(permission_access('homepage_topvideos_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = HomeTopVideo::select('*')->orderBy('id', 'DESC')->get();
        return view('home_top_videos')->with($data);
    }
    public function home_top_video_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            $now = date('Y-m-d');
            if((strtotime($request->startdate) <= strtotime($now)) && (strtotime($request->enddate) >= strtotime($now)) && ($status == "on")){
                $display = "show";
            }
            else{
                $display = "hide";
            }
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeTopVideo = HomeTopVideo::create([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                    'display'   => $display,
                ]);
                $ccc = HomeTopVideo::where('display', 'show')->limit(3)->offset(2)->orderBy('id', 'DESC')->get();
                $updatej = HomeTopVIdeo::where('id', $ccc[0]->id)->update(['display' => 'hide']);
                // print_r($ccc);die();
                $hometopvideo = HomeTopVideo::get();
                $hometopvideocount = count($hometopvideo);
                Session::put('hometopvideocount', $hometopvideocount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function edithome_top_videos(Request $request)
    {
        if(permission_access('homepage_topvideos_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['videos'] = HomeTopVideo::select('*')->where('id', $id)->get();
        return view('edithome_top_videos')->with($data);
    }
    public function home_top_video_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        $disp = HomeTopVideo::where('id', $id)->get();
        if(($disp[0]->display == "show") && ($status == "off")){
            $now = date('Y-m-d');
            $ccc = HomeTopVideo::where([['display', 'hide'], ['startdate', '<=', $now], ['enddate', '>=', $now], ['status', 'on']])->orderBy('id', 'DESC')->get();
            $updatej = HomeTopVIdeo::where('id', $ccc[0]->id)->update(['display' => 'show']);
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeTopVideo = HomeTopVideo::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/home_top_videos')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $HomeTopVideo = HomeTopVideo::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/home_top_videos')->with('status',"Updated successfully");
        }
    }
    public function deletehome_top_videos(Request $request)
    {
        if(permission_access('homepage_topvideos_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $countv = HomeTopVideo::where('status', "on")->get();
        if (count($countv) == 2) {
            Session::flash('message', 'You can not delete more videos! Minimum number of videos with status "on" should be 2.');
            return redirect()->back();
        }
        else{
            $st = HomeTopVideo::where('id', $id)->get();
            if($st[0]->display == "show"){
                $countd = HomeTopVideo::where([['display', 'show'], ['status', 'on']])->get();
                if (count($countd) <= 2) {
                    Session::flash('message', 'You can not delete more videos! Minimum number of shown videos should be 2.');
                    return redirect()->back();
                }
                else{
                    $now = date('Y-m-d');
                    $ccc = HomeTopVideo::where([['display', 'hide'], ['startdate', '<=', $now], ['enddate', '>=', $now], ['status', 'on']])->orderBy('id', 'DESC')->get();
                    // echo "<pre>";
                    // print_r($ccc);die();
                    $updatej = HomeTopVIdeo::where('id', $ccc[0]->id)->update(['display' => 'show']);

                    $HomeTopVideo = HomeTopVideo::where('id', $id)->delete();
                    $hometopvideo = HomeTopVideo::get();
                    $hometopvideocount = count($hometopvideo);
                    Session::put('hometopvideocount', $hometopvideocount);
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Deleted successfully");
                }
            }
            else{
                $HomeTopVideo = HomeTopVideo::where('id', $id)->delete();
                $hometopvideo = HomeTopVideo::get();
                $hometopvideocount = count($hometopvideo);
                Session::put('hometopvideocount', $hometopvideocount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Deleted successfully");
            }
        }
    }
    public function home_main_videos()
    {
        if(permission_access('homepage_mainvideos_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = HomeMainVideo::select('*')->get();
        return view('home_main_videos')->with($data);
    }
    public function home_main_video_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeMainVideo = HomeMainVideo::create([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $homemainvideo = HomeMainVideo::get();
                $homemainvideocount = count($homemainvideo);
                Session::put('homemainvideocount', $homemainvideocount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function edithome_main_videos(Request $request)
    {
        if(permission_access('homepage_mainvideosedit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['videos'] = HomeMainVideo::select('*')->where('id', $id)->get();
        return view('edithome_main_videos')->with($data);
    }
    public function home_main_video_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $HomeMainVideo = HomeMainVideo::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/home_main_videos')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $HomeMainVideo = HomeMainVideo::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/home_main_videos')->with('status',"Updated successfully");
        }
    }
    public function deletehome_main_videos(Request $request)
    {
        if(permission_access('homepage_mainvideos_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $HomeMainVideo = HomeMainVideo::where('id', $id)->delete();
        $homemainvideo = HomeMainVideo::get();
        $homemainvideocount = count($homemainvideo);
        Session::put('homemainvideocount', $homemainvideocount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function setting_banner()
    {
         if(permission_access('settings_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = SettingBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('setting_banner')->with($data);
    }
    public function setting_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $SettingBanner = SettingBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $settingbanner = SettingBanner::get();
                $settingbannercount = count($settingbanner);
                Session::put('settingbannercount', $settingbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editsetting_banner(Request $request)
    {
        if(permission_access('settings_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = SettingBanner::where('id', $id)->get();
        return view('editsetting_banner')->with($data);
    }
    public function setting_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $SettingBanner = SettingBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/setting_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $SettingBanner = SettingBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/setting_banner')->with('status',"Updated successfully");
        }
    }
    public function deletesetting_banner(Request $request)
    {
        if(permission_access('settings_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $SettingBanner = SettingBanner::where('id', $id)->delete();
        $settingbanner = SettingBanner::get();
        $settingbannercount = count($settingbanner);
        Session::put('settingbannercount', $settingbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function appointment_banner()
    {
         if(permission_access('appointment_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = AppointmentBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('appointment_banner')->with($data);
    }
    public function appointment_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $AppointmentBanner = AppointmentBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $appointmentbanner = AppointmentBanner::get();
                $appointmentbannercount = count($appointmentbanner);
                Session::put('appointmentbannercount', $appointmentbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editappointment_banner(Request $request)
    {
        if(permission_access('appointment_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['banners'] = AppointmentBanner::where('id', $id)->get();
        return view('editappointment_banner')->with($data);
    }
    public function appointment_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $AppointmentBanner = AppointmentBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/appointment_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $AppointmentBanner = AppointmentBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/appointment_banner')->with('status',"Updated successfully");
        }
    }
    public function deleteappointment_banner(Request $request)
    {
        if(permission_access('appointment_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $AppointmentBanner = AppointmentBanner::where('id', $id)->delete();
        $appointmentbanner = AppointmentBanner::get();
        $appointmentbannercount = count($appointmentbanner);
        Session::put('appointmentbannercount', $appointmentbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function client_management_banner()
    {
          if(permission_access('clients_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = ClientManagementBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('client_management_banner')->with($data);
    }
    public function client_management_banner_entry(Request $request)
    {
        // print_r($request->all());die();
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ClientManagementBanner = ClientManagementBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $clientmanagementbanner = ClientManagementBanner::get();
                $clientmanagementbannercount = count($clientmanagementbanner);
                Session::put('clientmanagementbannercount', $clientmanagementbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editclient_management_banner(Request $request)
    {
        if(permission_access('clients_mgmt_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = ClientManagementBanner::where('id', $id)->get();
        return view('editclient_management_banner')->with($data);
    }
    public function client_management_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ClientManagementBanner = ClientManagementBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/client_management_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $ClientManagementBanner = ClientManagementBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/client_management_banner')->with('status',"Updated successfully");
        }
    }
    public function deleteclient_management_banner(Request $request)
    {
        if(permission_access('clients_mgmt_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $ClientManagementBanner = ClientManagementBanner::where('id', $id)->delete();
        $clientmanagementbanner = ClientManagementBanner::get();
        $clientmanagementbannercount = count($clientmanagementbanner);
        Session::put('clientmanagementbannercount', $clientmanagementbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function email_management_banner()
    {
         if(permission_access('emails_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = EmailManagementBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('email_management_banner')->with($data);
    }
    public function email_management_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $EmailManagementBanner = EmailManagementBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $emailmanagementbanner = EmailManagementBanner::get();
                $emailmanagementbannercount = count($emailmanagementbanner);
                Session::put('emailmanagementbannercount', $emailmanagementbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editemail_management_banner(Request $request)
    {
        if(permission_access('emails_mgmt_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = EmailManagementBanner::where('id', $id)->get();
        return view('editemail_management_banner')->with($data);
    }
    public function email_management_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $EmailManagementBanner = EmailManagementBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/email_management_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $EmailManagementBanner = EmailManagementBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/email_management_banner')->with('status',"Updated successfully");
        }
    }
    public function deleteemail_management_banner(Request $request)
    {
        if(permission_access('emails_mgmt_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $EmailManagementBanner = EmailManagementBanner::where('id', $id)->delete();
        $emailmanagementbanner = EmailManagementBanner::get();
        $emailmanagementbannercount = count($emailmanagementbanner);
        Session::put('emailmanagementbannercount', $emailmanagementbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function financial_management_banner()
    {
        if(permission_access('financial_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = FinancialManagementBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('financial_management_banner')->with($data);
    }
    public function financial_management_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $FinancialManagementBanner = FinancialManagementBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $financialmanagementbanner = FinancialManagementBanner::get();
                $financialmanagementbannercount = count($financialmanagementbanner);
                Session::put('financialmanagementbannercount', $financialmanagementbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editfinancial_management_banner(Request $request)
    {
        if(permission_access('financial_mgmt_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = FinancialManagementBanner::where('id', $id)->get();
        return view('editfinancial_management_banner')->with($data);
    }
    public function financial_management_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $FinancialManagementBanner = FinancialManagementBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/financial_management_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $FinancialManagementBanner = FinancialManagementBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/financial_management_banner')->with('status',"Updated successfully");
        }
    }
    public function deletefinancial_management_banner(Request $request)
    {

        if(permission_access('financial_mgmt_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $FinancialManagementBanner = FinancialManagementBanner::where('id', $id)->delete();
        $financialmanagementbanner = FinancialManagementBanner::get();
        $financialmanagementbannercount = count($financialmanagementbanner);
        Session::put('financialmanagementbannercount', $financialmanagementbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
        public function archives_banner()
    {
          if(permission_access('archives_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['banners'] = ArchivesBanner::select('*')->get();
        $data['playtime'] = DB::table('carouselplaytime3')->where('id', 1)->get();
        return view('archives_banner')->with($data);
    }
    public function archives_banner_entry(Request $request)
    {
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ArchivesBanner = ArchivesBanner::create([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                $archivesbanner = ArchivesBanner::get();
                $archivesbannercount = count($archivesbanner);
                Session::put('archivesbannercount', $archivesbannercount);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            return redirect()->back()->withErrors(['Please insert an image!!!']);
        }
        abort(500, 'Could not upload image :(');
    }
    public function editarchives_banner(Request $request)
    {
        if(permission_access('archives_mgmt_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['banners'] = ArchivesBanner::where('id', $id)->get();
        return view('editarchives_banner')->with($data);
    }
    public function archives_banner_update(Request $request)
    {
        $id = $request->id;
        if($request->status == "on"){
            $status = "on";
        }
        else{
            $status = "off";
        }
        // print_r($status);die();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ArchivesBanner = ArchivesBanner::where('id', $id)->update([
                    'image'     => $fileNameToStore,
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/archives_banner')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $ArchivesBanner = ArchivesBanner::where('id', $id)->update([
                    'startdate' => date('Y-m-d', strtotime($request->startdate)),
                    'enddate'   => date('Y-m-d', strtotime($request->enddate)),
                    'status'    => $status,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/archives_banner')->with('status',"Updated successfully");
        }
    }
    public function deletearchives_banner(Request $request)
    {
        if(permission_access('archives_mgmt_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $ArchivesBanner = ArchivesBanner::where('id', $id)->delete();
        $archivesbanner = ArchivesBanner::get();
        $archivesbannercount = count($archivesbanner);
        Session::put('archivesbannercount', $archivesbannercount);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function setting_tutorials()
    {
          if(permission_access('settings_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = SettingTutorial::select('*')->get();
        return view('admin_setting_tutorials')->with($data);
    }
    public function setting_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $SettingTutorial = SettingTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editsetting_tutorial(Request $request)
    {
        if(permission_access('settings_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['videos'] = SettingTutorial::select('*')->where('id', $id)->get();
        return view('editsetting_tutorial')->with($data);
    }
    public function setting_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $SettingTutorial = SettingTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);

                Session::flash('success', "Success!");
                return redirect('admin/setting_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $SettingTutorial = SettingTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/setting_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deletesetting_tutorial(Request $request)
    {
        if(permission_access('settings_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $SettingTutorial = SettingTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function appoitment_tutorials()
    {
        if(permission_access('appointment_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = AppointmentTutorial::select('*')->get();
        return view('admin_appointment_tutorials')->with($data);
    }
    public function appointment_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $AppointmentTutorial = AppointmentTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function introduction_videos($code = "")
    {
        $data['code'] = $code;
        $data['video'] = IntroVideo::where('language', $code)->first();
        return view('admin.introduction_video_upload')->with($data);
    }
    public function introduction_videos_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos/intro';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $AppointmentTutorial = IntroVideo::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }


    public function intro_video_update($code, Request $request)
    {
        $id = $request->id;
        $bottom_banner='';
         if($request->hasFile('bottom_banner'))
         {
            $file = $request->file('bottom_banner');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $bottom_banner = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'videos/intro';
            $file->move($destinationPath,$bottom_banner);


        }
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $MimeType = $file->getClientMimeType();
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'videos/intro';
            if($extension == 'mp4'){
              
            if($file->move($destinationPath,$fileNameToStore))
            {
               
                $AppointmentTutorial = IntroVideo::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'title' => $request->title,
                    'top_heading' => $request->top_heading,
                    'heading' => $request->heading,
                    'link_text' => $request->link_text,
                    'sub_heading' => $request->sub_heading,
                    'clock_duration' => $request->clock_duration,
                    'page_content' => $request->page_content,
                    'register_link' => $request->register_link,
                    'title_bar' => $request->title_bar,
                    'bottom_banner' => $bottom_banner,
                ]);
                Session::flash('success', "Success!");
                return redirect()->route('admin_introduction_videos', $code)->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
            }else{
                return redirect()->back()->with('status',"Video Extension and MIME type is not valid!");
            }
        }
        else{
            $AppointmentTutorial = IntroVideo::where('id', $id)->update([
                    'title' => $request->title,
                    'top_heading' => $request->top_heading,
                    'heading' => $request->heading,
                    'sub_heading' => $request->sub_heading,
                    'link_text' => $request->link_text,
                    'clock_duration' => $request->clock_duration,
                    'page_content' => $request->page_content,
                    'register_link' => $request->register_link,
                    'title_bar' => $request->title_bar,
                    'bottom_banner' => $bottom_banner,
                ]);
                Session::flash('success', "Success!");
                return redirect()->route('admin_introduction_videos', $code)->with('status',"Updated successfully");
        }
    }
    public function editappointment_tutorial(Request $request)
    {
        if(permission_access('appointment_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['videos'] = AppointmentTutorial::select('*')->where('id', $id)->get();
        return view('editappointment_tutorial')->with($data);
    }
    public function appointment_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $AppointmentTutorial = AppointmentTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/appoitment_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $AppointmentTutorial = AppointmentTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/appoitment_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deleteappointment_tutorial(Request $request)
    {
        if(permission_access('appointment_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $AppointmentTutorial = AppointmentTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }

  public function deleteintro_video(Request $request)
    {

        $id = $request->id;
        $AppointmentTutorial = IntroVideo::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }



    public function client_tutorials()
    {
         if(permission_access('clients_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = ClientTutorial::select('*')->get();
        return view('admin_client_tutorials')->with($data);
    }
    public function client_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ClientTutorial = ClientTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editclient_tutorial(Request $request)
    {
        if(permission_access('clients_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['videos'] = ClientTutorial::select('*')->where('id', $id)->get();
        return view('editclient_tutorial')->with($data);
    }
    public function client_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ClientTutorial = ClientTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/client_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $ClientTutorial = ClientTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/client_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deleteclient_tutorial(Request $request)
    {
        if(permission_access('clients_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $ClientTutorial = ClientTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function email_tutorials()
    {
        if(permission_access('emails_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = EmailTutorial::select('*')->get();
        return view('admin_email_tutorials')->with($data);
    }
    public function email_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $EmailTutorial = EmailTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editemail_tutorial(Request $request)
    {
        if(permission_access('emails_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['videos'] = EmailTutorial::select('*')->where('id', $id)->get();
        return view('editemail_tutorial')->with($data);
    }
    public function email_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $EmailTutorial = EmailTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/email_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $EmailTutorial = EmailTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/email_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deleteemail_tutorial(Request $request)
    {
        if(permission_access('emails_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $EmailTutorial = EmailTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function finance_tutorials()
    {
         if(permission_access('financial_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = FinanceTutorial::select('*')->get();
        return view('admin_finance_tutorials')->with($data);
    }
    public function finance_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $FinanceTutorial = FinanceTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editfinance_tutorial(Request $request)
    {
        if(permission_access('financial_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['videos'] = FinanceTutorial::select('*')->where('id', $id)->get();
        return view('editfinance_tutorial')->with($data);
    }
    public function finance_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $FinanceTutorial = FinanceTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/finance_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $FinanceTutorial = FinanceTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/finance_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deletefinance_tutorial(Request $request)
    {
        if(permission_access('financial_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $FinanceTutorial = FinanceTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function archive_tutorials()
    {
         if(permission_access('archives_tut_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['videos'] = ArchiveTutorial::select('*')->get();
        return view('admin_archive_tutorials')->with($data);
    }
    public function archive_tutorials_entry(Request $request)
    {
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ArchiveTutorial = ArchiveTutorial::create([
                    'video'     => $fileNameToStore,
                    'name'      => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function editarchive_tutorial(Request $request)
    {
        if(permission_access('archives_tut_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['videos'] = ArchiveTutorial::select('*')->where('id', $id)->get();
        return view('editarchive_tutorial')->with($data);
    }
    public function archive_tutorials_update(Request $request)
    {
        $id = $request->id;
        if($request->hasFile('video'))
        {
            $file = $request->file('video');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $ArchiveTutorial = ArchiveTutorial::where('id', $id)->update([
                    'video'     => $fileNameToStore,
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/archive_tutorials')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $ArchiveTutorial = ArchiveTutorial::where('id', $id)->update([
                    'name' => $request->name,
                ]);
                Session::flash('success', "Success!");
                return redirect('admin/archive_tutorials')->with('status',"Updated successfully");
        }
    }
    public function deletearchive_tutorial(Request $request)
    {
        if(permission_access('archives_tut_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $ArchiveTutorial = ArchiveTutorial::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function terms_conditions()
    {
        if(permission_access('terms_conditions_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $data['terms'] = TermsCondition::select('*')->get();
        return view('admin_terms_conditions')->with($data);
    }
    public function terms_conditions_entry(Request $request)
    {
        $user_type = TermsCondition::select('*')->where('user_type', $request->user_type)->get();
        if (count($user_type) > 0) {
            $data['terms'] = TermsCondition::where('id', $user_type[0]->id)->update([
                'user_type'         => $request->user_type,
                'description'       => $request->description,
            ]);
        }
        else{
            $TermsCondition = TermsCondition::create([
                        'user_type'         => $request->user_type,
                        'description'       => $request->description,
                    ]);
        }
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function editterms_condition(Request $request)
    {
        if(permission_access('terms_conditions_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['terms'] = TermsCondition::select('*')->where('id', $id)->get();
        return view('editterms_condition')->with($data);
    }
    public function terms_conditions_update(Request $request)
    {
        $id = $request->id;
        $data['terms'] = TermsCondition::where('id', $id)->update([
                'user_type'         => $request->user_type,
                'description'       => $request->description,
            ]);
        Session::flash('success', "Success!");
        return redirect('admin/terms_conditions')->with('status',"Updated successfully");
    }
    public function deleteterms_condition(Request $request)
    {
        if(permission_access('terms_conditions_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data['terms'] = TermsCondition::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function archives()
    {
        if(permission_access('archives_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['archives'] = Archives::select('*')->get();
        return view('admin_archives')->with($data);
    }
    public function archives_entry(Request $request)
    {
        $Archives = Archives::create([
                'description'       => $request->description,
            ]);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function editarchives(Request $request)
    {
        if(permission_access('archives_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['archives'] = Archives::select('*')->where('id', $id)->get();
        return view('editarchives')->with($data);
    }
    public function archives_update(Request $request)
    {
        $id = $request->id;
        $data['terms'] = Archives::where('id', $id)->update([
                'description'       => $request->description,
            ]);
        Session::flash('success', "Success!");
        return redirect('admin/archives')->with('status',"Updated successfully");
    }
    public function deletearchives(Request $request)
    {
        if(permission_access('archives_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $data = Archives::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_category_popup1()
    {
        if(permission_access('create_cat_popup_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['popups'] = Popup1::get();
        return view('admin_category_popup1')->with($data);
    }
    public function popup1_entry(Request $request)
    {
        $b_exists = Popup1::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $Popup1 = Popup1::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editpopup1(Request $request)
    {
        if(permission_access('create_cat_popup_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['popups'] = Popup1::where('id', $id)->get();
        return view('editpopup1')->with($data);
    }
    public function popup1_update(Request $request)
    {
        $id = $request->id;
        $b_exists = Popup1::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['popups'] = Popup1::where('id', $id)->update(['category' => $request->category]);
        Session::flash('success', "Success!");
        return redirect('admin_category_popup1')->with('status',"Updated successfully");
        }
    }
    public function deletepopup1(Request $request)
    {
        if(permission_access('create_cat_popup_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['popups'] = Popup1::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_category_popup2()
    {
        $data['popups'] = Popup2::get();
        return view('admin_category_popup2')->with($data);
    }
    public function popup2_entry(Request $request)
    {
        $b_exists = Popup2::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $Popup2 = Popup2::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editpopup2(Request $request)
    {
        $id = $request->id;
        $data['popups'] = Popup2::where('id', $id)->get();
        return view('editpopup2')->with($data);
    }
    public function popup2_update(Request $request)
    {
        $id = $request->id;
        $b_exists = Popup2::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['popups'] = Popup2::where('id', $id)->update(['category' => $request->category]);
            Session::flash('success', "Success!");
            return redirect('admin_category_popup2')->with('status',"Updated successfully");
        }
    }
    public function deletepopup2(Request $request)
    {
        $id = $request->id;
        $data['popups'] = Popup2::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_upload_popup1()
    {
        if(permission_access('uploadsone_popup_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['popups'] = UploadPopup1::select('*', 'upload_popup1s.id AS aid', 'upload_popup1s.category AS acategory')->join('business_categories', 'upload_popup1s.category', 'business_categories.id')->get();
        // print_r($data['popups']);die();
        $existcategory = [];
        foreach ($data['popups'] as $value) {
            array_push($existcategory, $value->category);
        }
        $data['category'] = BusinessCategory::whereNotIn('category', $existcategory)->get();
        // $data['category'] = BusinessCategory::get();
        return view('admin_upload_popup1')->with($data);
    }
    public function admin_upload_popup2()
    {
         if(permission_access('uploadstwo_popup_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['popups'] = UploadPopup2::select('*', 'upload_popup2s.id AS aid', 'upload_popup2s.category AS acategory')->join('leads_categories', 'upload_popup2s.category', 'leads_categories.id')->get();
        // print_r($data['popups']);die();
        $existcategory = [];
        foreach ($data['popups'] as $value) {
            array_push($existcategory, $value->category);
        }
        $data['category'] = DB::table('leads_categories')->whereNotIn('category', $existcategory)->get();
        return view('admin_upload_popup2')->with($data);
    }
    public function uploadpopup1_entry(Request $request)
    {
        // $b_exists = UploadPopup1::where('category','=',$request->category)->exists();
        // if($b_exists){
        //     return redirect()->back()->withErrors(['This Category already exists.']);
        // }
        // else{
        //     if($request->hasFile('image'))
        //     {
        //         $file = $request->file('image');
        //         $filenames = explode('.', $file->getClientOriginalName());
        //         $filename = $filenames[0];
        //         $extension = $file->getClientOriginalExtension();
        //         $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //         $destinationPath = 'public/images';
        //         if($file->move($destinationPath,$fileNameToStore))
        //         {
                    $UploadPopup1 = UploadPopup1::create([
                        'category'      => $request->category,
                        'description'   => $request->message,
                        'image'         => $request->img,
                        'fontcolor'     => $request->fontcolor,
                        'background'    => $request->background,
                        'preview'       => $request->preview,
                    ]);
        //             Session::flash('success', "Success!");
        //             return redirect()->back()->with('status',"Inserted successfully");
        //         }
        //         else {
        //             return redirect()->back()->with('status',"Something went wrong!!!");
        //         }
        //     }
        // }
    }
    public function uploadpopup2_entry(Request $request)
    {
        $UploadPopup2 = UploadPopup2::create([
            'category'      => $request->category,
            'description'   => $request->message,
            'image'         => $request->img,
            'fontcolor'     => $request->fontcolor,
            'background'    => $request->background,
            'preview'       => $request->preview,
        ]);
    }
    public function edituploadpopup1(Request $request)
    {
        if(permission_access('uploadsone_popup_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        // $data['category'] = Popup1::get();
        $data['popups'] = UploadPopup1::where('id', $id)->first();
        // $existcategory = [];
        // foreach ($data['popups'] as $value) {
        //     array_push($existcategory, $value->category);
        // }
        $data['category'] = BusinessCategory::where('id', $data['popups']->category)->first();
        return view('edituploadpopup1')->with($data);
    }
    public function image_update_banner(Request $request)
    {
        if($request->hasFile('img_path'))
        {
            $file = $request->file('img_path');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            // $script_category = $request->script_category;
            // $script_description = $request->script_description;
            if($file->move($destinationPath,$fileNameToStore))
            {
                echo $fileNameToStore;
            }
        }
        else{
           $UploadPopup1 = UploadPopup1::where('id', $request->id)->first();
            $fileNameToStore = $UploadPopup1->image;
            echo $fileNameToStore;
        }
    }
    public function image_update_banner2(Request $request)
    {
        if($request->hasFile('img_path'))
        {
            $file = $request->file('img_path');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/videos';
            // $script_category = $request->script_category;
            // $script_description = $request->script_description;
            if($file->move($destinationPath,$fileNameToStore))
            {
                echo $fileNameToStore;
            }
        }
        else{
           $UploadPopup2 = UploadPopup2::where('id', $request->id)->first();
            $fileNameToStore = $UploadPopup2->image;
            echo $fileNameToStore;
        }
    }
    public function uploadpopup1_update(Request $request)
    {
        // $b_exists = UploadPopup1::where('category','=',$request->category)->exists();
        // if($b_exists){
        //     return redirect()->back()->withErrors(['This Category already exists.']);
     // }
        // else{
        //     if($request->hasFile('image'))
        //     {
        //         $file = $request->file('image');
        //         $filenames = explode('.', $file->getClientOriginalName());
        //         $filename = $filenames[0];
        //         $extension = $file->getClientOriginalExtension();
        //         $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //         $destinationPath = 'public/images';
        //         if($file->move($destinationPath,$fileNameToStore))
        //         {
                    $UploadPopup1 = UploadPopup1::where('id', $request->id)->update([
                        'description'   => $request->message,
                        'image'         => $request->img,
                        'fontcolor'     => $request->fontcolor,
                        'background'    => $request->background,
                        'preview'       => $request->preview,
                    ]);
        //         }
        //         else {
        //             return redirect()->back()->with('status',"Something went wrong!!!");
        //         }
        //     }
        //     else{
        //         $UploadPopup1 = UploadPopup1::where('id', $request->id)->update([
        //                 'category'      => $request->category,
        //                 'description'   => $request->description,
        //             ]);
        //     }
        //     Session::flash('success', "Success!");
        //     return redirect('admin_upload_popup1')->with('status',"Updated successfully");
        // }
    }
    public function deleteuploadpopup1(Request $request)
    {
        if(permission_access('uploadsone_popup_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $UploadPopup1 = UploadPopup1::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function edituploadpopup2(Request $request)
    {
        if(permission_access('uploadstwo_popup_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        // $data['category'] = Popup1::get();
        $data['popups'] = UploadPopup2::where('id', $id)->first();
        // $existcategory = [];
        // foreach ($data['popups'] as $value) {
        //     array_push($existcategory, $value->category);
        // }
        $data['category'] = DB::table('leads_categories')->where('id', $data['popups']->category)->first();
        return view('edituploadpopup2')->with($data);
    }
    public function uploadpopup2_update(Request $request)
    {
        $UploadPopup1 = UploadPopup2::where('id', $request->id)->update([
            'description'   => $request->message,
            'image'         => $request->img,
            'fontcolor'     => $request->fontcolor,
            'background'    => $request->background,
            'preview'       => $request->preview,
        ]);
    }
    public function deleteuploadpopup2(Request $request)
    {
        if(permission_access('uploadstwo_popup_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $UploadPopup2 = UploadPopup2::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function create_template_category()
    {
        if(permission_access('templates_cat_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = ClientTemplateCategory::get();
        return view('create_template_category')->with($data);
    }
    public function client_template_category_entry(Request $request)
    {
        $b_exists = ClientTemplateCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $ClientTemplateCategory = ClientTemplateCategory::create([
                            'category'      => $request->category,
                        ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editclient_template_category(Request $request)
    {
        if(permission_access('templates_cat_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = ClientTemplateCategory::where('id', $id)->get();
        return view('editclient_template_category')->with($data);
    }
    public function client_template_category_update(Request $request)
    {
        $b_exists = ClientTemplateCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $ClientTemplateCategory = ClientTemplateCategory::where('id', $request->id)->update([
                            'category'      => $request->category,
                        ]);
            Session::flash('success', "Success!");
            return redirect('create_template_category')->with('status',"Updated successfully");
        }
    }
    public function deleteclient_template_category(Request $request)
    {
        if(permission_access('templates_cat_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $ClientTemplateCategory = ClientTemplateCategory::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function create_financial_template_category()
    {
        $data['categories'] = FinancialTemplateCategory::get();
        return view('create_financial_template_category')->with($data);
    }
    public function financial_template_category_entry(Request $request)
    {
        $b_exists = FinancialTemplateCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $FinancialTemplateCategory = FinancialTemplateCategory::create([
                            'category'      => $request->category,
                        ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editfinancial_template_category(Request $request)
    {
        $id = $request->id;
        $data['category'] = FinancialTemplateCategory::where('id', $id)->get();
        return view('editfinancial_template_category')->with($data);
    }
    public function financial_template_category_update(Request $request)
    {
        $b_exists = FinancialTemplateCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $FinancialTemplateCategory = FinancialTemplateCategory::where('id', $request->id)->update([
                            'category'      => $request->category,
                        ]);
            Session::flash('success', "Success!");
            return redirect('create_financial_template_category')->with('status',"Updated successfully");
        }
    }
    public function deletefinancial_template_category(Request $request)
    {
        $FinancialTemplateCategory = FinancialTemplateCategory::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_upload_template_category()
    {
         if(permission_access('templates_upload_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = ClientTemplateCategory::get();
        $data['templates'] = UploadClientTemplate::get();
        return view('admin_upload_template_category')->with($data);
    }
    public function uploadtemplate_entry(Request $request)
    {
        $b_exists = UploadClientTemplate::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $UploadClientTemplate = UploadClientTemplate::create([
                        'category'      => $request->category,
                        'description'   => $request->description,
                        'image'         => $fileNameToStore,
                    ]);
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
        }
    }
    public function edituploadtemplate(Request $request)
    {
        if(permission_access('templates_upload_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = ClientTemplateCategory::get();
        $data['templates'] = UploadClientTemplate::where('id', $id)->get();
        return view('edituploadtemplate')->with($data);
    }
    public function uploadtemplate_update(Request $request)
    {
        $b_exists = UploadClientTemplate::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $UploadClientTemplate = UploadClientTemplate::where('id', $request->id)->update([
                        'category'      => $request->category,
                        'description'   => $request->description,
                        'image'         => $fileNameToStore,
                    ]);
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
            else{
                $UploadClientTemplate = UploadClientTemplate::where('id', $request->id)->update([
                        'category'      => $request->category,
                        'description'   => $request->description,
                    ]);
            }
            Session::flash('success', "Success!");
            return redirect('admin_upload_template_category')->with('status',"Updated successfully");
        }
    }
    public function deleteuploadtemplate(Request $request)
    {
        if(permission_access('templates_upload_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $UploadClientTemplate = UploadClientTemplate::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
      public function admin_upload_financial_template_category()
    {
         if(permission_access('templates_financial_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = BusinessCategory::get();
        $data['templates'] = DB::table('revenue_account')->select('*', 'revenue_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'revenue_account.category', 'business_categories.id')->where('revenue_account.uid', Auth::id())->get();
        $data['templates2'] = DB::table('expenses_account')->select('*', 'expenses_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'expenses_account.category', 'business_categories.id')->where('expenses_account.uid', Auth::id())->get();
        return view('admin_upload_financial_template_category')->with($data);
    }
    public function admin_upload_balancesheet_template_category()
    {
         if(permission_access('templates_balancesheet_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = BusinessCategory::get();
        $data['templates'] = DB::table('balancesheet_account')->select('*', 'balancesheet_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'balancesheet_account.category', 'business_categories.id')->where(['balancesheet_account.uid'=>Auth::id(),'main_category'=>'assets'])->get();
        $data['templates2'] = DB::table('balancesheet_account')->select('*', 'balancesheet_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'balancesheet_account.category', 'business_categories.id')->where(['balancesheet_account.uid'=>Auth::id(),'main_category'=>'liability'])->get();
         $data['templates3'] = DB::table('balancesheet_account')->select('*', 'balancesheet_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'balancesheet_account.category', 'business_categories.id')->where(['balancesheet_account.uid'=>Auth::id(),'main_category'=>'equity'])->get();
         $data['templates4'] = DB::table('balancesheet_account')->select('*', 'balancesheet_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'balancesheet_account.category', 'business_categories.id')->where(['balancesheet_account.uid'=>Auth::id(),'main_category'=>'non_assets'])->get();
         $data['templates5'] = DB::table('balancesheet_account')->select('*', 'balancesheet_account.id as rid', 'business_categories.category as category_name')->join('business_categories', 'balancesheet_account.category', 'business_categories.id')->where(['balancesheet_account.uid'=>Auth::id(),'main_category'=>'non_liability'])->get();
        return view('admin.admin_upload_balancesheet_template_category')->with($data);
    }
    public function edit_upload_balancesheet_template_category($id)
    {
        if(permission_access('templates_balancesheet_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = BusinessCategory::get();
        $data['templates'] = DB::table('balancesheet_account')->where(['id'=>$id])->first();
        return view('admin.edit_upload_balancesheet_template_category')->with($data);
    }
     public function upload_balancesheet_template_entry(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'main_category' => $request->main_category,
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'date'          => date('Y-m-d'),
            'uid'           => Auth::id()
        );
        DB::table('balancesheet_account')->insert($values);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function upload_balancesheet_template_update(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'account_name'  => $request->account_name
             );
        DB::table('balancesheet_account')->where('id', $request->id)->update($values);
        return redirect('admin_upload_balancesheet_template_category')->with('status',"Updated successfully");
    }
    public function upload_financial_template_entry(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'date'          => date('Y-m-d'),
            'uid'           => Auth::id()
        );
        DB::table('revenue_account')->insert($values);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function upload_financial_template_entry2(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
            'date'          => date('Y-m-d'),
            'uid'           => Auth::id()
        );
        DB::table('expenses_account')->insert($values);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function editupload_financial_template(Request $request)
    {
        if(permission_access('templates_financial_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = BusinessCategory::get();
        $data['templates'] = DB::table('revenue_account')->where('id', $id)->first();
        return view('editupload_financial_template')->with($data);
    }
    public function editupload_financial_template2(Request $request)
    {
        if(permission_access('templates_financial_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = BusinessCategory::get();
        $data['templates'] = DB::table('expenses_account')->where('id', $id)->first();
        return view('editupload_financial_template2')->with($data);
    }
    public function upload_financial_template_update(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
        );
        DB::table('revenue_account')->where('id', $request->id)->update($values);
        return redirect('admin_upload_financial_template_category')->with('status',"Updated successfully");
    }
    public function upload_financial_template_update2(Request $request)
    {
        $values = array(
            'category'      => $request->category,
            'account_name'  => $request->account_name,
            'amount'        => $request->amount,
        );
        DB::table('expenses_account')->where('id', $request->id)->update($values);
        return redirect('admin_upload_financial_template_category')->with('status',"Updated successfully");
    }
    public function deleteupload_balancesheet_template(Request $request)
    {
        if(permission_access('templates_balancesheet_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('balancesheet_account')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function deleteupload_financial_template(Request $request)
    {
        if(permission_access('templates_financial_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('revenue_account')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function deleteupload_financial_template2(Request $request)
    {
        if(permission_access('templates_financial_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('expenses_account')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function affilates_registration()
    {
        if(permission_access('reg_affiliate_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::where('affiliate_registrations.type','affiliate')
        ->leftJoin('users','users.email','=','affiliate_registrations.email')
        ->select('affiliate_registrations.*','users.show_pass','users.id as user_id','users.status as ustatus')
        ->orderBy('affiliate_registrations.id','desc')
        ->get();
        return view('admin_affilates_registration')->with($data);
    }
     public function registered_business()
    {
         if(permission_access('reg_business_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::where('affiliate_registrations.type','free_affiliate')
        ->leftJoin('users','users.email','=','affiliate_registrations.email')
        ->select('affiliate_registrations.*','users.show_pass','users.id as user_id','users.status as ustatus')
        ->orderBy('affiliate_registrations.id','desc')
        ->get();
        return view('admin_registered_business')->with($data);
    }

     public function nonaffiliates_registration()
    {
        if(permission_access('enterprise_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::whereIn('affiliate_registrations.type',['user','free_affiliate'])
        ->leftJoin('users','users.email','=','affiliate_registrations.email')
        ->select('affiliate_registrations.*','users.show_pass','users.id as user_id','users.status as ustatus')
        ->orderBy('affiliate_registrations.id','desc')
        ->get();
        return view('admin_nonaffiliates_registration')->with($data);
    }

    public function view_nonaffiliates_registration(Request $request)
    {
        if(permission_access('enterprise_mgmt_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::where('affiliate_registrations.id', $request->id)->join('business_categories', 'affiliate_registrations.business_category', 'business_categories.id')->get();
        return view('view_nonaffiliates_registration')->with($data);
    }


    public function edit_nonaffiliates_registration(Request $request)
    {
        if(permission_access('enterprise_mgmt_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::where('id', $request->id)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        return view('edit_nonaffiliates_registration')->with($data);
    }


     public function nonaffiliates_update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
     if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/images/affiliates';
            if($file->move($destinationPath,$fileNameToStore))
            {
                //profile pic updated or not
               $check=AffiliateRegistration::where('email', $request->email)->first();


               if($check->is_profile_pic_updated == 0)
               {
                $is_profile_pic_updated=1;
               }else{
                $is_profile_pic_updated=2;
               }
                $AffiliateRegistration = AffiliateRegistration::where('email', $request->email)->update([
                  //  'code'                  => $request->code,
                    'joining_date'          => $request->joining_date,
                    'first_name'            => $request->first_name,
                    'last_name'             => $request->last_name,
                    'religion'              => $request->religion,
                    'cellphone'             => $request->cellphone,
                    'business_telephone'    => $request->business_telephone,
                    'business_category'     => $request->business_category,
                    'lead_category'         => $request->lead_category,
                    'address'               => $request->address,
                    'zip_code'              => $request->zip_code,
                    'city'                  => $request->city,
                    'state'                 => $request->state,
                    'country'               => $request->country,
                    'billing_address'       => $request->billing_address,
                    'billing_zip_code'      => $request->billing_zip_code,
                    'billing_city'          => $request->billing_city,
                    'billing_state'         => $request->billing_state,
                    'dob'               => $request->dob,
                    'billing_country'       => $request->billing_country,
                    'licence_no'       => $request->licence_no,
                    'is_profile_pic_updated' => $is_profile_pic_updated,
                    'image'                  => $fileNameToStore,
                ]);
                $User = User::where('email', $request->email)->update([
                    'name'         => $request->first_name." ".$request->last_name,
                ]);


                  \LogActivity::addToLog('profile updated','updated',Auth::user());
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $AffiliateRegistration = AffiliateRegistration::where('email', $request->email)->update([
                   // 'code'                  => $request->code,
                    'joining_date'          => $request->joining_date,
                    'first_name'            => $request->first_name,
                    'last_name'             => $request->last_name,
                    'religion'              => $request->religion,
                    'cellphone'             => $request->cellphone,
                    'business_telephone'    => $request->business_telephone,
                    'business_category'     => $request->business_category,
                    'lead_category'         => $request->lead_category,
                    'address'               => $request->address,
                    'zip_code'              => $request->zip_code,
                    'city'                  => $request->city,
                    'state'                 => $request->state,
                    'country'               => $request->country,
                    'billing_address'       => $request->billing_address,
                    'billing_zip_code'      => $request->billing_zip_code,
                    'billing_city'          => $request->billing_city,
                    'billing_state'         => $request->billing_state,
                    'billing_country'       => $request->billing_country,
                    'dob'                    => $request->dob,
                     'licence_no'       => $request->licence_no,
                ]);
                $User = User::where('email', $request->email)->update([
                    'name'         => $request->first_name." ".$request->last_name,
                ]);
               \LogActivity::addToLog('profile updated','updated',Auth::user());
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Updated successfully");
        }
    }


    public function delete_nonaffiliates_registration(Request $request){
        if(permission_access('enterprise_mgmt_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $success = false;
        $message = "";
        $url = "";
        $email=$request->email;
        $table=$request->list;

        $q1=DB::table("".$table."")->where('email', $email)->delete();
         $User = User::where('email', $request->email)->delete();
        if($q1)
        {
          $success = true;
          $message = "Record deleted  successfully";
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

     public function affiliate_users()
    {

        $data['details'] = AffiliateRegistration::where('affiliate_registrations.type','user')
        ->leftJoin('users','users.email','=','affiliate_registrations.email')
        ->select('affiliate_registrations.*','users.show_pass','users.id as user_id','users.status as ustatus')
        ->orderBy('affiliate_registrations.id','desc')
        ->get();
        return view('admin_affilates_user')->with($data);
    }
    public function add_affilates_registration()
    {
        $data['codes'] = Levels::get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        return view('add_affilates_registration')->with($data);
    }
    public function affiliate_entry(Request $request)
    {
        // print_r($request->all());
        if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images/affiliates';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $AffiliateRegistration = AffiliateRegistration::create([
                        'code'                  => $request->code,
                        'joining_date'          => $request->joining_date,
                        'password'              => Hash::make($request->password),
                        'first_name'            => $request->first_name,
                        'last_name'             => $request->last_name,
                        'religion'              => $request->religion,
                        'email'                 => $request->email,
                        'cellphone'             => $request->cellphone,
                        'business_telephone'    => $request->business_telephone,
                        'business_category'     => $request->business_category,
                        'address'               => $request->address,
                        'zip_code'              => $request->zip_code,
                        'city'                  => $request->city,
                        'state'                 => $request->state,
                        'country'               => $request->country,
                        'billing_address'       => $request->billing_address,
                        'billing_zip_code'      => $request->billing_zip_code,
                        'billing_city'          => $request->billing_city,
                        'billing_state'         => $request->billing_state,
                        'billing_country'       => $request->billing_country,
                        'image'                 => $fileNameToStore,
                    ]);
                    $User = User::create([
                        'name'         => $request->first_name." ".$request->last_name,
                        'email'        => $request->email,
                        'password'     => Hash::make($request->password),
                        'role'         => "affiliate",
                    ]);
                    $message = "You have been successfully registered. You can login now with the following details: ";
                       $emaildetails = array(
                        'name'      => $request->first_name." ".$request->last_name,
                        'email'     => $request->email,
                        'password'  => $request->password,
                        'message'   => $message
                    );
                    Mail::to($request->email)->send(new RegistrationMail($emaildetails));
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
    }
    public function codeavailability(Request $request)
    {
        $code = $request->code;
        // echo $code; die();
        $cdata = Levels::where('code_name', $code)->get();
        if (count($cdata) > 0) {
            // $ip = $request->ip();
            // $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            // $ipInfo = json_decode($ipInfo);
            // $timezone = $ipInfo->timezone;
            // date_default_timezone_set($timezone);
            $now = date('Y-m-d');
            if ($now >= $cdata[0]->vstart_date && $now <= $cdata[0]->vend_date) {
                echo "exists";
            }
            else{
                if($now < $cdata[0]->vstart_date){
                    echo $cdata[0]->vstart_date;
                }
                else{
                    echo "expired";
                }
            }
        }
        else{
            echo "fail";
        }
    }
    public function view_affilates_registration(Request $request)
    {
        if(permission_access('reg_affiliate_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['details'] = AffiliateRegistration::where('affiliate_registrations.id', $request->id)->join('business_categories', 'affiliate_registrations.business_category', 'business_categories.id')->get();
        return view('view_affilates_registration')->with($data);
    }
    public function edit_affilates_registration(Request $request)
    {
        if(permission_access('reg_affiliate_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $data['communes'] = DB::table('comunes')->get();
        $data['details'] = AffiliateRegistration::where('id', $request->id)->get();
        $data['religion'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        return view('edit_affilates_registration')->with($data);
    }
     public function affiliate_update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
        $uid = "";
        if((Auth::user()->role) == "affiliate"){
            $uid = Auth::id();
        }
        else{
            $uid = Auth::user()->affiliate_user_id;
        }
        $usr = User::where('id', $uid)->first();
        $affiliate = AffiliateRegistration::where('email', $usr->email)->first();
        $business_category =$affiliate->business_category;

       // $cat=BusinessCategory::find($request->business_category);
      //   $account=$cat->account_name;

        $exist = DB::table('revenue_record')->where('uid', $uid)->where('business_category', $business_category)->get();
         $exist1 = DB::table('expense_record')->where('uid', $uid)->where('business_category', $business_category)->get();
         if($exist->count()>0 && $business_category!=$request->business_category)
         {
          return redirect()->back()->with('status',"This business category could not be updated because  transactions are already recorded!");
         }elseif($exist->count()>0 && $business_category!=$request->business_category)
         {
           return redirect()->back()->with('status',"This business category could not be updated because  transactions are already recorded!");
         }
         else
         {

          $fileNameToStore="";
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
                //profile pic updated or not
               $check=AffiliateRegistration::where('email', $request->email)->first();


               if($check->is_profile_pic_updated == 0)
               {
                $is_profile_pic_updated=1;
               }else{
                $is_profile_pic_updated=2;
               }
                $AffiliateRegistration = AffiliateRegistration::where('email', $request->email)->update([
                  //  'code'                  => $request->code,
                    'joining_date'          => $request->joining_date,
                    'first_name'            => $request->first_name,
                    'last_name'             => $request->last_name,
                    'religion'              => $request->religion,
                    'otherreligion'         => $request->otherreligion,
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
                    'department'            => $request->selectdepartment,
                    'arrondissement'        => $request->selectarr,
                    'billing_address'       => $request->billing_address,
                    'billing_zip_code'      => $request->billing_zip_code,
                    'billing_city'          => $request->billing_city,
                    'billing_state'         => $request->billing_state,
                    'dob'               => $request->dob,
                    'billing_country'       => $request->billing_country,
                    'licence_no'       => $request->licence_no,
                    'is_profile_pic_updated' => $is_profile_pic_updated,
                    'image'                  => $fileNameToStore,
                ]);
                $User = User::where('email', $request->email)->update([
                    'name'         => $request->first_name." ".$request->last_name,
                ]);

                  \LogActivity::addToLog('profile updated','updated',Auth::user());
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Updated successfully");
             }
            // else {
            //     return redirect()->back()->with('status',"Something went wrong!!!");
            // }

        // else{
        //     $AffiliateRegistration = AffiliateRegistration::where('email', $request->email)->update([
        //            // 'code'                  => $request->code,
        //             'joining_date'          => $request->joining_date,
        //             'first_name'            => $request->first_name,
        //             'last_name'             => $request->last_name,
        //             'religion'              => $request->religion,
        //             'cellphone'             => $request->cellphone,
        //             'business_telephone'    => $request->business_telephone,
        //             'business_category'     => $request->business_category,
        //             'lead_category'         => $request->lead_category,
        //             'address'               => $request->address,
        //             'zip_code'              => $request->zip_code,
        //             'city'                  => $request->city,
        //             'state'                 => $request->state,
        //             'country'               => $request->country,
        //             'billing_address'       => $request->billing_address,
        //             'billing_zip_code'      => $request->billing_zip_code,
        //             'billing_city'          => $request->billing_city,
        //             'billing_state'         => $request->billing_state,
        //             'billing_country'       => $request->billing_country,
        //             'dob'                    => $request->dob,
        //              'licence_no'       => $request->licence_no,
        //         ]);
        //         $User = User::where('email', $request->email)->update([
        //             'name'         => $request->first_name." ".$request->last_name,
        //         ]);
        //        \LogActivity::addToLog('profile updated','updated',Auth::user());
        //     Session::flash('success', "Success!");
        //     return redirect()->back()->with('status',"Updated successfully");
        // }
    }

    public function delete_affilates_registration555(Request $request)
    {
        if(permission_access('reg_affiliate_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $AffiliateRegistration = AffiliateRegistration::where('email', $request->email)->delete();
        $User = User::where('email', $request->email)->delete();
        return redirect()->back();
    }
  public function delete_affilates_registration(Request $request){

    $success = false;
    $message = "";
    $url = "";
    $email=$request->email;
    $table=$request->list;

    $q1=DB::table("".$table."")->where('email', $email)->delete();
     $User = User::where('email', $request->email)->delete();
    if($q1)
    {
      $success = true;
      $message = "Record deleted  successfully";
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
  public function update_account_status(Request $request){

    $success = false;
    $message = "";
    $url = "";
    $uid=$request->uid;
    $status=$request->status;
    $data['status']=$status;
    $q1 = User::where('id', $request->uid)->update($data);
    if($q1)
    {
      $success = true;
      if($status==1){
        $message = "Account activated  successfully";
      }else{
        $message = "Account deactivated  successfully";
      }

    }
    else
    {
      $message = "Some problem occured please try later";
    }

    echo json_encode(array(
        "valid"=>$success,
        "url" => $url,
        "msg" => $message
    ));
    exit;
  }
    public function emailavailability(Request $request)
    {
        $email = $request->email;
        $cdata = user::where('email', $email)->get();
        if (count($cdata) > 0) {
            echo "success";
        }
        else{
            echo "fail";
        }
    }
    public function admin_religion()
    {
         if(permission_access('religion_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['religions'] = Religion::get();
        return view('admin_religion')->with($data);
    }
    public function religion_entry(Request $request)
    {
        $b_exists = Religion::where('religion','=',$request->religion)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $Religion = Religion::create([
                    'religion'  => $request->religion,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editreligion(Request $request)
    {
        if(permission_access('religion_edit')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }

        $data['religion'] = Religion::where('id', $request->id)->get();
        return view('editreligion')->with($data);
    }
    public function religion_update(Request $request)
    {
        $id = $request->id;
        $b_exists = Religion::where('religion','=',$request->religion)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data = Religion::where('id', $id)->update(['religion' => $request->religion]);
        Session::flash('success', "Success!");
        return redirect('admin_religion')->with('status',"Updated successfully");
        }
    }
    public function deletereligion(Request $request)
    {
        if(permission_access('religion_delete')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }

        $id = $request->id;
        $data = Religion::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_card_category()
    {
         if(permission_access('cards_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = CardCategory::get();
        return view('admin_card_category')->with($data);
    }
    public function card_category_entry(Request $request)
    {
        $b_exists = CardCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $card_category = CardCategory::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editcard_category(Request $request)
    {
        if(permission_access('cards_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = CardCategory::where('id', $id)->get();
        return view('editcard_category')->with($data);
    }
    public function card_category_update(Request $request)
    {
        $id = $request->id;
        $b_exists = CardCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['categories'] = CardCategory::where('id', $id)->update(['category' => $request->category]);
        Session::flash('success', "Success!");
        return redirect('admin_card_category')->with('status',"Updated successfully");
        }
    }
    public function deletecard_category(Request $request)
    {
        if(permission_access('cards_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = CardCategory::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_script_category()
    {
          if(permission_access('scripts_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = ScriptCategory::get();
        return view('admin_script_category')->with($data);
    }
    public function script_category_entry(Request $request)
    {
        $b_exists = ScriptCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $script_category = ScriptCategory::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editscript_category(Request $request)
    {
        if(permission_access('scripts_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = ScriptCategory::where('id', $id)->get();
        return view('editscript_category')->with($data);
    }
    public function script_category_update(Request $request)
    {
        $id = $request->id;
        $b_exists = ScriptCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['categories'] = ScriptCategory::where('id', $id)->update(['category' => $request->category]);
        Session::flash('success', "Success!");
        return redirect('admin_script_category')->with('status',"Updated successfully");
        }
    }
    public function deletescript_category(Request $request)
    {
        if(permission_access('scripts_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = ScriptCategory::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_business_category()
    {
        if(permission_access('business_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = BusinessCategory::get();
        return view('admin_business_category')->with($data);
    }
    public function mark_as_medical_category(Request $request)
    {
         $cat_arr=$request->cat_arr;
        $cat_arr=explode(',', $cat_arr);
         $data1['is_medical']='no';
          BusinessCategory::where('is_medical','yes')->update($data1);
        foreach ($cat_arr as $cat_id) {
            $data['is_medical']='yes';
          BusinessCategory::where('id',$cat_id)->update($data);
        }

    }
    public function business_category_entry(Request $request)
    {
        $b_exists = BusinessCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $business_category = BusinessCategory::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editbusiness_category(Request $request)
    {
        if(permission_access('business_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = BusinessCategory::where('id', $id)->get();
        return view('editbusiness_category')->with($data);
    }
    public function business_category_update(Request $request)
    {
        $id = $request->id;
        $b_exists = BusinessCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['categories'] = BusinessCategory::where('id', $id)->update(['category' => $request->category]);
        Session::flash('success', "Success!");
        return redirect('admin_business_category')->with('status',"Updated successfully");
        }
    }
    public function deletebusiness_category(Request $request)
    {
        if(permission_access('business_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = BusinessCategory::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_leads_category()
    {
         if(permission_access('leads_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['categories'] = LeadsCategory::get();
        return view('admin_leads_category')->with($data);
    }
    public function leads_category_entry(Request $request)
    {
        $b_exists = LeadsCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $leads_category = LeadsCategory::create([
                    'category'  => $request->category,
                ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        }
    }
    public function editleads_category(Request $request)
    {
        if(permission_access('leads_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = LeadsCategory::where('id', $id)->get();
        return view('editleads_category')->with($data);
    }
    public function leads_category_update(Request $request)
    {
        $id = $request->id;
        $b_exists = LeadsCategory::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            $data['categories'] = LeadsCategory::where('id', $id)->update(['category' => $request->category]);
        Session::flash('success', "Success!");
        return redirect('admin_leads_category')->with('status',"Updated successfully");
        }
    }
    public function deleteleads_category(Request $request)
    {
        if(permission_access('leads_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['categories'] = LeadsCategory::where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
     public function admin_upload_card()
    {
         if(permission_access('upload_cards_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['category'] = CardCategory::orderBy('id','asc')->get();
       $data['bcategory'] = BusinessCategory::get();
        $data['popups'] = UploadCard::orderBy('id','desc')->get();
        return view('admin_upload_card')->with($data);
    }
    public function uploadcard_entry(Request $request)
    {
        // $b_exists = UploadCard::where('category','=',$request->category)->exists();
        // if($b_exists){
        //     return redirect()->back()->withErrors(['This Category already exists.']);
        // }
        // else{
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $Uploadcard = UploadCard::create([
                        'category'      => $request->category,
                        'description'   => $request->description,
                        'image'         => $fileNameToStore,
                    ]);
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
            else {
                return redirect()->back()->withErrors(['The image is not uploaded properly.']);
            }
        // }
    }
    public function edituploadcard(Request $request)
    {
        if(permission_access('upload_cards_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = CardCategory::get();
        $data['bcategory'] = BusinessCategory::get();
        $data['popups'] = UploadCard::where('id', $id)->get();
        return view('edituploadcard')->with($data);
    }
    public function uploadcard_update(Request $request)
    {
        // if($request->category == $request->prevcat){
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $Uploadcard = UploadCard::where('id', $request->id)->update([
                        'category'      => $request->category,
                        'description'   => $request->description,
                        'image'         => $fileNameToStore,
                    ]);
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
            else{
                $Uploadcard = UploadCard::where('id', $request->id)->update([
                        'category'      => $request->category,
                        'description'   => $request->description,
                    ]);
            }
            Session::flash('success', "Success!");
            return redirect('admin_upload_card')->with('status',"Updated successfully");
        // }
        // else{
        //     $b_exists = UploadCard::where('category','=',$request->category)->exists();
        //     if($b_exists){
        //         return redirect()->back()->withErrors(['This Category already exists.']);
        //     }
        //     else{
        //         if($request->hasFile('image'))
        //         {
        //             $file = $request->file('image');
        //             $filenames = explode('.', $file->getClientOriginalName());
        //             $filename = $filenames[0];
        //             $extension = $file->getClientOriginalExtension();
        //             $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //             $destinationPath = 'public/images';
        //             if($file->move($destinationPath,$fileNameToStore))
        //             {
        //                 $Uploadcard = UploadCard::where('id', $request->id)->update([
        //                     'category'      => $request->category,
        //                     'description'   => $request->description,
        //                     'image'         => $fileNameToStore,
        //                 ]);
        //             }
        //             else {
        //                 return redirect()->back()->with('status',"Something went wrong!!!");
        //             }
        //         }
        //         else{
        //             $Uploadcard = UploadCard::where('id', $request->id)->update([
        //                     'category'      => $request->category,
        //                     'description'   => $request->description,
        //                 ]);
        //         }
        //         Session::flash('success', "Success!");
        //         return redirect('admin_upload_card')->with('status',"Updated successfully");
        //     }
        // }
    }
    public function deleteuploadcard(Request $request)
    {
        if(permission_access('upload_cards_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $Uploadcard = UploadCard::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
     public function admin_upload_script()
    {
         if(permission_access('upload_scripts_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['category'] = ScriptCategory::get();
        $data['bcategory'] = BusinessCategory::get();
        $data['popups'] = UploadScript::get();
        return view('admin_upload_script')->with($data);
    }
    public function uploadscript_entry(Request $request)
    {
        // $b_exists = UploadScript::where('category','=',$request->category)->exists();
        // if($b_exists){
        //     return redirect()->back()->withErrors(['This Category already exists.']);
        // }
        // else{
            // if($request->hasFile('image'))
            // {
            //     $file = $request->file('image');
            //     $filenames = explode('.', $file->getClientOriginalName());
            //     $filename = $filenames[0];
            //     $extension = $file->getClientOriginalExtension();
            //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //     $destinationPath = 'public/images';
            //     if($file->move($destinationPath,$fileNameToStore))
            //     {
            //         $Uploadscript = UploadScript::create([
            //             'category'      => $request->category,
            //             'description'   => $request->description,
            //             'image'         => $fileNameToStore,
            //         ]);
            //         Session::flash('success', "Success!");
            //         return redirect()->back()->with('status',"Inserted successfully");
            //     }
            //     else {
            //         return redirect()->back()->with('status',"Something went wrong!!!");
            //     }
            // }
            $Uploadscript = UploadScript::create([
                'category'      => $request->category,
                'description'   => $request->description,
            ]);
            Session::flash('success', "Success!");
            return redirect()->back()->with('status',"Inserted successfully");
        // }
    }
    public function edituploadscript(Request $request)
    {
        if(permission_access('upload_scripts_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = ScriptCategory::get();
        $data['bcategory'] = BusinessCategory::get();
        $data['popups'] = UploadScript::where('id', $id)->get();
        return view('edituploadscript')->with($data);
    }
    public function uploadscript_update(Request $request)
    {
        if($request->category == $request->prevcat){
            // if($request->hasFile('image'))
            // {
            //     $file = $request->file('image');
            //     $filenames = explode('.', $file->getClientOriginalName());
            //     $filename = $filenames[0];
            //     $extension = $file->getClientOriginalExtension();
            //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //     $destinationPath = 'public/images';
            //     if($file->move($destinationPath,$fileNameToStore))
            //     {
            //         $Uploadscript = UploadScript::where('id', $request->id)->update([
            //             'category'      => $request->category,
            //             'description'   => $request->description,
            //             'image'         => $fileNameToStore,
            //         ]);
            //     }
            //     else {
            //         return redirect()->back()->with('status',"Something went wrong!!!");
            //     }
            // }
            // else{
                $Uploadscript = UploadScript::where('id', $request->id)->update([
                        'category'      => $request->category,
                        'description'   => $request->description,
                    ]);
            // }
            Session::flash('success', "Success!");
            return redirect('admin_upload_script')->with('status',"Updated successfully");
        }
        else{
            $b_exists = UploadScript::where('category','=',$request->category)->exists();
            if($b_exists){
                return redirect()->back()->withErrors(['This Category already exists.']);
            }
            else{
                // if($request->hasFile('image'))
                // {
                //     $file = $request->file('image');
                //     $filenames = explode('.', $file->getClientOriginalName());
                //     $filename = $filenames[0];
                //     $extension = $file->getClientOriginalExtension();
                //     $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //     $destinationPath = 'public/images';
                //     if($file->move($destinationPath,$fileNameToStore))
                //     {
                //         $Uploadscript = UploadScript::where('id', $request->id)->update([
                //             'category'      => $request->category,
                //             'description'   => $request->description,
                //             'image'         => $fileNameToStore,
                //         ]);
                //     }
                //     else {
                //         return redirect()->back()->with('status',"Something went wrong!!!");
                //     }
                // }
                // else{
                    $Uploadscript = UploadScript::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                        ]);
                // }
                Session::flash('success', "Success!");
                return redirect('admin_upload_script')->with('status',"Updated successfully");
            }
        }
    }
    public function deleteuploadscript(Request $request)
    {
        if(permission_access('upload_scripts_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $Uploadscript = UploadScript::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
     public function admin_upload_business()
    {
        if(permission_access('upload_business_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['category'] = BusinessCategory::get();
        $data['popups'] = UploadBusiness::get();
        return view('admin_upload_business')->with($data);
    }
    public function uploadbusiness_entry(Request $request)
    {
        $b_exists = UploadBusiness::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $Uploadbusiness = UploadBusiness::create([
                        'category'      => $request->category,
                        'description'   => $request->description,
                        'image'         => $fileNameToStore,
                    ]);
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
        }
    }
    public function edituploadbusiness(Request $request)
    {
        if(permission_access('upload_business_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = BusinessCategory::get();
        $data['popups'] = UploadBusiness::where('id', $id)->get();
        return view('edituploadbusiness')->with($data);
    }
    public function uploadbusiness_update(Request $request)
    {
        if($request->category == $request->prevcat){
            if($request->hasFile('image'))
                {
                    $file = $request->file('image');
                    $filenames = explode('.', $file->getClientOriginalName());
                    $filename = $filenames[0];
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $destinationPath = 'public/images';
                    if($file->move($destinationPath,$fileNameToStore))
                    {
                        $Uploadbusiness = UploadBusiness::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                            'image'         => $fileNameToStore,
                        ]);
                    }
                    else {
                        return redirect()->back()->with('status',"Something went wrong!!!");
                    }
                }
                else{
                    $Uploadbusiness = UploadBusiness::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                        ]);
                }
                Session::flash('success', "Success!");
                return redirect('admin_upload_business')->with('status',"Updated successfully");
        }
        else{
            $b_exists = UploadBusiness::where('category','=',$request->category)->exists();
            if($b_exists){
                return redirect()->back()->withErrors(['This Category already exists.']);
            }
            else{
                if($request->hasFile('image'))
                {
                    $file = $request->file('image');
                    $filenames = explode('.', $file->getClientOriginalName());
                    $filename = $filenames[0];
                    $extension = $file->getClientOriginalExtension();
                    $fileNameToStore = $filename.'_'.time().'.'.$extension;
                    $destinationPath = 'public/images';
                    if($file->move($destinationPath,$fileNameToStore))
                    {
                        $Uploadbusiness = UploadBusiness::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                            'image'         => $fileNameToStore,
                        ]);
                    }
                    else {
                        return redirect()->back()->with('status',"Something went wrong!!!");
                    }
                }
                else{
                    $Uploadbusiness = UploadBusiness::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                        ]);
                }
                Session::flash('success', "Success!");
                return redirect('admin_upload_business')->with('status',"Updated successfully");
            }
        }
    }
    public function deleteuploadbusiness(Request $request)
    {
        if(permission_access('upload_business_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $Uploadbusiness = UploadBusiness::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
     public function admin_upload_leads()
    {


      //  phpinfo();die;
        if(permission_access('upload_leads_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['category'] = LeadsCategory::orderBy('id','desc')->get();
        $data['popups'] = UploadLeads::join('leads_categories', 'leads_categories.id', '=', 'upload_leads.category')
            ->select('upload_leads.*','leads_categories.category as catname')
            ->orderBy('upload_leads.id','desc')
           ->get();
        return view('admin_upload_leads')->with($data);
    }

    public function uploadleads_entry(Request $request)
    {
        $insert_data=array();
         $success=false;
        // $b_exists = UploadLeads::where('category','=',$request->category)->exists();
        // if($b_exists){
        //     return redirect()->back()->withErrors(['This Category already exists.']);
        // }
        // else{
            if($request->hasFile('select_file'))
            {
            $this->validate($request, [
                'select_file'  => 'required|mimes:xls,xlsx'
                ]);
            $path = $request->file('select_file')->getRealPath();
             $data = Excel::load($path)->get();

           //print_r($data);
           // $data=  Excel::import(new Import, $path);

          //  die;

               if($data->count() > 0)
                 {
                  $file = $request->file('select_file');
                  $filenames = explode('.', $file->getClientOriginalName());
                  $filename = $filenames[0];
                  $extension = $file->getClientOriginalExtension();
                  $fileNameToStore = $filename.'_'.time().'.'.$extension;
                  $destinationPath = 'public/excel';
                  $file->move($destinationPath,$fileNameToStore);
               //   echo "<pre>";
                //   print_r($data->toArray());die;
                  foreach($data->toArray() as $key => $row)
                  {

                  $count1=UploadLeads::where('email',$row['email'])->first();
                  if(empty($count1))
                  {
                   if(!empty($row['first_name']))
                   {
                    $full_address=$row['address'].' '.$row['city'].' '.$row['zip_code'].' '.$row['state'].' '.$row['country'];
                     $loc=getLatLong($full_address);
                     $latitute=$loc['latitute'];
                     $longitude=$loc['longitude'];

                    $insert_data[] = array(
                     'first_name'  => $row['first_name'],
                     'last_name'   => $row['last_name'],
                     'email'       => $row['email'],
                     'phone_no'    => $row['cell_phone'],
                     'address'     => $row['address'],
                     'company_name' => $row['company_name'],
                     'city'        => $row['city'],
                     'state'       => $row['state'],
                     'zipcode'     => $row['zip_code'],
                     'country'     => $row['country'],
                     'latitute'    => $latitute,
                     'longitude'   => $longitude,
                     'category'    => $request->category,
                     'description' => $request->description,
                     'path'        => $fileNameToStore,
                     'status'      =>1,

                    );
                  }
                 }

                 }
             }
              if(!empty($insert_data))
              {
                foreach ($insert_data as $Uploadleads) {

                   $Uploadleads = UploadLeads::create($Uploadleads);
                   if($Uploadleads){
                    $success=true;
                   }
                }
             }

                if($success==true)
                {

                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
      //  }
    }
    public function uploadleads_entry_old(Request $request)
    {
        $b_exists = UploadLeads::where('category','=',$request->category)->exists();
        if($b_exists){
            return redirect()->back()->withErrors(['This Category already exists.']);
        }
        else{
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $filenames = explode('.', $file->getClientOriginalName());
                $filename = $filenames[0];
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $destinationPath = 'public/images';
                if($file->move($destinationPath,$fileNameToStore))
                {
                    $Uploadleads = UploadLeads::create([
                        'category'      => $request->category,
                        'deleadsion'   => $request->deleadsion,
                        'image'         => $fileNameToStore,
                    ]);
                    Session::flash('success', "Success!");
                    return redirect()->back()->with('status',"Inserted successfully");
                }
                else {
                    return redirect()->back()->with('status',"Something went wrong!!!");
                }
            }
        }
    }
    public function edituploadleads(Request $request)
    {
        if(permission_access('leads_category_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['category'] = LeadsCategory::get();
        $data['popups'] = UploadLeads::where('id', $id)->get();
        return view('edituploadleads')->with($data);
    }
    public function uploadleads_update(Request $request)
    {
        $Uploadleads = UploadLeads::where('id', $request->id)->update([
                            'category'      => $request->category,
                            'description'   => $request->description,
                            'first_name'      => $request->first_name,
                            'last_name'      => $request->last_name,
                            'email'      => $request->email,
                            'phone_no'      => $request->phone_no,
                            'company_name'      => $request->company_name,
                            'address'      => $request->address,
                            'city'      => $request->city,
                            'state'      => $request->state,
                            'zipcode'      => $request->zipcode,
                            'country'      => $request->country,

                        ]);

        Session::flash('success', "Success!");
        $slug=str_replace (' ','-',strtolower($request->category));
        return redirect('leads-by-category/'.$slug)->with('status',"Updated successfully");
       // return redirect()->back()->with('status',"Updated successfully");


    }
    public function deleteuploadleads(Request $request)
    {
        if(permission_access('leads_category_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $Uploadleads = UploadLeads::where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function checkacode(Request $request)
    {
        $cod = AffiliateRegistration::where([['email', Auth::user()->email],['code', $request->code]])->get();
        if(count($cod) > 0){
            echo "success";
        }
        else{
            echo "fail";
        }
    }
    public function showhome_top_videos(Request $request){

        if(permission_access('homepage_topvideos_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $sstatus = HomeTopVideo::where('id', $request->id)->get();
        $status = $sstatus[0]->status;
        $cnt = HomeTopVideo::where('display', 'show')->get();
        //print_r(count($cnt));die();
        if($status == 'on'){
            $now = date('Y-m-d');
            if((strtotime($sstatus[0]->startdate) <= strtotime($now)) && (strtotime($sstatus[0]->enddate) >= strtotime($now))){
                $ccc = HomeTopVideo::where('display', 'show')->limit(2)->offset(1)->orderBy('id', 'DESC')->get();
                $updatej = HomeTopVIdeo::where('id', $ccc[0]->id)->update(['display' => 'hide']);
                $HomeTopVideo = HomeTopVideo::where('id', $request->id)->update([
                                'display'      => 'show',
                            ]);
                return redirect('admin/home_top_videos');
            }
            else{
                return redirect()->back()->with('status',"Please change the date.");
            }

        }
        else{
            return redirect()->back()->with('status',"You can't show the video when the status is 'off'.");
        }
    }
    public function hidehome_top_videos(Request $request){

        if(permission_access('homepage_topvideos_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }

        $id = $request->id;
        $cnt = HomeTopVideo::where('display', 'show')->get();
        if(count($cnt) <= 2){
                return redirect()->back()->with('status',"You can't show more than two videos!!!");
        }
        else{
            $now = date('Y-m-d');
            $ccc = HomeTopVideo::where([['display', 'hide'], ['startdate', '<=', $now], ['enddate', '>=', $now], ['status', 'on']])->orderBy('id', 'DESC')->get();
            $updatej = HomeTopVIdeo::where('id', $ccc[0]->id)->update(['display' => 'show']);

            $HomeTopVideo = HomeTopVideo::where('id', $request->id)->update([
                                'display'      => 'hide',
                            ]);

            return redirect('admin/home_top_videos');
        }
    }
    public function access_roles()
    {
         if(permission_access('roles_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        return view('access_roles');
    }
    public function add_access_roles()
    {
         if(permission_access('roles_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }


        $data['religion'] = Religion::get();
        return view('add_access_roles')->with($data);
    }
    public function restrict_signup()
    {
        return view('restrict_signup');
    }
    public function assign_users(){
        $data['list']=AssignUser::find(1);
        return view('assign_users',$data);
    }
    public function search_send_sms(){
        $data['religions'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $data['ranks']=PromotionCondition::get();
        $data['plans']=Plan::get();
        $date=date('Y-m-d');
        //$date=date('d',strtotime($date));
        $current_date = date('Y-m-d', strtotime("$date first day of this month"));
        $first_week_date=date('Y-m-d' , strtotime( "$current_date +7 day" ));
        $second_week_date=date('Y-m-d' , strtotime( "$first_week_date +7 day" ));
        $third_week_date=date('Y-m-d' , strtotime( "$second_week_date +7 day" ));
        $fourth_week_date=date('Y-m-d' , strtotime( "$third_week_date +9 day" ));
        $currentYear = Carbon::parse($date)->format('Y');
        $Q1start=Carbon::createMidnightDate($currentYear,1,1);
        $Q1end=Carbon::createMidnightDate($currentYear,3,31);
        $Q2start=Carbon::createMidnightDate($currentYear,4,1);
        $Q2end=Carbon::createMidnightDate($currentYear,6,30);
        $Q3start=Carbon::createMidnightDate($currentYear,7,1);
        $Q3end=Carbon::createMidnightDate($currentYear,9,30);
        $Q4start=Carbon::createMidnightDate($currentYear,10,1);
        $Q4end=Carbon::createMidnightDate($currentYear,12,31);


        $quarter_start = array();
        $quarter_start[]= array('start_date'=>$Q1start,'end_date'=>$Q1end);
        $quarter_start[]= array('start_date'=>$Q2start,'end_date'=>$Q2end);
        $quarter_start[]= array('start_date'=>$Q3start,'end_date'=>$Q3end);
        $quarter_start[]= array('start_date'=>$Q4start,'end_date'=>$Q4end);
        $data['quarters']=$quarter_start;

       $data['category'] = CardCategory::orderBy('category','desc')->get();
         $data['cards'] = UploadCard::groupBy('category')->get();
          $data['scripts'] = ScriptCategory::get();
        $data['greetings'] = DB::table('personalised_greeting')->get();
        $data['titles'] = EmailCampaign::orderBy('id', 'desc')
        ->groupBy('subject')
        ->get();
        $data['colors'] = DB::table('background_color')->get();
        return view('search_send_sms',$data);
    }
    public function search_send_emails()
    {
        $data['religions'] = Religion::get();
        $data['business_category'] = BusinessCategory::get();
        $data['ranks']=PromotionCondition::get();
        $data['plans']=Plan::get();
        $date=date('Y-m-d');
        //$date=date('d',strtotime($date));
        $current_date = date('Y-m-d', strtotime("$date first day of this month"));
        $first_week_date=date('Y-m-d' , strtotime( "$current_date +7 day" ));
        $second_week_date=date('Y-m-d' , strtotime( "$first_week_date +7 day" ));
        $third_week_date=date('Y-m-d' , strtotime( "$second_week_date +7 day" ));
        $fourth_week_date=date('Y-m-d' , strtotime( "$third_week_date +9 day" ));
        $currentYear = Carbon::parse($date)->format('Y');
        $Q1start=Carbon::createMidnightDate($currentYear,1,1);
        $Q1end=Carbon::createMidnightDate($currentYear,3,31);
        $Q2start=Carbon::createMidnightDate($currentYear,4,1);
        $Q2end=Carbon::createMidnightDate($currentYear,6,30);
        $Q3start=Carbon::createMidnightDate($currentYear,7,1);
        $Q3end=Carbon::createMidnightDate($currentYear,9,30);
        $Q4start=Carbon::createMidnightDate($currentYear,10,1);
        $Q4end=Carbon::createMidnightDate($currentYear,12,31);


        $quarter_start = array();
        $quarter_start[]= array('start_date'=>$Q1start,'end_date'=>$Q1end);
        $quarter_start[]= array('start_date'=>$Q2start,'end_date'=>$Q2end);
        $quarter_start[]= array('start_date'=>$Q3start,'end_date'=>$Q3end);
        $quarter_start[]= array('start_date'=>$Q4start,'end_date'=>$Q4end);
        $data['quarters']=$quarter_start;

       $data['category'] = CardCategory::orderBy('category','desc')->get();
         $data['cards'] = UploadCard::groupBy('category')->get();
          $data['scripts'] = ScriptCategory::get();
        $data['greetings'] = DB::table('personalised_greeting')->get();
        $data['titles'] = EmailCampaign::orderBy('id', 'desc')
        ->groupBy('subject')
        ->get();
        $data['colors'] = DB::table('background_color')->get();
        return view('search_send_emails',$data);
    }

    public function show_hide_links()
    {
        return view('show_hide_links');
    }
    public function basket_leads_rotation()
    {
        $data['settings']=BasketRotationSetting::where('status',1)->orderBy('id','asc')->get();
        return view('basket_leads_rotation',$data);
    }
    public function basket1_condition()
    {
     if(permission_access('move_leads_basketone_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
     $data['baskets']=BasketCondition::where(['basket_id'=>1])->orderBy('id','asc')->get();
    // print_r($data['baskets']);die;
        return view('basket1_condition',$data);
    }
    public function basket2_condition()
    {
        if(permission_access('move_leads_baskettwo_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['baskets']=BasketCondition::where(['basket_id'=>2])->orderBy('id','asc')->get();
        return view('basket2_condition',$data);
    }
    public function basket3_condition()
    {
        if(permission_access('move_leads_basketthree_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['baskets']=BasketCondition::where(['basket_id'=>3])->orderBy('id','asc')->get();
        return view('basket3_condition',$data);
    }
    public function basket4_condition()
    {
     if(permission_access('move_leads_basketfour_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['baskets']=BasketCondition::where(['basket_id'=>4])->orderBy('id','asc')->get();
        return view('basket4_condition',$data);
    }
      public function comm_table()
    {
         if(permission_access('commission_setup_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['plans']=Plan::where('status',1)->orderBy('id','asc')->get();

        $data['levels']=Level_income::where(['level_incomes.status'=>1])
         ->leftJoin('plans', 'plans.id', '=', 'level_incomes.plan_id')
         ->select('level_incomes.*','plans.name as plan_name','plans.affiliate_share_price as affiliate_price')
         ->orderBy('level_incomes.id', 'desc')->get();

        return view('comm_table',$data);
    }
    public function show_hide_bonus_pools()
    {
        return view('show_hide_bonus_pools');
    }
    public function bonus_condition_table()
    {
        return view('bonus_condition_table');
    }
    public function show_hide_prize_btn()
    {
        return view('show_hide_prize_btn');
    }
    public function change_password()
    {
        if(permission_access('change_password_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        return view('change_password');
    }
    public function manage_department()
    {
        if(permission_access('create_department_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['departments'] = DB::table('departments')->get();
        return view('manage_department')->with($data);
    }
    public function department_entry(Request $request)
    {
        if(permission_access('create_department_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $department = $request->department;
        $abbreviation = $request->abbreviation;
        $country = $request->country;
        $values = array('department' => $department,'abbreviation' => $abbreviation, 'country' => $country);
        DB::table('departments')->insert($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function delete_manage_department(Request $request)
    {
        if(permission_access('create_department_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        DB::table('departments')->where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function edit_manage_department(Request $request)
    {
        if(permission_access('create_department_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['departments'] = DB::table('departments')->where('id', $id)->get();
        return view('edit_manage_department')->with($data);
    }
    public function department_update(Request $request)
    {
        $id = $request->id;
        $department = $request->department;
        $abbreviation = $request->abbreviation;
        $country = $request->country;
        $values = array('department' => $department,'abbreviation' => $abbreviation, 'country' => $country);
        DB::table('departments')->where('id', $id)->update($values);
        Session::flash('success', "Success!");
        return redirect('manage_department')->with('status',"Updated successfully");
    }
    public function upload_department()
    {
        if(permission_access('upload_department_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['departments'] = DB::table('departments')->get();
        $data['uploads'] = DB::table('department_upload')->select('*', 'department_upload.id AS did')->join('departments', 'department_upload.department_id', 'departments.id')->get();
        return view('upload_department')->with($data);
    }
    public function department_upload_entry(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/departments';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('department_id' => $request->department_id,'image' => $fileNameToStore);
                DB::table('department_upload')->insert($values);
                Session::flash('success', "Success!");
                return redirect()->back()->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        abort(500, 'Could not upload image :(');
    }
    public function upload_department_edit(Request $request)
    {
        if(permission_access('upload_department_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        // print_r($id);die();
        $data['departments'] = DB::table('departments')->get();
        $data['uploads'] = DB::table('department_upload')->select()->where('id', $id)->get();
        // print_r($data['uploads']);die();
        return view('upload_department_edit')->with($data);
    }
    public function department_upload_update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/departments';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('department_id' => $request->department_id,'image' => $fileNameToStore);
                DB::table('department_upload')->where('id', $request->id)->update($values);
                Session::flash('success', "Success!");
                return redirect('upload_department')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $values = array('department_id' => $request->department_id);
            DB::table('department_upload')->where('id', $request->id)->update($values);
            Session::flash('success', "Success!");
            return redirect('upload_department')->with('status',"Updated successfully");
        }
    }
    public function upload_department_delete(Request $request)
    {
        if(permission_access('upload_department_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        DB::table('department_upload')->where('id', $id)->delete();
        Session::flash('success', "Success!");
            return redirect('upload_department')->with('status',"Deleted successfully");
    }
    public function arrondissements()
    {
        if(permission_access('create_arrondissements_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['departments'] = DB::table('departments')->get();
        $data['arrondissements'] = DB::table('arrondissements')->get();
        return view('arrondissements')->with($data);
    }
    public function arrondissements_entry(Request $request)
    {
        $values = array('department_id' => $request->department_id,'arrondissement' => $request->arrondissement, 'abbreviation' => $request->abbreviation);
        DB::table('arrondissements')->insert($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function arrondissements_edit(Request $request)
    {
        if(permission_access('create_arrondissements_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['departments'] = DB::table('departments')->get();
        $data['arrondissements'] = DB::table('arrondissements')->where('id', $id)->get();
        return view('arrondissements_edit')->with($data);
    }
    public function arrondissements_update(Request $request)
    {
        $values = array('department_id' => $request->department_id, 'arrondissement' => $request->arrondissement, 'abbreviation' => $request->abbreviation);
        DB::table('arrondissements')->where('id', $request->id)->update($values);
        Session::flash('success', "Success!");
        return redirect('arrondissements')->with('status',"Updated successfully");
    }
    public function arrondissements_delete(Request $request)
    {
        if(permission_access('create_arrondissements_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('arrondissements')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect('arrondissements')->with('status',"Deleted successfully");
    }
    public function upload_arrondissements()
    {
        if(permission_access('upload_arrondissements_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['arrondissements'] = DB::table('arrondissements')->get();
        $data['uploads'] = DB::table('arrondissements_upload')->select('*', 'arrondissements_upload.id AS aid')->join('arrondissements', 'arrondissements_upload.arrondissement_id', 'arrondissements.id')->get();
        return view('upload_arrondissements')->with($data);
    }
    public function arrondissements_upload_entry(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/arrondissements';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('file' => $fileNameToStore, 'arrondissement_id' => $request->arrondissement_id);
                DB::table('arrondissements_upload')->insert($values);
                Session::flash('success', "Success!");
                return redirect('upload_arrondissements')->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }

    }
    public function upload_arrondissements_edit(Request $request)
    {
        if(permission_access('upload_arrondissements_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['arrondissements'] = DB::table('arrondissements')->get();
        $data['uploads'] = DB::table('arrondissements_upload')->select()->where('id', $id)->get();
        return view('upload_arrondissements_edit')->with($data);
    }
    public function arrondissements_upload_update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/arrondissements';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('file' => $fileNameToStore, 'arrondissement_id' => $request->arrondissement_id);
                DB::table('arrondissements_upload')->where('id', $request->id)->update($values);
                Session::flash('success', "Success!");
                return redirect('upload_arrondissements')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $values = array('arrondissement_id' => $request->arrondissement_id);
            DB::table('arrondissements_upload')->where('id', $request->id)->update($values);
            Session::flash('success', "Success!");
            return redirect('upload_arrondissements')->with('status',"Updated successfully");
        }
    }
    public function upload_arrondissements_delete(Request $request)
    {
        if(permission_access('upload_arrondissements_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('arrondissements_upload')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect('upload_arrondissements')->with('status',"Deleted successfully");
    }
    public function manage_communes()
    {
        if(permission_access('create_communes_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['comunes'] = DB::table('comunes')->get();
        $data['arrondissements'] = DB::table('arrondissements')->get();
        return view('manage_communes')->with($data);
    }
    public function communes_entry(Request $request)
    {
        $values = array('commune' => $request->commune, 'abbreviation' => $request->abbreviation, 'arrondissement_id' => $request->arrondissement_id);
        DB::table('comunes')->insert($values);
        Session::flash('success', "Success!");
        return redirect('manage_communes')->with('status',"Inserted successfully");
    }
    public function manage_communes_edit(Request $request)
    {
        if(permission_access('create_communes_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['arrondissements'] = DB::table('arrondissements')->get();
        $data['comunes'] = DB::table('comunes')->select()->where('id', $id)->get();
        return view('manage_communes_edit')->with($data);
    }
    public function communes_update(Request $request)
    {
        $values = array('commune' => $request->commune, 'abbreviation' => $request->abbreviation, 'arrondissement_id' => $request->arrondissement_id);
        DB::table('comunes')->where('id', $request->id)->update($values);
        Session::flash('success', "Success!");
        return redirect('manage_communes')->with('status',"Updated successfully");
    }
    public function manage_communes_delete(Request $request)
    {
        if(permission_access('create_communes_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('comunes')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect('manage_communes')->with('status',"Deleted successfully");
    }
    public function upload_communes()
    {
        if(permission_access('upload_communes_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['comunes'] = DB::table('comunes')->get();
        $data['uploads'] = DB::table('comunes_upload')->select('*', 'comunes_upload.id AS aid')->join('comunes', 'comunes_upload.communes_id', 'comunes.id')->get();
        return view('upload_communes')->with($data);
    }
    public function communes_upload_entry(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/communes';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('image' => $fileNameToStore, 'communes_id' => $request->communes_id);
                DB::table('comunes_upload')->insert($values);
                Session::flash('success', "Success!");
                return redirect('upload_communes')->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
    }
    public function upload_communes_edit(Request $request)
    {
        if(permission_access('upload_communess_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['comunes'] = DB::table('comunes')->get();
        $data['uploads'] = DB::table('comunes_upload')->select()->where('id', $id)->get();
        return view('upload_communes_edit')->with($data);
    }
    public function communes_upload_update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/communes';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('image' => $fileNameToStore, 'communes_id' => $request->communes_id);
                DB::table('comunes_upload')->where('id', $request->id)->update($values);
                Session::flash('success', "Success!");
                return redirect('upload_communes')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $values = array('communes_id' => $request->communes_id);
            DB::table('comunes_upload')->where('id', $request->id)->update($values);
            Session::flash('success', "Success!");
            return redirect('upload_communes')->with('status',"Updated successfully");
        }
    }
    public function upload_communes_delete(Request $request)
    {
        if(permission_access('upload_communes_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('comunes_upload')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect('upload_communes')->with('status',"Deleted successfully");
    }
    public function chat_room()
    {
        if(permission_access('chat_rooms_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
         $data['attachments'] = Chat::whereNull('video_link')->whereNotNull('attachment')->where('from_user_id',Auth::id())->get();
        $data['videos'] = Chat::whereNull('attachment')->whereNotNull('video_link')->where('from_user_id',Auth::id())->get();
        return view('chat_room',$data);
    }
    public function manage_blog()
    {
        $data['blogs'] = DB::table('blogs')->get();
        return view('manage_blog')->with($data);
    }
    public function blog_entry(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/blogs';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('image' => $fileNameToStore, 'title' => $request->title, 'description' => $request->description);
                DB::table('blogs')->insert($values);
                Session::flash('success', "Success!");
                return redirect('manage_blog')->with('status',"Inserted successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
    }
    public function manage_blog_edit(Request $request)
    {
        $data['blog'] = DB::table('blogs')->where('id', $request->id)->get();
        return view('manage_blog_edit')->with($data);
    }
    public function blog_update(Request $request)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filenames = explode('.', $file->getClientOriginalName());
            $filename = $filenames[0];
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $destinationPath = 'public/assets/images/blogs';
            if($file->move($destinationPath,$fileNameToStore))
            {
                $values = array('image' => $fileNameToStore, 'title' => $request->title, 'description' => $request->description);
                DB::table('blogs')->where('id', $request->id)->update($values);
                Session::flash('success', "Success!");
                return redirect('manage_blog')->with('status',"Updated successfully");
            }
            else {
                return redirect()->back()->with('status',"Something went wrong!!!");
            }
        }
        else{
            $values = array('title' => $request->title, 'description' => $request->description);
            DB::table('blogs')->where('id', $request->id)->update($values);
            Session::flash('success', "Success!");
            return redirect('manage_blog')->with('status',"Updated successfully");
        }
    }
    public function manage_blog_delete(Request $request)
    {
        DB::table('blogs')->where('id', $request->id)->delete();
            Session::flash('success', "Success!");
            return redirect('manage_blog')->with('status',"Deleted successfully");
    }
    public function setting_front()
    {
        return view('setting_front');
    }
    public function appointment_front()
    {
        return view('appointment_front');
    }
    public function client_mgmt_front()
    {
        return view('client_mgmt_front');
    }
    public function email_mgmt_front()
    {
        return view('email_mgmt_front');
    }
    public function financial_mgmt_front()
    {
        return view('financial_mgmt_front');
    }
    public function archives_front()
    {
        return view('archives_front');
    }
    public function affilate_features_access()
    {
        return view('affilate_features_access');
    }
    public function gold_features_access()
    {
        return view('gold_features_access');
    }
    public function sliver_features_access()
    {
        return view('sliver_features_access');
    }
    public function enterprises_feature_access()
    {
        return view('enterprises_feature_access');
    }
    public function pricing_table()
    {
        $data['appointments']=Menulinks::where('main_menu','Appointment')->orderBy('menu','asc')->get();
        $data['client_menus']=Menulinks::where('main_menu','Client Management')->orderBy('menu','asc')->get();
        $data['email_menus']=Menulinks::where('main_menu','Email Management')->orderBy('menu','asc')->get();
        $data['finance_menus']=Menulinks::where('main_menu','Financial Management')->orderBy('menu','asc')->get();
        $data['archive_menus']=Menulinks::where('main_menu','Archives')->orderBy('menu','asc')->get();
        $data['setting_menus']=Menulinks::where('main_menu','Setting')->orderBy('menu','asc')->get();
        $plans=Plan::where('status',1)->get();
        $data['gold_plan']=$plans[2]->name;
        $data['silver_plan']=$plans[3]->name;
        $data['enterprise_plan']=$plans[2]->name;
        return view('pricing_table',$data);
    }
    public function upgarde_package()
    {
        return view('upgarde_package');
    }
    public function affiliates_promotion_condition()
    {

        $data['lists']=PromotionCondition::get();
        return view('affiliates_promotion_condition',$data);
    }


    public function genealogy_report()
    {
        $data['ranks']=PromotionCondition::orderBy('id','asc')->get();
        $data['plans']=Plan::orderBy('id','desc')->get();
        $date=date('Y-m-d');
        //$date=date('d',strtotime($date));
        $current_date = date('Y-m-d', strtotime("$date first day of this month"));
        $first_week_date=date('Y-m-d' , strtotime( "$current_date +7 day" ));
        $second_week_date=date('Y-m-d' , strtotime( "$first_week_date +7 day" ));
        $third_week_date=date('Y-m-d' , strtotime( "$second_week_date +7 day" ));
        $fourth_week_date=date('Y-m-d' , strtotime( "$third_week_date +9 day" ));
        $currentYear = Carbon::parse($date)->format('Y');
        $Q1start=Carbon::createMidnightDate($currentYear,1,1);
        $Q1end=Carbon::createMidnightDate($currentYear,3,31);
        $Q2start=Carbon::createMidnightDate($currentYear,4,1);
        $Q2end=Carbon::createMidnightDate($currentYear,6,30);
        $Q3start=Carbon::createMidnightDate($currentYear,7,1);
        $Q3end=Carbon::createMidnightDate($currentYear,9,30);
        $Q4start=Carbon::createMidnightDate($currentYear,10,1);
        $Q4end=Carbon::createMidnightDate($currentYear,12,31);


        $quarter_start = array();
        $quarter_start[]= array('start_date'=>$Q1start,'end_date'=>$Q1end);
        $quarter_start[]= array('start_date'=>$Q2start,'end_date'=>$Q2end);
        $quarter_start[]= array('start_date'=>$Q3start,'end_date'=>$Q3end);
        $quarter_start[]= array('start_date'=>$Q4start,'end_date'=>$Q4end);
        $data['quarters']=$quarter_start;

       $data['category'] = CardCategory::orderBy('category','desc')->get();
         $data['cards'] = UploadCard::groupBy('category')->get();
          $data['scripts'] = ScriptCategory::get();
        $data['greetings'] = DB::table('personalised_greeting')->get();
        $data['titles'] = EmailCampaign::orderBy('id', 'desc')
        ->groupBy('subject')
        ->get();
        $data['colors'] = DB::table('background_color')->get();
        return view('admin.report.genealogy_report',$data);
    }
    public function performance_report()
    {
        return view('performance_report');
    }
    public function qualification_report()
    {
        return view('qualification_report');
    }
    public function reconciliation_report()
    {
        return view('reconciliation_report');
    }
    public function comission_report()
    {
        return view('comission_report');
    }
    public function comprehensive_report()
    {
        return view('comprehensive_report');
    }
    public function move_baskets()
    {
        return view('move_baskets');
    }
    public function enterprise_mgmt()
    {
        return view('enterprise_mgmt');
    }
    public function enterprise_profile()
    {
        return view('enterprise_profile');
    }
    public function showhome_photoslide(Request $request)
    {
        if(permission_access('aff_feedback_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('photo_slides')->where('id', $request->id)->update(['status' => 'active']);
        return redirect()->back();
    }
    public function hidehome_photoslide(Request $request)
    {
        if(permission_access('aff_feedback_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('photo_slides')->where('id', $request->id)->update(['status' => 'deactive']);
        return redirect()->back();
    }
    public function admin_personalised_greeting()
    {
        if(permission_access('greetings_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['greetings'] = DB::table('personalised_greeting')->get();
        return view('admin_personalised_greeting')->with($data);
    }
    public function personalised_greeting_entry(Request $request)
    {
        $values = array('greetings' => $request->greetings);
        DB::table('personalised_greeting')->insert($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function delete_personalised_greeting(Request $request)
    {
        if(permission_access('greetings_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        DB::table('personalised_greeting')->where('id', $request->id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }
    public function admin_schedule_holiday()
    {
        if(permission_access('schedule_holiday_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['holidays'] = DB::table('holiday')->get();
        return view('admin_schedule_holiday')->with($data);
    }
    public function holiday_entry(Request $request)
    {
        $holiday = $request->holiday;
        $date = explode('-', $request->date);
        $year = $date[0];
        $month = $date[1];
        $day = $date[2];
        $values = array(
            'holiday'   => $holiday,
            'year'      => $year,
            'month'     => $month,
            'day'       => $day,
            'date'      => $request->date,
        );
        DB::table('holiday')->insert($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function deleteholiday(Request $request)
    {

        if(permission_access('schedule_holiday_delete')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }

        $id = $request->id;
        DB::table('holiday')->where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Deleted successfully");
    }


    public function admin_set_background()
    {
        if(permission_access('background_color_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }

        $data['colors'] = DB::table('background_color')->get();
        return view('admin_set_background')->with($data);
    }

    public function background_color_submit(Request $request)
    {
        for($i = 1; $i <= 60; $i++){
            $color = "color".$i;
            // print_r($request->$color);
            DB::table('background_color')->where('id', $i)->update(['color' => $request->$color]);
        }
        return redirect()->back()->with('status',"Updated successfully");
    }
    public function popup1_settings()
    {
         if(permission_access('settings_popup_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['popups'] = DB::table('popup_settings')->first();
        return view('admin_popup1_settings')->with($data);
    }
    public function popup_settings_submit(Request $request)
    {
        $email_status = $request->email_status;
        $time_difference = $request->time_difference;
        $category = $request->category;
        $popups = DB::table('popup_settings')->first();
        if($popups == ""){
            DB::table('popup_settings')->insert([
                'email_status'  => $email_status,
                'time_difference'   => $time_difference,
                'category'      => $category,
            ]);
        }
        else{
            DB::table('popup_settings')->where('id', 1)->update([
                'email_status'  => $email_status,
                'time_difference'   => $time_difference,
                'category'      => $category,
            ]);
        }
        return redirect()->back()->with('status',"Updated successfully");
    }
 public function admin_user_records()
    {
        if(permission_access('surveyques_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();
       }
        $data['survey'] = DB::table('user_survey_records')
                          ->leftJoin('users', 'users.id', '=', 'user_survey_records.user_id')
                         ->select('user_survey_records.*','users.name','users.email')
                        ->get();
        return view('admin.admin_user_records')->with($data);
    }
    public function admin_survey_polls()
    {
        if(permission_access('surveypolls_view')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();

       }
        $data['categories'] = BusinessCategory::get();
        $data['survey'] = DB::table('admin_survey')
                          ->leftJoin('business_categories', 'business_categories.id', '=', 'admin_survey.category_id')
                         ->select('admin_survey.*','business_categories.category')
                        ->get();
        return view('admin_survey_polls')->with($data);
    }
    public function admin_survey_entry(Request $request)
    {
        $options=json_encode($request->option);
        DB::table('admin_survey')->insert([
            'category_id'       => $request->category_id,
            'question'          => $request->question,
            'options'           => $options,


        ]);
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function edit_admin_survey($id)
    {
        if(permission_access('surveypolls_edit')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();

       }

        $data['categories'] = BusinessCategory::get();
        $data['survey'] = DB::table('admin_survey')->where('id', $id)->first();
        return view('edit_admin_survey_polls')->with($data);
    }
    public function admin_survey_update(Request $request)
    {
         $options=json_encode($request->option);
        DB::table('admin_survey')->where('id', $request->id)->update([
             'category_id'       => $request->category_id,
            'question'          => $request->question,
             'options'           => $options,

        ]);
        return redirect('admin_survey_polls')->with('status',"Updated successfully");
    }
    public function delete_admin_survey($id)
    {
        if(permission_access('surveypolls_delete')!=1)
       {
          echo '<center class="text-center">
            <h1>Access Denied!</h1>
            </center>';
             die();

       }

        DB::table('admin_survey')->where('id', $id)->delete();
        return redirect()->back()->with('status',"Deleted successfully");
    }



    public function notifications()
    {

        if(permission_access('notifications_cms_view')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $data['notifications'] = DB::table('notification_cms')->get();
        return view('notifications')->with($data);
    }

    public function add_notification_view(Request $request)
    {
        if(permission_access('notifications_cms_add')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        return view('add_notification_view');
    }

    public function add_notification(Request $request)
    {

        $values = array('name' => $request->name,'variable' => $request->variable,'cms_content' => $request->cms_content);
        DB::table('notification_cms')->insert($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Inserted successfully");
    }
    public function edit_notification(Request $request)
    {
        if(permission_access('notifications_cms_edit')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        $data['notification'] = DB::table('notification_cms')->select()->where('id', $id)->get();
        //dd($data['notification']);
        return view('edit_notification')->with($data);
    }
    public function update_notification(Request $request)
    {
        $values = array('name' => $request->name,'variable' => $request->variable,'cms_content' => $request->cms_content);
        DB::table('notification_cms')->where('id', $request->id)->update($values);
        Session::flash('success', "Success!");
        return redirect()->back()->with('status',"Updated successfully");
    }
    public function delete_notification(Request $request)
    {
        if(permission_access('notifications_cms_delete')!=1)
           {
              echo '<center class="text-center">
                <h1>Access Denied!</h1>
                </center>';
                 die();
           }
        $id = $request->id;
        DB::table('notification_cms')->where('id', $id)->delete();
        Session::flash('success', "Success!");
        return redirect('notifications')->with('status',"Deleted successfully");
    }

    //=============== Marina =======================
    public function fix_commission_setting()
    {
        $data['fixcomm']=GeneralSetting::whereId(1)->first();
        return view('admin.fix_commission_setting',$data);
    }
    public function form_submit(Request $request){

        // echo $request->customSwitch1;die;

        GeneralSetting::whereId(1)->update([
            'free_lead'             => $request->lead,
            'free_lead_status'         => $request->customSwitch1,
            'other_amount'       => $request->otheramount,
            'other_amount_status'         => $request->customSwitch2,

        ]);
        Session::flash('success', "Success!");
        return redirect('fix-commission-setting')->with('status',"Updated successfully");


    }
    
    public function update_language(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->language = $request->language;
        $user->update();
        return response()->json(array('msg'=> 'Updated Successfully'), 200);
    }




}
