<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendCard;
use DB;
use Illuminate\Support\Facades\Mail;
use App\User;

class SendCardOn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendcard';

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
        $reminders = SendCard::where('date', date('Y-m-d'))->where('status', "pending")->where('time', null)->get();
        foreach($reminders as $reminder){
            $img = $reminder->image;
            $img_path = "https://construxo.in/mafama/public/images/".$img;
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
                'bakg'              => $reminder->background,
                'img_path'          => "",
                'body'              => $reminder->message,
                'username'          => $username,
                'greetings'         => $reminder->greeting,
                'forecolorr'        => $reminder->forecolorr,
                'campaign_name'     => "",
                'user_banner'       => $reminder->user_banner,

            );

            $malto = $reminder->email;
            $subject = $reminder->subject;

            // print_r($emaildetails);die();
            $user_name = User::where('id', $reminder->uid)->first();
            Mail::send('card_email_template', $emaildetails, function($message) use ($malto, $subject) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->from('dsvmailer@gmail.com', $user_name->name);
              });
            $reminders = SendCard::where('id', $reminder->id)->update(['status' => "sent"]);
            User::where('id', $reminder->uid)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
        }
        dd($reminders);
    }
}
