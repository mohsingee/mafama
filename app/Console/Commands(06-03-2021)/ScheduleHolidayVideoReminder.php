<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;

class ScheduleHolidayVideoReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:holidayvideo';

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
        $reminders = DB::table('schedule_holiday_video')->whereMonth('holiday', '=', date('m'))->whereDay('holiday', '=', date('d'))->get();
        foreach($reminders as $reminder){
            $img_path = $reminder->video;
            $emaildetails = array(
                'malto'             => $reminder->email,
                'subject'           => $reminder->subject,
                'body'              => $reminder->message,
                'user_banner'       => $reminder->user_banner,
            );
            $malto = $reminder->email;
            $subject = $reminder->subject;

           Mail::send('manage_client_video_template', $emaildetails, function($message) use ($malto, $subject, $img_path) {
                     $message->to($malto)
                     ->subject($subject);
                     $message->attach($img_path);
                     $message->from('dsvmailer@gmail.com', 'Mafama');
                  });
        }
        dd($reminders);
    }
}
