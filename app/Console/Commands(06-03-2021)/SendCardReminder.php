<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SendCard;
use DB;
use Illuminate\Support\Facades\Mail;

class SendCardReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendcardreminder';

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
        $reminders = SendCard::where('date', date('Y-m-d'))->where('status', "pending")->where('time', date('H:i'))->get();
        foreach($reminders as $reminder){
            if($reminder->count < $reminder->times){
                $img = $reminder->image;
                $img_path = "https://construxo.in/mafama/public/images/".$img;
                $emaildetails = array(
                    'malto'             => $reminder->email,
                    'subject'           => $reminder->subject,
                    'bakg'              => "",
                    'img_path'          => $img_path,
                    'body'              => $reminder->message,
                    'campaign_name'     => "",
                    'user_banner'       => $reminder->user_banner,

                );

                $malto = $reminder->email;
                $subject = $reminder->subject;

                // print_r($emaildetails);die();
                Mail::send('card_email_template', $emaildetails, function($message) use ($malto, $subject) {
                     $message->to($malto)
                     ->subject($subject);
                     $message->from('dsvmailer@gmail.com', 'Mafama');
                  });
                $count = $reminder->count + 1;
                $time1 = $reminder->time;
                $time = date("H:i", strtotime('+'.$reminder->time_diff.' hours', strtotime($time1)));
                $countupdate = SendCard::where('id', $reminder->id)->update(['count' => $count, 'time' => $time]);
                
            }
            else{
                $reminders = SendCard::where('id', $reminder->id)->update(['status' => "sent"]);
            }
        }
        dd($reminders);
    }
}
