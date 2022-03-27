<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HeadTeacherNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailSend,$productName,$teacherApprove,$codeSubject,$codeName)
    {
        $this->emailSend=$emailSend;
        $this->productName=$productName;
        $this->teacherApprove=$teacherApprove;
        $this->codeSubject=$codeSubject;
        $this->codeName=$codeName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailSend =  $this->emailSend;
        $productName =      $this->productName;
        $teacherApprove =      $this->teacherApprove;
        $codeSubject =       $this->codeSubject;
        $codeName =       $this->codeName;
        return $this ->subject("Thông báo phê duyệt dự án sinh viên trên hệ thống Poly App")
            ->view('mail.headTeacherNotify',compact('emailSend','productName','teacherApprove','codeSubject','codeName'));
    }
}