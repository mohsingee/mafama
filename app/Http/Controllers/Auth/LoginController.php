<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Session;
use DB;
use Request ;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        $ip=Request::ip();
        $agent=Request::header('user-agent');
         $message=getNotificationMessage(1);
        if (Auth::user()->role == "admin") {

            addUserActivity('Login successfully','login',$message,$message);

            return redirect()->to('/admin');
        }
        else{

          if(Auth::user()->status !=1 )
          {
            Auth::logout();
            return redirect('/')->with('status',"You have been deactivated, please contact to  admininstrator");
          }else{
            if((Auth::id() != "") && (Auth::user()->role == "affiliate_user")){
                $user = DB::table('user_access_role')->where('email', Auth::user()->email)->first();
                $menu = \App\Http\Controllers\HomeController::getclientmenu(Auth::user()->email);
                $menu2 = \App\Http\Controllers\HomeController::getclientmenu2(Auth::user()->email);
                $timee = \App\Http\Controllers\HomeController::getclienttime(Auth::user()->email);
                if($user->status == 0){
                    Auth::logout();
                    return redirect('/')->with('status',"You have been deactivated");
                }
                if($timee != "block"){
                    $time = explode(',', $timee);
                    $starttime = $time[0];
                    $endtime = $time[1];
                    $now = date('H:i');
                    if( ($now >= $starttime) && ($now <= $endtime)){
                        return redirect('/');
                    }else{
                        $subject="USER TRY ATTEMPT TO LOGIN";
                        $message="User try attempt to login in unauthorize hours ";
                      send_unauthorize_login_alert_to_affiliate($subject,$message);
                       Auth::logout();
                    return redirect('/')->with('status',"This is not your authorize hours for login");
                    }

                   }else{
                     $subject="USER TRY ATTEMPT TO LOGIN";
                        $message="User try attempt to login in blocked day ";
                      send_unauthorize_login_alert_to_affiliate($subject,$message);
                    Auth::logout();
                    return redirect('/')->with('status',"You have been blocked today");
                   }


            }
            if((Auth::id() != "") && (Auth::user()->role == "affiliate")){
                addUserActivity('Login successfully','login',$message,$message);
                Session::put('popup', 1);
                Session::put('plan_expire_popup', 1);
            }
            return redirect('/');
        }
     }
    }
}
