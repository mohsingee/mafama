<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Payment as Transactionhistory;
use Carbon\Carbon;
use DateTime;
use App\Mail\RegistrationMail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Userlog;
use App\Chat;
use App\AffiliateRegistration;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendCardMail;
use App\Http\Requests;
class ChatController extends Controller
{ 
    
    
    public function getChatusers_notworking(Request $request)
    {
       
     $login_id=Auth::user()->id;
     $chatlist = DB::select( DB::raw("SELECT DISTINCT(from_user_id) FROM chats where to_user_id = '".$login_id."' AND from_user_id != '".$login_id."' ORDER BY created_at DESC") );
      $output = '';
      $users=array();
      foreach ($chatlist as $list) {
            $users[]=$chatlist;
      }
    
//print_r($users);die();
foreach($users as $key=>$uiid)
{
 //echo   $uid>$uiid->from_user_id;
     $uid=$uiid[$key]->from_user_id;   
    $user=User::find($uid);
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity ='';// fetch_user_last_activity($row['uid'], $db);
    ob_start();
    if($user_last_activity > $current_timestamp)
    {
        $status = '<span class="label label-success">Online</span>';
    }
    else
    {
        $status = '<span class="label label-danger">Offline</span>';
    }
    if(!empty($user->name) && $user->name!='')
    {
        $affiliate=AffiliateRegistration::where('email',$user->email)->first();
    ?>
       <li class="chat-item">
        <a class="chat-link chat-open current" href="javascript:void(0)"  onclick="selectuser(<?=$user->id; ?>)" id="act<?= $user->id; ?>" data-aid="<?= $user->id; ?>" >
             <div style="margin-right: 10px;">
                <input type="checkbox" id="" name="" value="" />
            </div> 
            <div class="chat-media user-avatar">
                <img src="<?=asset('public/images/affiliates/'.$affiliate->image );?>" style="width: 100%;" />
                <span class="status dot dot-lg dot-gray"></span>
            </div>
            <div class="chat-info">
                <div class="chat-from">
                    <div class="name"><?=$user->name;?></div>
                     <span class="time"><?=$this->count_unseen_message($user->id,$login_id);?></span>
                </div>
                <div class="chat-context">
                    <div class="text"><?=$this->last_message($user->id,$login_id);?></div>
                    <div class="status delivered">
                        <em class="icon ni ni-check-circle-fill"></em>
                    </div>
                </div>
            </div>
        </a>
        <!-- <div class="chat-actions">
            <div class="dropdown">
                <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h" style="color: #888;"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li><a href="#">Delete Conversion</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </li>
    <?php
   }
}
$output=ob_get_clean();
echo $output;
}
 public function getChatusers(Request $request)
    {
       
     $login_id=Auth::user()->id;     
      $output = '';
$users = DB::select( DB::raw("SELECT *FROM users WHERE  id !=$login_id order by name ASC  ") );
//print_r($users);die();
foreach($users as $user)
{
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity ='';// fetch_user_last_activity($row['uid'], $db);
    ob_start();
    if($user_last_activity > $current_timestamp)
    {
        $status = '<span class="label label-success">Online</span>';
    }
    else
    {
        $status = '<span class="label label-danger">Offline</span>';
    }
    if(!empty($user->name) && $user->name!='')
    {
        if($user->role=='client')
        {
         $affiliate=DB::table('client_appointment_lists')->where('email',$user->email)->first();
          $path = 'public/assets/images/client/';
        }else{

         $affiliate=AffiliateRegistration::where('email',$user->email)->first();
         $path = 'public/images/affiliates/';

        }

        if(empty($affiliate->image))
        {
          $imgsrc=asset('public/images/affiliates/demo_1602513822.png');
        }else{
            $imgsrc=asset($path.$affiliate->image);
        }
        
    ?>
       <li class="chat-item">
        <a class="chat-link chat-open current" href="javascript:void(0)"  onclick="selectuser(<?=$user->id; ?>)" id="act<?= $user->id; ?>" data-aid="<?= $user->id; ?>" >
             <div style="margin-right: 10px;">
                <input type="checkbox" class="checkboxall" name="user_list[]" value="<?=$user->id; ?>" />
            </div> 
            <div class="chat-media user-avatar">
                <img src="<?=$imgsrc;?>" class=" img-responsive img-thumbnail proimg"  />
                <span class="status dot dot-lg dot-gray"></span>
            </div>
            <div class="chat-info">
                <div class="chat-from">
                    <div class="name"><?=$user->name;?></div>
                     <span class="time"><?=$this->count_unseen_message($user->id,$login_id);?></span>
                </div>
                <div class="chat-context">
                    <div class="text"><?=$this->last_message($user->id,$login_id);?></div>
                    <div class="status delivered">
                        <em class="icon ni ni-check-circle-fill"></em>
                    </div>
                </div>
            </div>
        </a>
        <!-- <div class="chat-actions">
            <div class="dropdown">
                <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h" style="color: #888;"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li><a href="#">Delete Conversion</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </li>
    <?php
   }
}
$output=ob_get_clean();
echo $output;
}
function count_unseen_message($from_user_id, $to_user_id)
{
    $output = '';
    $count=Chat::where(['from_user_id'=>$from_user_id,'to_user_id'=>$to_user_id,'status'=>0])->count();
    if($count > 0)
    {
        $output = '<span style="padding:4px 7px;border-radius: 100%;font-size:10px;background-color:green;float: right;color:#fff;">'.$count.'</span>';
    }
    return '';
}
 
public function last_message($from_user_id, $to_user_id)
{
   
    $output = '';
    $data = DB::select( DB::raw("SELECT * FROM chats 
    WHERE from_user_id = '$to_user_id' 
    AND to_user_id = '$from_user_id' 
     ORDER by id desc") );   
    if(count($data) > 0)
    {        
        $output = 'You: '. $data[0]->message;
    }
    return $output;
}
public function last_message_date($from_user_id, $to_user_id)
{
    $data = DB::select( DB::raw("SELECT * FROM chats 
    WHERE from_user_id = '$from_user_id' AND status=0
    AND to_user_id = '$to_user_id' 
     ORDER by id desc") );
    $output = '';
    if(count($data) > 0)
    {
        
        $output =  date('d M' , strtotime($data[0]->created_at));;
    }
    return $output;
}
public function showchat(Request $request)
{
    $success = true;
  $message = "";
  $to_user_id=$request->to_user_id;
  $login_uid=Auth::user()->id;
 
  $chat_header=$this->get_user_chat_header($to_user_id);
  $data=$this->fetch_user_chat_history($login_uid, $to_user_id);
  $videos=$this->fetch_user_videos($login_uid, $to_user_id);
  $attachments=$this->fetch_user_attachments($login_uid, $to_user_id);
  
  echo json_encode(array(
    "data"=>$data,
    "chat_header"=>$chat_header,
    "videos"=>$videos,
    "attachments"=>$attachments,
    "success"=>$success,
    "message" => $message
  ));
}
public function short_name($name) {
 //The strtoupper() function converts a string to uppercase.
    $name  = strtoupper($name); 
    //prefixes that needs to be removed from the name
    $remove = ['.', 'MRS', 'MISS', 'MS', 'MASTER', 'DR', 'MR'];
    $nameWithoutPrefix=str_replace($remove," ",$name);
    $words = explode(" ", $nameWithoutPrefix);
    //this will give you the first word of the $words array , which is the first name
    $firtsName = reset($words); 
    //this will give you the last word of the $words array , which is the last name
    $lastName  = end($words);
    echo substr($firtsName,0,1); 
    echo substr($lastName ,0,1); 
}
public function get_user_chat_header($to_user_id){
     ob_start();
     $login_ago='';
     $user=User::where('id',$to_user_id)->first();
     $userlog=Userlog::where('user_id',$to_user_id)->orderBy('id','desc')->first();
     if (!empty($userlog)) {
       $last_login=$userlog->created_at;
       $login_ago=\Carbon\Carbon::parse($last_login)->diffForHumans();
     }
    $aaid = "";
    if((Auth::user()->role) == "affiliate"){
        $aaid = Auth::user()->email;
    }
    else{
        $aaid = Auth::user()->affiliate_user_email;
    }
    if(Auth::user()->role != "admin"){
    $affiliate_banner = DB::table('affiliate_banner')->where('affiliate_email', $aaid)->first();
    $affiliate_details = DB::table('affiliate_registrations')->where('email', $aaid)->first();
     }
    ?>
    
            <div class="col-md-12" style="padding: 1rem 1.75rem;">
                <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="javascript:void(0)" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-avatar bg-purple">
                                <span><?=$this->short_name($user->name);?></span>
                            </div>
                            <div class="user-info">
                                <div class="lead-text" style="color: #fff;"><?=$user->name;?></div>
                                <div class="sub-text">
                                    <span class="d-none d-sm-inline mr-1">Active </span>
                                     <?=$login_ago?></div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <?php if(Auth::user()->role != "admin"){ ?>
            <div class="col-md-12"  style="padding: 0px;">
                <div class="appndbanner">
                    <div class="user_banner1"><table cellpadding="0" cellspacing="0" class="style1" style="width: 100%;margin-bottom:0px;"><tbody><tr><td id="ctl00_ucBanner1_td_banner" style="width: 100%;"><table border="0" cellspacing="0" cellpadding="0" style="width: 100%;"><tbody><tr><td style="vertical-align: top;"><table border="0" cellpadding="0" cellspacing="0" style="width: 100%;"><tbody><tr><td style="text-align: left; vertical-align: top;"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="Slogan" style="text-align: center; vertical-align: top; height: 30px; padding-bottom: 5px; padding-top: 5px;"><div class="business_name1" style="font-weight: bold; font-size: 10px; color: rgb(255, 255, 170);"><?php if($affiliate_banner->business_name != ""){ echo $affiliate_banner->business_name; } else{ echo $affiliate_details->company; ?>  <?php } ?></div></td></tr><tr><td style="text-align: center; vertical-align: top; padding-left: 10px; padding-right: 10px;"><div class="description" style="min-height: 20px; padding: 0px;"><?php if($affiliate_banner->message != ""){ echo $affiliate_banner->message; }?></div></td></tr><tr><td class="Heading" style="padding-left: 10px; padding-right: 10px; padding-bottom: 5px; padding-top: 5px;"><div class="phone_no1"><?php if($affiliate_banner->phone_no != ""){ ?>Phone No:  <?= $affiliate_banner->phone_no; ?><?php } else{ ?><b>Phone No: </b> <?= $affiliate_details->business_telephone; ?><?php } ?></div><div class="address1"><?php if($affiliate_banner->phone_no != ""){ ?>Address: <?= $affiliate_banner->address; ?><?php } else{ ?><b>Address: </b> <?= $affiliate_details->billing_address ?>, <?= $affiliate_details->billing_city ?> <?= $affiliate_details->zip_code; ?><?php } ?></div><div class="web_address1"><?php if($affiliate_banner->web_address != ""){ ?><b>Web Address: </b> <?= $affiliate_banner->web_address; ?><?php } ?></div></td></tr></tbody></table></td><td style=""><img id="bannimg" src="<?php if($affiliate_banner->img != ""){ ?><?= asset('public/videos') ?>/<?= $affiliate_banner->img ?><?php }else{?><?= asset('public/images/affiliates') ?>/<?= $affiliate_details->image ?> <?php } ?>"  style="border: 2px solid white;   padding: 2px; border-radius: 12px; margin: 10px;"></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></div>
                    
                </div>
            </div>
           <?php } ?>
            <!--<ul class="nk-chat-head-tools">
                        <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-call-fill"></em></a></li>
                        <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-video-fill"></em></a></li>
                        <li class="d-none d-sm-block">
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger text-primary" data-toggle="dropdown"><em class="icon ni ni-setting-fill"></em></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="link-list-opt no-bdr">
                                        <li><a class="dropdown-item" href="#"><em class="icon ni ni-archive"></em><span>Make as Archive</span></a></li>
                                        <li><a class="dropdown-item" href="#"><em class="icon ni ni-cross-c"></em><span>Remove Conversion</span></a></li>
                                        <li><a class="dropdown-item" href="#"><em class="icon ni ni-setting"></em><span>More Options</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="mr-n1 mr-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle"><em class="icon ni ni-alert-circle-fill"></em></a></li>
                    </ul>-->
            <div class="nk-chat-head-search">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left">
                            <em class="icon ni ni-search"></em>
                        </div>
                        <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation" />
                    </div>
                </div>
            </div>
            <script type="text/javascript">
     showColor();
    function showColor(){
        var back_color = $(".user_banner").css("background-color");
        // var back_color = "#fae3e2";
        var font_color = $(".user_banner").css("color");
        $(".user_banner1").css("background-color", back_color);
        $(".user_banner1").css("color", font_color);
        $(".business_name1").css("color", font_color);
        $(".phone_no1").css("color", font_color);
        $(".address1").css("color", font_color);
        $(".web_address1").css("color", font_color);
    }
</script>
            <!-- .nk-chat-head-search -->
        
    <?php 
    $data1=ob_get_clean();
    return $data1;
}
public function fetch_user_chat_history($from_user_id, $to_user_id)
{
    $output='';
    $chats = DB::select( DB::raw("SELECT * FROM chats 
    WHERE (from_user_id = '".$from_user_id."' 
    AND to_user_id = '".$to_user_id."') 
    OR (from_user_id = '".$to_user_id."' 
    AND to_user_id = '".$from_user_id."') 
    ORDER BY created_at ASC") );
   // echo $from_user_id.''.$to_user_id;die;
    
    ob_start();
    foreach($chats as $chat)
    {
        $user_name = '';
        $dynamic_background = '';
        $chat_message = '';
        $date = date('d M' , strtotime($chat->created_at));
        $time = date('h:m:A' , strtotime($chat->created_at));
        $target_path=asset('public/images/'.$chat->attachment);
        $target_path1=asset('public/videos/'.$chat->video_link);
        $attachment='<p><img src="'.$target_path.'" class="img-thumbnail" width="200" height="160" /></p><br />';
       // $video_link='<iframe width="200" height="120"  src="'.$target_path1.'"></iframe><br />';
        $video_link='<video width="200" height="120" controls><source src="'.$target_path1.'" type="video/mp4"></video><br />';
       ?>
    <!-- <div class="chat-sap">
        <div class="chat-sap-meta"><span>12 May, 2020</span></div>
   </div> -->
       <?php
        if($chat->from_user_id == $from_user_id)
        {
            if($chat->status == '2')
            {
                $chat_message = '<em><i class="fa fa-ban"></i>You deleted this message</em>';
                $user_name = '<b class="text-success">You</b>';
                $user_name1='';
            }
            else
            {
                $chat_message = $chat->message;
                $user_name1 = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$chat->id.'"  data-toid="'.$to_user_id.'">x</button>&nbsp;<b class="text-success"></b>';
                $user_name = '<button type="button" class="btn btn-danger btn-xs remove_chat" id="'.$chat->id.'">x</button>&nbsp;<b class="text-success">You</b>';
              
            }
            ?>
            <div class="chat is-me">
                <div class="chat-content">
                    <div class="chat-bubbles">
                        <?php 
                           if($chat->reply_uid !=0  && $chat->status != '2') 
                            { 
                                $reply=Chat::find($chat->reply_uid);
                            ?>
                           <div class="chat-msg-reply" >You
                            <br>
                            <?=$reply->message;?>
                            </div>
                           <?php } ?>
                      <div class="chat-bubble">   
                           
                            <div class="chat-msg" id="msg-box<?=$chat->id;?>" ><?=$chat_message;?>
                            <?php if(!empty($chat->attachment) && $chat->status != '2'){ ?>
                                <br>
                                <?=$attachment;?>
                            <?php  } ?>
                            <?php if(!empty($chat->video_link) && $chat->status != '2'){ ?>
                                <br>
                                <?=$video_link;?>
                            <?php  } ?>
                            </div>
                           
                            <?php if($chat->status != '2'){ ?>
                            <ul class="chat-msg-more">
                                <li class="d-none d-sm-block">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h" style="color: #888;"></i></a>
                                        <div class="dropdown-menu dropdown-menu-sm">
                                            <ul class="link-list-opt no-bdr">
                                                
                                                 <li class="d-sm-none">
                                                    <a href="javascript:void(0)" class="reply_chat" data-id="<?=$chat->id;?>" data-toid="<?=$to_user_id;?>"><em class="icon ni ni-reply-fill"></em> Reply</a>
                                                </li> 
                                                <li>
                                                    <a href="javascript:void(0)" class="edit_chat" data-id="<?=$chat->id;?>" data-toid="<?=$to_user_id;?>"><em class="icon ni ni-pen-alt-fill"></em> Edit</a>
                                                </li> 
                                                <li>
                                                    <a href="javascript:void(0)" class="remove_chat" data-id="<?=$chat->id;?>" data-toid="<?=$to_user_id;?>"><em class="icon ni ni-trash-fill"></em> Remove</a>
                                                </li>
                                            
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <?php } ?>
                        
                    </div>
                    </div>
                    <ul class="chat-meta">
                        <li>You</li>
                        <li><?=$date;?> | <?=$time;?></li>
                    </ul>
                </div>
            </div>
            
<?php
            
        }
        else
        {
            if($chat->status == '2')
            {
                $chat_message = '<em><i class="fa fa-ban"></i> This message has been removed</em>';
            }
            else
            {
                $chat_message = $chat->message;
            }
            $get_user_name=User::find($chat->from_user_id)->name;
            $user_name = '<b class="text-danger">'.$get_user_name.'</b>';
            ?>
             <div class="chat is-you">
                                    <div class="chat-avatar">
                                        <div class="user-avatar bg-purple">
                                            <span><?=$this->short_name($get_user_name);?></span>
                                        </div>
                                    </div>
                                    <div class="chat-content">
                                        <div class="chat-bubbles">
                                            <div class="chat-bubble">
                                                <div class="chat-msg"><?=$chat_message;?>
                                            <?php if(!empty($chat->attachment) && $chat->status != '2'){ ?>                           
                                            <br>
                                             <?=$attachment;?>
                                            <?php  } ?> 
                                            <?php if(!empty($chat->video_link) && $chat->status != '2'){ ?>                           
                                            <br>
                                             <?=$video_link;?>
                                            <?php  } ?>
                                                </div>
                                                <!-- <ul class="chat-msg-more">
                                                    <li class="d-none d-sm-block">
                                                        <a href="#" class="btn btn-icon btn-sm btn-trigger"><em class="icon ni ni-reply-fill"></em></a>
                                                    </li>
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h" style="color: #888;"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li class="d-sm-none">
                                                                        <a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><em class="icon ni ni-pen-alt-fill"></em> Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><em class="icon ni ni-trash-fill"></em> Remove</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul> -->
                                            </div>
                                         
                                        </div>
                                        <ul class="chat-meta">
                                            <li><?=$get_user_name;?></li>
                                            <li><?=$date;?> | <?=$time;?></li>
                                        </ul>
                                    </div>
                                </div>
            <?php
            
        }
        
    }
    
    $data2=ob_get_clean();
    $output .= $data2;
  $update=Chat::where(['from_user_id'=>$to_user_id,'to_user_id'=>$from_user_id,'status'=>0])->update(['status'=>1,'seen_date'=>date('Y-m-d H:i:s')]);
    return $output;
}
public function msg_send_write_msg(Request $request)
{
    $success = false;
    $message = "";
    $attachment = "";
    $video_link = "";
    $to_user_id=$request->to_user_id;
    $login_uid=Auth::user()->id;
    $chat_message=$request->chat_message;
    $msg_id=$request->msg_id;
    $reply_uid=$request->reply_uid;
    $userlist=$request->user_list;
    if($request->hasFile('file'))
    {
    $file = $request->file('file');
    $filenames = explode('.', $file->getClientOriginalName());
    $filename = $filenames[0];
    $extension = $file->getClientOriginalExtension();
    $attachment = 'image_'.time().'.'.$extension;
    $destinationPath = 'public/images';
    $file->move($destinationPath,$attachment);
    }
    if($request->hasFile('video_link'))
    {
    $file = $request->file('video_link');
    $filenames = explode('.', $file->getClientOriginalName());
    $filename = $filenames[0];
    $extension = $file->getClientOriginalExtension();
    $video_link ='vdo_'.time().'.'.$extension;
    $destinationPath = 'public/videos';
    $file->move($destinationPath,$video_link);
    }
    if(empty($msg_id) && empty($reply_uid))
     {
      if(!empty($userlist))
       {
       foreach ($userlist as $to_user_id) {
            $data=array(
                   "to_user_id"   =>$to_user_id,
                   "from_user_id" =>$login_uid,
                   "reply_uid"    =>0,
                   "message"      =>$chat_message,
                   "attachment"   =>$attachment,
                   "video_link"   =>$video_link,
               ); 
       $try=Chat::create($data);
       }
      }else{
            $data=array(
                   "to_user_id"   =>$to_user_id,
                   "from_user_id" =>$login_uid,
                   "reply_uid"    =>0,
                   "message"      =>$chat_message,
                   "attachment"   =>$attachment,
                   "video_link"   =>$video_link,
               ); 
        $try=Chat::create($data);   
      }   
     }elseif (!empty($reply_uid)) {
         if(!empty($userlist))
       {
        $chat_message=str_replace('x',' ', $chat_message);
       foreach ($userlist as $to_user_id) {
            $data=array(
                   "to_user_id"   =>$to_user_id,
                   "from_user_id" =>$login_uid,
                   "reply_uid"    =>$reply_uid,
                   "message"      =>$chat_message,
                   "attachment"   =>$attachment,
                   "video_link"   =>$video_link,
               ); 
       $try=Chat::create($data);
       }
      }else{
            $data=array(
                   "to_user_id"   =>$to_user_id,
                   "from_user_id" =>$login_uid,
                   "reply_uid"    =>$reply_uid,
                   "message"      =>$chat_message,
                   "attachment"   =>$attachment,
                   "video_link"   =>$video_link,
               ); 
        $try=Chat::create($data);   
      }  
     }
     elseif(!empty($msg_id)){
            $data=array(                   
               "message"      =>$chat_message,
               "attachment"   =>$attachment,
               "video_link"   =>$video_link,
               ); 
        $try=Chat::where('id',$msg_id)->update($data);   
     }
   
   
  if($try) {
    $data = "1";
  }else{
    $data = "2";
  } 
   $data1=$this->fetch_user_chat_history($login_uid, $to_user_id);
   echo json_encode(array(
    "data"=>$data1,
    "success"=>$success,
    "message" => $message
  ));
}
public function DeleteChat(Request $request){
    
  $success = false;
  $message = "";
  $chat_message_id=$request->chat_message_id;
  
  $try=Chat::where('id',$chat_message_id)->update(['status'=>2]);
  if($try) {
    $data = "1";
  }else{
    $data = "2";
  }
  $data1=$this->fetch_user_chat_history(Auth::user()->id, $request->to_user_id);
 echo json_encode(array(
    "data"=>$data1,
    "success"=>$success,
    "message" => $message
  ));
}
public function UpdateChat(Request $request){
    
  $success = true;
  $message = "";
  $chat_message_id=$request->chat_message_id;
  
  $data=Chat::where('id',$chat_message_id)->first();
  
  
 echo json_encode(array(
    "msg_id"=>$request->chat_message_id,
    "to_user_id"=>$request->to_user_id,
    "msg"=>$data->message,
    "success"=>$success,
    "message" => $message
  ));
}


public function search_user(Request $request){

    $success = false;
  $message = "";
  ob_start();
  $login_uid=Auth::user()->id;
  $login_id=Auth::user()->id;
  $text = $request->text;
  //role='affiliate' and
    $users=DB::select( DB::raw("SELECT * FROM `users` WHERE  id!='$login_uid' && name LIKE '%$text%'") );;
  if(count($users) >0)
  {
     foreach($users as $user)
     {
     if(!empty($user->name) && $user->name!='')
      {

        if($user->role=='client')
        {
         $affiliate=DB::table('client_appointment_lists')->where('email',$user->email)->first();
          $path = 'public/assets/images/client/';
        }else{

         $affiliate=AffiliateRegistration::where('email',$user->email)->first();
         $path = 'public/images/affiliates/';

        }

        if(empty($affiliate->image))
        {
          $imgsrc=asset('public/images/affiliates/demo_1602513822.png');
        }else{
            $imgsrc=asset($path.$affiliate->image);
        }
        ?>
           <li class="chat-item">
        <a class="chat-link chat-open current" href="javascript:void(0)"  onclick="selectuser(<?=$user->id; ?>)" id="act<?= $user->id; ?>" data-aid="<?= $user->id; ?>" >
            <div style="margin-right: 10px;">
               <input type="checkbox" class="checkboxall" name="user_list[]" value="<?=$user->id; ?>" />
            </div>
            <div class="chat-media user-avatar">
                <img src="<?=$imgsrc;?>" class=" img-responsive img-thumbnail"  />
                <span class="status dot dot-lg dot-gray"></span>
            </div>
            <div class="chat-info">
                <div class="chat-from">
                    <div class="name"><?=$user->name;?></div>
                     <span class="time"><?=$this->count_unseen_message($user->id,$login_id);?></span>
                </div>
                <div class="chat-context">
                    <div class="text"><?=$this->last_message($user->id,$login_id);?></div>
                    <div class="status delivered">
                        <em class="icon ni ni-check-circle-fill"></em>
                    </div>
                </div>
            </div>
        </a>

    </li>

    <?php
       }
      }
  }else{ ?>

<li class="chat-item">
    Not found
</li>
 <?php }
  $data=ob_get_clean();
 echo json_encode(array(
    "data"=>$data,
    "success"=>$success,
    "message" => $message
  ));
}






public function fetch_user_videos($from_user_id, $to_user_id)
{
    $output='';
    $videos = DB::select( DB::raw("SELECT * FROM chats 
    WHERE (from_user_id = '".$from_user_id."' 
    AND to_user_id = '".$to_user_id."') 
    OR (from_user_id = '".$to_user_id."' 
    AND to_user_id = '".$from_user_id."') 
    ORDER BY created_at ASC") );
    $output = "";
  if(count($videos) >0)  
  {
     foreach($videos as $video)
     {    
        
        if($video->video_link!=''){
            $output .= "<div>";
            $output .= "<video width='150' height='150' controls><source src='".asset('public/videos/'.$video->video_link)."' type='video/mp4'></video>";
            $output .= "</div><br />"; 
        }
        
       }
    }else{ 
    $output .= "<div>No videos found!</div>";
    }
  return $output;
}
public function fetch_user_attachments($from_user_id, $to_user_id)
{
    $output='';
    $attachments = DB::select( DB::raw("SELECT * FROM chats 
    WHERE (from_user_id = '".$from_user_id."' 
    AND to_user_id = '".$to_user_id."') 
    OR (from_user_id = '".$to_user_id."' 
    AND to_user_id = '".$from_user_id."') 
    ORDER BY created_at ASC") );
    $output = "";
      if(count($attachments) >0)  
      {
            foreach($attachments as $attachment)
            {    
         
                
                if($attachment->attachment!=''){
                    $output .= "<div>";
                    $output .= "<img src='".asset('public/images/'.$attachment->attachment)."' class='img-thumbnail' width='150' height='150'/>";
                    $output .= "</div><br />";
                }
                 
            }
       }else{ 
        $output .= "<div>No attachments found!</div>";
      }
      return $output;
}









//admin

 public function getAdminChatusers(Request $request)
    {

     $login_id=Auth::user()->id;
      $output = '';
$users = DB::select( DB::raw("SELECT *FROM users WHERE  id !=$login_id order by name ASC  ") );
//print_r($users);die();
foreach($users as $user)
{
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity ='';// fetch_user_last_activity($row['uid'], $db);
    ob_start();
    if($user_last_activity > $current_timestamp)
    {
        $status = '<span class="label label-success">Online</span>';
    }
    else
    {
        $status = '<span class="label label-danger">Offline</span>';
    }
    if(!empty($user->name) && $user->name!='')
    {
        if($user->role=='client')
        {
         $affiliate=DB::table('client_appointment_lists')->where('email',$user->email)->first();
          $path = 'public/assets/images/client/';
        }else{

         $affiliate=AffiliateRegistration::where('email',$user->email)->first();
         $path = 'public/images/affiliates/';

        }

        if(empty($affiliate->image))
        {
          $imgsrc=asset('public/images/affiliates/demo_1602513822.png');
        }else{
            $imgsrc=asset($path.$affiliate->image);
        }

    ?>

       <li class="chat-item">
        <a class="chat-link chat-open current" href="javascript:void(0)"  onclick="selectuser(<?=$user->id; ?>)" id="act<?= $user->id; ?>" data-aid="<?= $user->id; ?>" >
             <div style="margin-right: 10px;">
                <input type="checkbox" class="checkboxall" name="user_list[]" value="<?=$user->id; ?>" />
            </div>
            <div class="chat-media user-avatar">
                <img src="<?=$imgsrc;?>" class=" img-responsive img-thumbnail proimg"  />
                <span class="status dot dot-lg dot-gray"></span>
            </div>
            <div class="chat-info">
                <div class="chat-from">
                    <div class="name"><?=$user->name;?></div>
                     <span class="time"><?=$this->count_unseen_message($user->id,$login_id);?></span>
                </div>
                <div class="chat-context">
                    <div class="text"><?=$this->last_message($user->id,$login_id);?></div>
                    <div class="status delivered">
                        <em class="icon ni ni-check-circle-fill"></em>
                    </div>
                </div>
            </div>
        </a>
        <!-- <div class="chat-actions">
            <div class="dropdown">
                <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h" style="color: #888;"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <ul class="link-list-opt no-bdr">
                        <li><a href="#">Delete Conversion</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </li>
    <?php
   }
}
$output=ob_get_clean();
echo $output;
}








}    