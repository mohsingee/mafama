<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendSms;
use DB;
use Illuminate\Support\Facades\Mail;
use App\User;
use Twilio\Rest\Client;

class SendSmsReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendsmsreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reminders = SendSms::where('date', date('Y-m-d'))->where('status', "pending")->where('time', date('H:i'))->get();
        foreach($reminders as $reminder){
            if($reminder->count < $reminder->times){
                $urll = url('/');
                $paath = $urll."/public/videos/";
                $img = $reminder->image;
                $img_path = "https://construxo.in/mafama/public/videos/".$img;
                // $img_path = "https://thumbs.dreamstime.com/z/spring-flowers-blue-crocuses-drops-water-backgro-background-tracks-rain-113784722.jpg";


                 try {  
                    $account_sid = getenv("TWILIO_SID");
                    $auth_token = getenv("TWILIO_TOKEN");
                    $twilio_number = getenv("TWILIO_FROM");
          
                    $client = new Client($account_sid, $auth_token);
                    $client->messages->create($reminder->phone_no, [
                        'from' => $twilio_number, 
                        'body' => $reminder->message]);
          
                  //  dd('SMS Sent Successfully.');
          
                } catch (Exception $e) {
                   // dd("Error: ". $e->getMessage());
                }

                $userdet = DB::table('contacts')->where('email', $reminder->email)->get();
                if(count($userdet) > 0){
                    $username = $userdet[0]->first_name." ".$userdet[0]->last_name;
                }
                else{
                    $username = "";
                }
                $emaildetails = array(
                    'malto'             => $reminder->email,
                    'subject'           => $reminder->subject,
                    'bakg'              => $reminder->backhground,
                    'campaign_name'     => "",
                    'body'              => $reminder->message,
                    'username'          => $username,
                    'greetings'         => $reminder->greeting,
                    'forecolorr'        => $reminder->forecolorr,
                    'user_banner'       => $reminder->user_banner,
                );
                $malto = $reminder->email;
                $subject = $reminder->subject;

                // print_r($emaildetails);die();
                Mail::send('email_campaign_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                     $message->to($malto)
                     ->subject($subject);
                     $message->attach($img_path);
                     $message->from('dsvmailer@gmail.com', 'Mafama');
                  });
                $count = $reminder->count + 1;
                $time1 = $reminder->time;
                $time = date("H:i", strtotime('+'.$reminder->time_diff.' hours', strtotime($time1)));
                $countupdate = SendSms::where('id', $reminder->id)->update(['count' => $count, 'time' => $time]);
                User::where('id', $reminder->uid)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
                
            }
            else{
                $reminders = SendSms::where('id', $reminder->id)->update(['status' => "sent"]);
            }
        }
        dd($reminders);
    }
}
