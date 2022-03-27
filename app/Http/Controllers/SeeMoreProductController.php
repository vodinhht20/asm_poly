<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SeeMoreProductController extends Controller
{   
    public function seeMore(Request $request) {
        $products = Product::where('status', 5);

        // lọc theo loại sản phẩm
        if ($request->input("type")) {
            $products= $products->where('type_id', $request->input("type"));
        } 

        //lọc theo kỳ
        if ($request->input("semester")) {
            $products= $products->where('semester', $request->input("semester"));
        }

        //lọc theo lựa chọn
        if($request->input("sort")) {
            if ($request->input("sort")=="view_asc") {
                $products = $products->orderBy('view');
            } else if ($request->input("sort")=="view_desc") {
                $products = $products->orderByDesc('view');
            } else if ($request->input("sort")=="name_asc") {
                $products = $products->orderBy('name');
            } else if ($request->input("sort")=="name_desc") {
                $products = $products->orderByDesc('name');
            } else if ($request->input("sort")=="rating") {
                $products = $products->select("products.*", DB::raw("AVG(stars.point) as total_star"))
                        ->leftJoin('stars', 'stars.product_id', '=', 'products.id')
                        ->where('stars.created_at', '>', Carbon::now()->sub('1 month')->format("Y-m-d"))
                        ->where('products.status', 5)
                        ->groupBy('stars.product_id', 'products.id')
                        ->orderByDesc('total_star');
            }
        }

        // phân trang và append thêm param vào paginate
        $products = $products->paginate(16)->appends($request->query());

        $product_type = ProductType::all();
        $semester = Semester::orderByDesc("id")->get();

        $products->load('user_product', 'product_gallery');
        return view("page.list_product.see_more",compact('products','semester','product_type'));
    }
    public function ajaxProductSeeMore(Request $request){
        // chuyển param thành mảng
        $components = parse_url($request->param);
        parse_str($components['query'], $results);

        //trang nếu trang chi tiết
        if ($request->pathname == "/san-pham") {
            $query = Product::where('status', 5);
        }
        // sắp xếp theo loại 
        if (isset($results['type'])&&$results['type']!=="") {
            $query = $query->where('products.type_id', $results['type']);
        }

        // sắp xếp theo kỳ 
        if (isset($results['semester'])&&$results['semester']!=="") {
            $query = $query->where('products.semester', $results['semester']);
        }

        // sắp xếp theo các lựa chọn
        if (isset($results['sort'])&&$results['sort']!=="") {
            if ($results['sort']=="view_asc") {
                $query = $query->orderBy('products.view');
            } else if ($results['sort']=="view_desc") {
                $query = $query->orderByDesc('products.view');
            } else if ($results['sort']=="name_asc") {
                $query = $query->orderBy('products.name');
            } else if ($results['sort']=="name_desc") {
                $query = $query->orderByDesc('products.name');
            } else if ($results["sort"]=="rating") {
                $query = $query->select("products.*", DB::raw("AVG(stars.point) as total_star"))
                        ->leftJoin('stars', 'stars.product_id', '=', 'products.id')
                        ->where('stars.created_at', '>', Carbon::now()->sub('1 month')->format("Y-m-d"))
                        ->where('products.status', 5)
                        ->groupBy('stars.product_id', 'products.id')
                        ->orderByDesc('total_star');
            }
        }
        // phân trang và thêm param cho link paginate
        $products = $query->paginate(16)->withPath($request->pathname)->appends($results);

        $results = count($products);
        $viewData = view('page.list_product._partials.see_more_products',compact('products','results'))->render();
        return response()->json([
            "success" => true,
            "data" => $viewData,
            "arrResult" => $products
        ]);
        
    }
}
