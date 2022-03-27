<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


/*
-create_by: dinh
- descript: dùng để gửi kết quả cho người up dữ liệu sinh viên
*/
class ReturnResultScanMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName,$count,$start_time,$end_time)
    {
        $this->name = $userName;
        $this->count = $count;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userName = $this->name;
        $countResult = $this->count;
        $start_time = $this->start_time;
        $end_time = $this->end_time;
        return $this ->subject("Xác nhận xử lý lưu trữ dự án cho sinh viên")
            ->view('mail.return_result',compact('userName','countResult','start_time','end_time'));
    }
}
