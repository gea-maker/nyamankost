<?php

// app/Mail/OtpVerificationMail.php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $otp, public string $userName) {}

    public function build()
    {
        return $this->subject('Kode Verifikasi Email - NyamanKost')
            ->view('emails.otp')
            ->with([
                'otp' => $this->otp,
                'userName' => $this->userName,
            ]);
    }
}