<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;
use App\User;

class ScheduleHolidayCardReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:holidaycard';

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
        $reminders = DB::table('schedule_holiday_card')->whereMonth('holiday', '=', date('m'))->whereDay('holiday', '=', date('d'))->get();
        foreach($reminders as $reminder){
            $emaildetails = array(
                'malto'             => $reminder->email,
                'subject'           => $reminder->subject,
                'image'             => $reminder->image,
                'body'              => $reminder->message,
                'user_banner'       => $reminder->user_banner,
            );
            $malto = $reminder->email;
            $subject = $reminder->subject;

            // print_r($emaildetails);die();
           Mail::send('manage_client_card_template', $emaildetails, function($message) use ($malto, $subject) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->from('dsvmailer@gmail.com', 'Mafama');
              });
            User::where('id', $reminder->uid)->update(['total_send_emails'=> DB::raw('total_send_emails+1')]);
        }
        dd($reminders);
    }
}
