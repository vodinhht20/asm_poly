<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\ExcelDetail;
use App\Models\ExcelImport;
use App\Models\User;
use App\Models\Product;
use App\Mail\RegistrationNotice;
use App\Mail\ReturnResultScanMail;


/*
- create_by: dinh
- time: 25/10/2021
- use: php artisan scan:mail
- descript: tạo ra để quét thông tin dữ liệu,tạo sản phẩm ảo, gửi mail cho sinh viên và trả kết quả cho giáo vụ
*/
class ScanMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quét danh sách và gửi mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $excelImports = ExcelImport::where('status',1)->get(); // lọc các file excel chưa quét
	foreach($excelImports as $row) {
            $start_time = Carbon::now('Asia/Ho_Chi_Minh'); // thời gian bắt đầu quét
            $excelImport = ExcelImport::find($row->id); 
            $excelImport -> status = 2; // cập nhật đang quét 
            $excelImport ->save();
            
            $excelDetails = ExcelDetail::where('excel_id', $row->id)->get();
            foreach ($excelDetails as $item){

                $excelDetail = ExcelDetail::find($item->id);

                $subject  = $item->subject_code;
                $userName = $item->name;
                $email = $userName.'@fpt.edu.vn';
                $token = sha1($email.uniqid());

                // tạo sản phẩm
                $product = new Product();
                $product->token = $token;
                $product->code_subject = $subject;
                $product->score = $item->score;
                $product->campus_id = $excelImport->campus_id;
                $product->status = 1;
                $product->teacher = $item->teacher;
                $product->semester = $item->semester_id;
                $product->create_by = User::where('email',$email)->first()->id;
                $product->save();
                $dealine = Carbon::now('Asia/Ho_Chi_Minh')->addDay(7)->toDateString();
                 // sent mail
                try {
                    $mailable = new RegistrationNotice($userName,$subject,$token,$dealine);
                    Mail::to($email)->send($mailable);
                    $excelDetail -> is_send = 1;
                    $excelDetail -> save();
                } catch (\Throwable $th) {
                    $excelDetail -> reason = "Không thể gửi mail";
                    $excelDetail -> save();
                }
            }

            $excelImport -> status = 3; // cập nhật trạng thái đã quét thành công
            $excelImport ->save();
            $end_time = Carbon::now('Asia/Ho_Chi_Minh');  // thời gian kết thúc

            $created_by = $excelImport->created_by;
            $user = User::find($created_by);
            $email = $user->email;
            $userName = $user->name;
            $mailable = new ReturnResultScanMail($userName,count($excelDetails),$start_time,$end_time); // gửi mail thông báo cho giáo vụ
            Mail::to($email)->send($mailable);
        }
    }
}
