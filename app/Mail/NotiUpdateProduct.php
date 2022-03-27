<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotiUpdateProduct extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nameProducts,$createBy,$updateBy,$dateNow,$token)
    {
        $this->nameProducts=$nameProducts;
        $this->createBy=$createBy;
        $this->updateBy=$updateBy;
        $this->dateNow=$dateNow;
        $this->token=$token;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nameProducts =  $this->nameProducts;
        $createBy =      $this->createBy;
        $updateBy =      $this->updateBy;
        $dateNow =       $this->dateNow;
        $token =         $this->token;
        return $this ->subject("Thông báo thay đổi thông tin dự án")
            ->view('mail.notiUpdateProduct',compact('nameProducts','createBy','updateBy','dateNow','token'));
    }
}
