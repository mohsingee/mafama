<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;

class PopupReminderMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:popup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popup mail description.';

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
        $reminders = DB::table('popup_mail')->where('date', date('Y-m-d'))->where('status', "pending")->get();
        foreach($reminders as $reminder){
            $malto = $reminder->email;
            $subject = $reminder->subject;
            $message = $reminder->message;
            $emaildetails = array(
                'malto'             => $malto,
                'subject'           => $subject,
                'body'              => $message,
            );
            Mail::send('popup_mail_template', $emaildetails, function($message) use ($malto, $subject) {
                $message->to($malto)
                ->subject($subject);
                $message->from('dsvmailer@gmail.com', 'Mafama');
            });
            DB::table('popup_mail')->where('id', $reminder->id)->update(['status' => "sent"]);
        }
    }
}
