<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendResultEmailTeacher extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameProducts,$createBy,$productType,$subjectName,$teacherName,$token)
    {
        $this->nameProducts = $nameProducts;
        $this->createBy = $createBy;
        $this->productType = $productType;
        $this->subjectName = $subjectName;
        $this->teacherName = $teacherName;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nameProducts = $this->nameProducts;
        $createBy = $this->createBy;
        $productType = $this->productType;
        $subjectName = $this->subjectName;
        $teacherName = $this->teacherName;
        $token = $this->token;
        return $this ->subject("Phê duyệt dự án cho sinh viên trên hệ thống Poly App")
            ->view('mail.returnResultEmailTeacher',compact('nameProducts','createBy','productType','subjectName','teacherName','token'));
    }
}
