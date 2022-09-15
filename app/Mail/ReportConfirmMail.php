<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportConfirmMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $name;
    public $start_date;
    public $end_date;
    public $user_name;
    public $report_link;
    public function __construct($arr, $name)
    {

        $this->start_date = $arr["sd"];
        $this->end_date = $arr["ed"];
        $this->user_name = $arr["name"];
        $this->report_link = $arr["report"];
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.reportConfirm')->subject('Report created Successfully!')->from("support@therapypms.com", 'Report Generation');;
    }
}
