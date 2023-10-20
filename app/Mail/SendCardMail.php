<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCardMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from('dsvmailer@gmail.com')->subject('Booking Confirmation')->view('email_template')->with('data',$this->data);
        // print_r($this->data['subject']);die();
        return $this->from('support@mafama.com')->subject($this->data['subject'])->view('card_email_template')->with('data', $this->data);
    }
}
