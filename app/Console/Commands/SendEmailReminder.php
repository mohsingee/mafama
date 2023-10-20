<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendEmail;
use DB;
use Illuminate\Support\Facades\Mail;
use App\User;

class SendEmailReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendemailreminder';

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
        $reminders = SendEmail::where('date', date('Y-m-d'))->where('status', "pending")->where('time', date('H:i'))->get();
        foreach($reminders as $reminder){
            if($reminder->count < $reminder->times){
                $emaildetails = array(
                    'malto'             => $reminder->email,
                    'subject'           => $reminder->subject,
                    'bakg'              => $reminder->backhground,
                    'img_path'          => "",
                    'body'              => $reminder->message,
                    'username'          => "",
                    'greetings'         => "",
                    'forecolorr'        => "",
                    'campaign_name'     => $reminder->campaign_name,
                    'user_banner'       => $reminder->user_banner,

                );

                $malto = $reminder->email;
                $subject = $reminder->subject;

                // print_r($emaildetails);die();
                $user_name = User::where('id', $reminder->uid)->first();
                Mail::send('card_email_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                     $message->to($malto)
                     ->subject($subject);
                     $message->attach($img_path);
                     $message->from('dsvmailer@gmail.com', $user_name->name);
                  });
                $count = $reminder->count + 1;
                $time1 = $reminder->time;
                $time = date("H:i", strtotime('+'.$reminder->time_diff.' hours', strtotime($time1)));
                $countupdate = SendEmail::where('id', $reminder->id)->update(['count' => $count, 'time' => $time]);
                User::where('id', $reminder->uid)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
                
            }
            else{
                $reminders = SendEmail::where('id', $reminder->id)->update(['status' => "sent"]);
            }
        }
        dd($reminders);
    }
}
