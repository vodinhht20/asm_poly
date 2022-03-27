<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductGotDeleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($productName,$student,$codeSubject,$codeName)
    {
        $this->productName=$productName;
        $this->student=$student;
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
        $productName =      $this->productName;
        $student =      $this->student;
        $codeSubject =       $this->codeSubject;
        $codeName =       $this->codeName;
       
        return $this ->subject("Thông báo sản phẩm đã bị xóa trên hệ thống Poly App")
            ->view('mail.productgotdeleted',compact('productName','student','codeSubject','codeName'));
    }
}
