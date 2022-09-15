<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sessionReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $date;
    public $ftime;
    public $ttime;
    public function __construct($arr)
    {
        $this->date=$arr["schedule_date"];
        $this->ftime=$arr["from_time"];
        $this->ttime=$arr["to_time"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sessionReminder')->subject('Appointment Reminder')->from("support@therapypms.com", "Appointment Reminder");
    }
}
