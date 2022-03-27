<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {   
        $products = Product::where('status', 5)->orderByDesc('created_at');
        $result = $products->get()->count();
        $products= $products->take(16)->get();
        $product_type = ProductType::where('display_home', 1)->get();
        $products->load('user_product', 'product_gallery');
        return view('homepage.home', compact('products', 'product_type', 'result'));
    }
    public function ajaxSortProductType(Request $request){
        
        $query = Product::where('status', 5);
        $paramsSeemore = "";
        if($request->order_by === null){
            $query = $query->orderByDesc('created_at');
        }else if($request->order_by == "0"){
            $query = $query->orderByDesc('view');
            $paramsSeemore = "sort=view_desc";
        } else if($request->order_by == "1") {
            $query = Product::select("products.*", DB::raw("AVG(stars.point) as total_star"))
                        ->leftJoin('stars', 'stars.product_id', '=', 'products.id')
                        ->where('stars.created_at', '>', Carbon::now()->sub('1 month')->format("Y-m-d"))
                        ->where('products.status', 5)
                        ->groupBy('stars.product_id', 'products.id')
                        ->orderByDesc('total_star');
            $paramsSeemore = "sort=rating";
        }
        if($request->has('type') && $request->type != "all"){
            $query = $query->where('products.type_id', $request->type);
            $paramsSeemore .= "&type=".$request->type;
        }
        $result = $query->get()->count();
        $products = $query->take(16)->get();
        $products->load('user_product', 'product_gallery', 'star_obj');
        $viewData = view('homepage._partials.homepage-order-product-type')
                        ->with('result', $result)
                        ->with('paramsSeemore', $paramsSeemore)
                        ->with('products', $products)->render();
        return response()->json([
            "success" => true,
            "data" => $viewData,
            "result" => $result,
        ]);
    }
}
