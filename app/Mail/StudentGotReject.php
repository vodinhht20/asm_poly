<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentGotReject extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productName,$student,$codeSubject,$codeName,$reason,$token)
    {
        $this->productName=$productName;
        $this->student=$student;
        $this->codeSubject=$codeSubject;
        $this->codeName=$codeName;
        $this->reason=$reason;
        $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $productName =      $this->productName;
        $student =      $this->student;
        $codeSubject =       $this->codeSubject;
        $codeName =       $this->codeName;
        $reason =       $this->reason;
        $token =       $this->token;
        return $this ->subject("Thông báo sản phẩm đã bị từ chối trên hệ thống Poly App")
            ->view('mail.studentGotReject',compact('productName','student','codeSubject','codeName','reason','token'));
    }
}
