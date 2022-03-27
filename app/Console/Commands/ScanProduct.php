<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Member;
use Carbon\Carbon;

/*
- create_by: dinh
- time: 27/10/2021
- use: scan:product
- description: Tạo ra để quét và xóa những sản phẩm mà sinh viên không đăng ký sau 1 tuần 
*/
class ScanProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quét và xóa những sản phẩm mà sinh viên không đăng ký sau 1 tuần';

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
        $now = Carbon::now();
        $products = Product::where('status',1)
                        ->orWhere('status',2)
                        ->get();
        foreach($products as $item) {
            $period = $now->diffInDays($item->updated_at);
            if ($period > 7) {      // Xóa các sinh viên ko đăng ký và chỉnh sửa khi giáo viên từ chối sản phẩm sau 7 ngày
                ProductGallery::where('product_id', $item->id)->delete();
                Member::where('product_id', $item->id)->delete();
                Product::destroy($item->id);
            }
        }
    }
}
