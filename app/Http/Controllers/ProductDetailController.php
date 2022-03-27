<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Star;
use App\Models\Comment;
use Carbon\Carbon;
use Session;

class ProductDetailController extends Controller
{
    public function index ($token) {
        $product = Product::where([['token',$token],['status',5]])->first();
        if (isset($product)) {

            $product->load('user_product', 'product_gallery','member_obj','star_obj','comment_obj','product_gallery');
            $teacher = User::where('email',$product->teacher."@fpt.edu.vn")->first();
            $createAt = Carbon::parse($product->created_at)->format('d/m/Y');
            $avgStar = Star::where("product_id",$product->id)->avg("point");
            $myStar = Star::where([["user_id",Auth::id()],['product_id',$product->id]])->first();
            $similarProduct =  Product::where([['token','!=',$token],['status',5]])->inRandomOrder()->limit(4)->get();
            $stars = Comment::where("product_id",$product->id);
            // Session::put('url_now',url()->current()); // lưu url khi người dùng bị chặn lại

                //cắt chuỗi 
            if ($product->status_video==2) {    //youtube
                $url_video = $product->url_video; 
            } else {  //driver
                $str = $product->url_video;
                $regex = '/.*[^-\w]([-\w]{25,})[^-\w]?.*/';
                preg_match($regex, $str, $matches, PREG_OFFSET_CAPTURE, 0);
                $url_video = "https://drive.google.com/file/d/".$matches[1][0]."/preview";
            }
            

            return view('page.product.detailView',compact('product','teacher','createAt','avgStar','token','stars','myStar','similarProduct','url_video'));
        } else {
            return view('error.error404');
        }
    }
    public function rating(Request $request) {
        $product = Product::where([['token',$request->token],['status',5]])->first();
        $product->load('user_product', 'star_obj');

        $star = new Star;
        $star->product_id = $product->id;
        $star->point= (int)$request->star;
        $star->user_id = Auth::id();
        $star->save();

        $productNew = Product::where([['token',$request->token],['status',5]])->first();
        $avgStar = Star::where("product_id",$productNew->id)->avg("point");
        $countRating = Star::where("product_id",$productNew->id)->get();
        return response()->json([
            "countRating" => count($countRating),
            "product" => $productNew,
            "avgStar" => $avgStar
        ]);
    }
    public function comment(Request $request) {
        $request->validate([
            'comment'=>'required|max:255',
        ]);

        $product = Product::where([['token',$request->token],['status',5]])->first();
        $product->load('user_product', 'star_obj');
        $comment = new Comment;
        $comment->product_id = $product->id;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->save();
        $user = User::find(Auth::id());
        $star = Star::where([["user_id",Auth::id()],['product_id',$product->id]])->first();
        return response()->json([
            "user" => $user,
            "star" => $star,
            "comment" => $request->comment,
        ]);
    }
    public function increaseView(Request $request) {
        $product = Product::where('token',$request->token)->first();
        $product->view = $product->view+1;
        $product->save();
        return response()->json(true);
    }
}
