<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/*
-create_by: dinh
- descript: dùng để gửi thông báo đăng ký cho sinh viên
*/
class RegistrationNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName,$subject,$token,$dealine)
    {
        $this->userName = $userName;
        $this->dealine=$dealine;
        $this->subject = $subject;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userName = $this->userName;
        $subject = $this->subject;
        $dealine = $this->dealine;
        $token = $this->token;
        return $this ->subject("Dịch vụ đăng ký lưu trữ dự án")
            ->view('mail.registration',compact('userName','subject','token','dealine'));
    }
}
