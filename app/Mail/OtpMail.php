<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $heading;

    public function __construct($otp, $heading = 'Your Verification Code')
    {
        $this->otp = $otp;
        $this->heading = $heading;
    }

    public function build()
    {
        return $this->subject($this->heading)->view('emails.otp');
    }
}