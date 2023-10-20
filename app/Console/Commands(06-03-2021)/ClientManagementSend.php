<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Mail;

class ClientManagementSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:client';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Client management send';

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
        $reminders = DB::table('manage_client_email')->where('date', date('Y-m-d'))->where('status', "pending")->where('time', null)->get();
        foreach($reminders as $reminder){
            $emaildetails = array(
                'malto'             => $reminder->email,
                'subject'           => $reminder->subject,
                'bakg'              => $reminder->background,
                'body'              => $reminder->message,
                'user_banner'       => $reminder->user_banner,
            );
            $malto = $reminder->email;
            $subject = $reminder->subject;

            // print_r($emaildetails);die();
            Mail::send('manage_client_template', $emaildetails, function($message) use ($malto, $subject) {
                 $message->to($malto)
                 ->subject($subject);
                 $message->from('dsvmailer@gmail.com', 'Mafama');
              });
            $reminders = DB::table('manage_client_email')->where('id', $reminder->id)->update(['status' => "sent"]);
        }
        dd($reminders);
    }
}
