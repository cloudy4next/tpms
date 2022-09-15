<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sessionReminderProvider extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $arr;
    public $date;

    public function __construct($date, $arr)
    {
        $this->arr = $arr;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.sessionReminderProvider')
            ->subject("Today's Schedule")
            ->from("support@therapypms.com", "Today's Schedule");
    }
}
