<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatementMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $details;
    public $fileUrl;
    public $attachment;
    public function __construct($data)
    {
        $this->details = $data["request"];
        $this->fileUrl = $data["fileUrl"];
        $this->attachment = $data["attachment"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = '';
        $data = $this->view('mails.statementEmail')->subject($this->details->subject)->from($this->details->from_email, 'Patient Statement');
        if($this->attachment != '' || $this->attachment != null){
            $data = $data->attach($this->attachment);
        }


        if($this->fileUrl != '' || $this->fileUrl != null){
            $data = $data->attach($this->fileUrl);
        }

        return $data;
    }
}
