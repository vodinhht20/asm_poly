<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Semester;
use Illuminate\Http\Request;

class SearchController extends Controller
{   

    public function index(Request $request) {
        if ($request->input("key")) {
            $keyword = $request->input("key");
            $products = Product::where([['status', 5],['name','like',"%".$keyword."%"]]);
            $couterResult = count($products->get());
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
                }
            }
    
            // phân trang và append thêm param vào paginate
            $products = $products->paginate(16)->appends($request->query());
    
            $product_type = ProductType::all();
            $semester = Semester::orderByDesc("id")->get();
    
            $products->load('user_product', 'product_gallery');
            
            return view("page.search.search",compact('products','semester','product_type','keyword','couterResult'));
        } else {
            return redirect()->back();
        }
    }
    public function ajaxSearch(Request $request){
        if($request->keyword != ''){
            $products = Product::where('name','LIKE', '%'.$request->keyword.'%')->get();
            if (count($products) ==0) {
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => false]);
        }
        return response()->json([
            'success' => true,
            'products' => $products,
            'keyword' => $request->keyword,
         ]);
    }

    public function ajaxProductSearchSort(Request $request){
        // chuyển param thành mảng
        $components = parse_url($request->param);
        parse_str($components['query'], $results);

        $query = Product::where([['status', 5],['name','like',"%".$results['key']."%"]]);

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
            } 
        }
        // phân tran và thêm param cho link paginate
        $products = $query->paginate(16)->withPath($request->pathname)->appends($results);

        $results = count($products);
        $viewData = view('page.list_product._partials.base_products',compact('products','results'))->render();
        return response()->json([
            "success" => true,
            "data" => $viewData,
        ]);
        
    }
}
