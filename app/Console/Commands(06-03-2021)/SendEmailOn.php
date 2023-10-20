<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendEmail;
use DB;
use Illuminate\Support\Facades\Mail;

class SendEmailOn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendemail';

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
        $reminders = SendEmail::where('date', date('Y-m-d'))->where('status', "pending")->where('time', null)->get();
        foreach($reminders as $reminder){
            $img = $reminder->image;
            $img_path = "https://construxo.in/mafama/public/videos/".$img;
            $emaildetails = array(
                'malto'             => $reminder->email,
                'subject'           => $reminder->subject,
                'bakg'              => $reminder->backhground,
                'img_path'          => "",
                'body'              => $reminder->message,
                'campaign_name'     => $reminder->campaign_name,
                'user_banner'       => $reminder->user_banner,

            );

            $malto = $reminder->email;
            $subject = $reminder->subject;

            // print_r($emaildetails);die();
            Mail::send('card_email_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->attach($img_path);
                 $message->from('dsvmailer@gmail.com', 'Mafama');
              });
            $reminders = SendEmail::where('id', $reminder->id)->update(['status' => "sent"]);
        }
        dd($reminders);
    }
}
