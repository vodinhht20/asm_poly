<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;
use Storage;
use File;
class ScanVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:video';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload những video được phê duyệt';

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
       
            $dataArr = Product::where('status', 5)->where('status_video',1)->get();
            foreach($dataArr as $value) {
                $str = $value->url_video;
                $re = '/.*[^-\w]([-\w]{25,})[^-\w]?.*/';
                preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);
                try{
                    $contents = file_get_contents("https://drive.google.com/u/0/uc?id=".$matches[1][0]."&export=download&confirm=Otpd");
                    $name = Carbon::now()->format('Y-m-d') . '-'.uniqid().'.mp4';
                    Storage::put('videos/'.$name, $contents);
                    $path = storage_path('app/videos/'.$name);
                    $fileData = File::get($path);
                    Storage::disk('second_google')->put($name,$fileData); // đẩy file lên driver
                    unlink($path);  // xóa file ở server
                    $contents = collect(Storage::disk('second_google')->listContents('/', false)); // lấy ra tên file
                    $linkDriver = $contents ->where('type', '=', 'file')
                                ->where('filename', '=', pathinfo($name, PATHINFO_FILENAME))
                                ->where('extension', '=', pathinfo($name, PATHINFO_EXTENSION))
                                ->first();
                    $product=Product::find($value->id);
                    $product->status_video=2;
                    $product->url_video= "https://drive.google.com/file/d/".$linkDriver['path']."/preview";
                    $product->save();
    
                }catch(\Exception $ex){
                    // dd($ex->getMessage());
                    continue;
                }
            }
        
    }
}
