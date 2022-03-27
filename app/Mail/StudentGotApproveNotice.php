<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentGotApproveNotice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailSend,$productName,$student,$codeSubject,$codeName,$token)
    {
        $this->emailSend=$emailSend;
        $this->productName=$productName;
        $this->student=$student;
        $this->codeSubject=$codeSubject;
        $this->codeName=$codeName;
        $this->token=$token;
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
        $student =      $this->student;
        $codeSubject =       $this->codeSubject;
        $codeName =       $this->codeName;
        $token = $this->token;
        return $this ->subject("Thông báo sản phẩm được phê duyệt thành công trên hệ thống Poly App")
            ->view('mail.studentGotApproveNotice',compact('emailSend','productName','student','codeSubject','codeName','token'));
    }
}
