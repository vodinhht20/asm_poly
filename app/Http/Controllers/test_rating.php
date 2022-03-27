<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class test_rating extends Controller
{
    public function index() {
        $products = Product::select("products.*", DB::raw("AVG(stars.point) as total_star"))
                ->leftJoin('stars', 'stars.product_id', '=', 'products.id')
                ->where('stars.created_at', '>', Carbon::now()->sub('1 month')->format("Y-m-d"))
                ->where('products.status', 5)
                ->where("product_id",3)
                ->groupBy('stars.product_id', 'products.id');
        return dd($products->first()->total_star);
    }

}
